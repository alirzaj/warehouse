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
            ->withAvailableCount()
            ->orderByRaw('available_count * products.price desc')
            ->get();

        return IndexProductResource::collection($products);
    }
}
