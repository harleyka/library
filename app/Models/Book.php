<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public function author() {
        return $this->hasOne(Author::class, 'id', 'author_id',);
    }

    public function medium() {
        return $this->morphOne(Medium::class, 'mediable');
    }
}
