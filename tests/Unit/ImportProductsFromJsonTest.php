<?php

use App\Actions\ImportProductsFromJson;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Support\Arr;
use function Pest\Faker\faker;
use function Pest\Laravel\assertDatabaseHas;

it('can import products from json into the database', function () {
    $products = Product::factory()
        ->count(2)
        ->make()
        ->transform(function (Product $product) {
            $product['articles'] = Article::factory()
                ->count(3)
                ->create()
                ->map(fn(Article $article) => [
                    'id' => $article->id,
                    'amount' => faker()->numberBetween(1)
                ])
                ->toArray();

            return $product;
        })
        ->toArray();

    (new ImportProductsFromJson)(json_encode(['products' => $products]));

    foreach ($products as $product) {
        assertDatabaseHas(Product::class, Arr::only($product, ['name', 'price']));

        foreach ($product['articles'] as $article) {
            assertDatabaseHas('article_product', ['article_id' => $article['id'], 'amount' => $article['amount']]);
        }
    }
});
