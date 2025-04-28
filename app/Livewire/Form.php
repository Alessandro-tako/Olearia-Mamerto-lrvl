<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Jobs\ResizeImage;

class Form extends Component
{
    use WithFileUploads;

    public $title;
    public $sku;
    public $description;
    public $price;
    public $discount = 0.00;
    public $stock = 0;
    public $unit = 'pz';
    public $published_at;
    public $temporary_images = [];
    public $images = [];
    public $article;
    public $articleId;
    public $editMode = false;

    // Regole di validazione
    protected function rules()
    {
        $skuRule = $this->editMode
            ? 'nullable|string|unique:articles,sku,' . $this->articleId
            : 'nullable|string|unique:articles,sku';

        return [
            'title' => 'required|string|max:255',
            'sku' => $skuRule,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'unit' => 'nullable|string|max:10',
            'published_at' => 'nullable|date',
            'temporary_images.*' => 'image|max:20480',
        ];
    }

    public function mount($articleId = null)
    {
        if ($articleId) {
            $this->editMode = true;
            $this->articleId = $articleId;
            $this->article = Article::with('images')->findOrFail($articleId);

            $this->title = $this->article->title;
            $this->sku = $this->article->sku;
            $this->description = $this->article->description;
            $this->price = $this->article->price;
            $this->discount = $this->article->discount;
            $this->stock = $this->article->stock;
            $this->unit = $this->article->unit;
            $this->published_at = $this->article->published_at;

            foreach ($this->article->images as $img) {
                $this->images[] = [
                    'id' => $img->id,
                    'path' => $img->path,
                ];
            }
        }
    }

    public function updatedTemporaryImages()
    {
        foreach ($this->temporary_images as $image) {
            $this->images[] = $image;
        }
    }

    public function removeImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
        }
    }

    public function deleteExistingImage($imageId)
    {
        $image = $this->article->images()->find($imageId);
        if ($image) {
            \Storage::disk('public')->delete($image->path);
            $image->delete();

            $this->images = array_filter($this->images, function ($img) use ($imageId) {
                return $img['id'] ?? null !== $imageId;
            });
        }
    }

    public function store()
    {
        $this->validate();

        $this->article = Article::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'sku' => $this->sku,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'stock' => $this->stock,
            'unit' => $this->unit,
            'published_at' => $this->published_at,
            'is_active' => false,
            'slug' => Str::slug($this->title) . '-' . uniqid(),
        ]);

        if (count($this->images) > 0) {
            foreach ($this->images as $image) {
                if (is_object($image)) {
                    $path = $image->store("articles/{$this->article->id}", 'public');
                    $this->article->images()->create(['path' => $path]);
                    dispatch(new ResizeImage($path, 300, 300));
                }
            }
        }
        

        File::deleteDirectory(storage_path('/app/livewire-tmp'));

        session()->flash('message', 'Articolo creato con successo e in attesa di approvazione.');

        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset([
            'title', 'sku', 'description', 'price', 'discount', 'stock',
            'unit', 'published_at', 'temporary_images', 'images'
        ]);
    }

    public function render()
    {
        return view('livewire.form');
    }
}
