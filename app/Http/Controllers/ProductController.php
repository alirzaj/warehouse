<?php

namespace App\Http\Controllers;

use App\Http\Resources\IndexProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->select('products.name', 'products.price')
            ->selectRaw('FLOOR(
                     MIN(articles.stock / article_product.amount)
                ) AS available_count'
            )
            ->join('article_product', 'products.id', '=', 'article_product.product_id')
            ->join('articles', 'article_product.article_id', '=', 'articles.id')
            ->groupBy('products.id')
            ->orderByRaw('available_count * products.price desc')
            ->get();

        return IndexProductResource::collection($products);
    }
}
