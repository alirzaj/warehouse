<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class ProductQueryBuilder extends Builder
{
    public function withAvailableCount(): self
    {
        $this
            ->selectRaw('FLOOR(
                     MIN(articles.stock / article_product.amount)
                ) AS available_count'
            )
            ->join('article_product', 'products.id', '=', 'article_product.product_id')
            ->join('articles', 'article_product.article_id', '=', 'articles.id')
            ->groupBy('products.id');

        return $this;
    }
}
