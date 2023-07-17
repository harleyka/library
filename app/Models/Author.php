<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public function books() {
        return $this->hasMany(Book::class);
    }

    public function magazines() {
        return $this->hasMany(Magazine::class);
    }

    public function electronicMedia() {
        return $this->hasMany(ElectronicMedia::class);
    }
}
