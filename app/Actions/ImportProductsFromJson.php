<?php

namespace App\Actions;

use App\Models\Product;
use Illuminate\Support\Arr;

class ImportProductsFromJson
{
    public function __invoke(string $json): void
    {
        $products = json_decode($json, associative: true)['products'] ?? [];

        foreach ($products as $product) {
            Product::query()
                ->create(Arr::only($product, ['name', 'price']))
                ->articles()
                ->attach(
                    collect($product['articles'])->mapWithKeys(fn(array $article) => [
                        $article['id'] => ['amount' => $article['amount']]
                    ])
                );
        }
    }
}
