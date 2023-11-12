<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Categories;

class Products extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = ["name", "description", "sku", "price", "published"];

    public function categories() {
        return $this->belongsToMany(Categories::class);
    }
}
