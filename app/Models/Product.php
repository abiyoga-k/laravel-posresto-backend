<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormatRupiah;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    use HasFormatRupiah;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
