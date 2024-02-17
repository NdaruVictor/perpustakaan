<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'author',
        'publish_date',
        'stock',
        'book_category_id',
    ];

    public function  category()
    {
        return $this->belongsTo(BookCategory::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class, 'user_id');
    }

}
