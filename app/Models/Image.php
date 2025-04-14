<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['article_id', 'path'];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public static function getUrlByFilePath($filePath, $w , $h)
    {
        if (!$w && !$h) {
            return Storage::url($filePath);
        }
        $path = dirname($filePath);
        $filename = basename($filePath);
        $file = "{$path}/crop_{$w}x{$h}_{$filename}";
        return Storage::url($file);
    }

    public function getUrl ($w = null, $h = null)
    {
        
        return self::getUrlByFilePath($this->path, $w, $h);
    }
}
