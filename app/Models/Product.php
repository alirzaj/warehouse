<?php

namespace App\Models;

use App\QueryBuilders\ProductQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'price'
    ];

    protected $casts = [
        'price' => 'integer'
    ];

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param \Illuminate\Database\Query\Builder $query
     * @return  ProductQueryBuilder
     */
    public function newEloquentBuilder($query)
    {
        return new ProductQueryBuilder($query);
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class)->withPivot('amount');
    }
}
