<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Ingredient;
use App\Models\User;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_posted',
        'title',
        'image',
        'description',
        'preparation_time',
        'serves',
        'cooking_instructions',
    ];

    // A Recipe belongs to a User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // A Recipe has many Ingredients
    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }
}
