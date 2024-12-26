<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // menggunakan hasFactory untuk MassAssignment
    use HasFactory;
    /**
     * Fillable
     * 
     * @var array
     */

        // konfigurasi MassAssignment
        protected $fillable = [
        'image',
        'title',
        'content',
        ];

    //  menambahkan attribute untuk accessor (mempermudah untuk akses)
        /**
      * image
      * 
      * @return Attribute
      */

        public function image(): Attribute
        {
        return Attribute::make(
            get: fn ($image) => url('/storage/posts/'. $image),
        );
        }
}
