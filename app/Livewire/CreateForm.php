<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Article;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class CreateForm extends Component
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
    public $category = '';
    public $temporary_images = [];
    public $images = [];
    public $article;

    // Regole di validazione
    protected $rules = [
        'title' => 'required|string|max:255',
        'sku' => 'nullable|string|unique:articles,sku',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'discount' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'unit' => 'nullable|string|max:10',
        'published_at' => 'nullable|date',
        'category' => 'required|exists:categories,id', // Aggiungi la validazione per la categoria
        'temporary_images.*' => 'image|max:2048',
    ];

    // Quando vengono aggiornate le immagini temporanee
    public function updatedTemporaryImages()
    {
        foreach ($this->temporary_images as $image) {
            $this->images[] = $image;
        }
    }

    // Rimuove un'immagine
    public function removeImage($key)
    {
        if (isset($this->images[$key])) {
            unset($this->images[$key]);
        }
    }

    // Salva l'articolo
    public function store()
    {
        $this->validate();

        // Creazione dell'articolo
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
            'category_id' => $this->category,
            'is_active' => false, // Articolo in attesa di approvazione
            'slug' => Str::slug($this->title) . '-' . uniqid(),
        ]);

        // Salvataggio delle immagini
        if (!empty($this->images)) {
            foreach ($this->images as $image) {
                $path = $image->store('public/articles');
                $newImage = $this->article->images()->create([
                    'path' => basename($path),
                ]);
            }
        }

        // Pulizia delle immagini temporanee
        File::deleteDirectory(storage_path('/app/livewire-tmp'));

        // Messaggio di successo
        session()->flash('message', 'Articolo creato con successo e in attesa di approvazione.');

        // Reset del modulo
        $this->reset([
            'title', 'sku', 'description', 'price', 'discount', 'stock',
            'unit', 'published_at', 'category', 'temporary_images', 'images'
        ]);
    }

    public function render()
    {
        return view('livewire.create-form');
    }
}
