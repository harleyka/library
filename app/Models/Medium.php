<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

use App\Models\Book;
use App\Models\ElectronicMedia;
use App\Models\Magazine;

class Medium extends Model
{
    use HasFactory;

    public function mediable(): MorphTo {
        return $this->morphTo();
    }

    public function type(): string  {
        return $this->mediable_type;
    }
}
