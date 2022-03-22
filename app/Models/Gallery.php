<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'gallery_name',
        'gallery_title',
        'main_image',
    ];
    public function gallery_images(){
        return $this->hasMany(GalleryImage::class);
    }
}
