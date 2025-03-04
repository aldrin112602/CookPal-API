<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Recipe;

class Ingredients extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'recipe_name',
        'quantity',
        'unit',
        'price',
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }
}
