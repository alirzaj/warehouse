<?php

use App\Models\Article;
use App\Models\Product;
use Illuminate\Testing\Fluent\AssertableJson;
use function Pest\Faker\faker;
use function Pest\Laravel\getJson;

test('users can see a list of all products', function () {
    $products = Product::factory()
        ->hasAttached(Article::factory()->count(3), fn() => ['amount' => faker()->numberBetween(1)])
        ->count(3)
        ->create()
        ->sortByDesc(
            fn(Product $product) => productAvailableCount($product) * $product->price,
            SORT_NUMERIC
        )
        ->values();

    getJson(route('products.index'))->assertOk()->assertJson(fn(AssertableJson $response) => $response
        ->has('data', 3)
        ->has('data', fn(AssertableJson $data) => $data
            ->where('0.name', $products[0]['name'])
            ->where('0.price', $products[0]['price'])
            ->where('0.available_count', productAvailableCount($products[0]))
            ->where('1.name', $products[1]['name'])
            ->where('1.price', $products[1]['price'])
            ->where('1.available_count', productAvailableCount($products[1]))
            ->where('2.name', $products[2]['name'])
            ->where('2.price', $products[2]['price'])
            ->where('2.available_count', productAvailableCount($products[2]))
        )
    );

});

test('users will not see the products that doesnt have any article', function () {
    $productWithArticle = Product::factory()
        ->hasAttached(Article::factory(), ['amount' => faker()->numberBetween(1)])
        ->create();

    $productWithoutArticle = Product::factory()->create();

    getJson(route('products.index'))->assertOk()->assertJson(fn(AssertableJson $response) => $response
        ->has('data', 1)
        ->where('data.0.name', $productWithArticle->name)
    );
});

function productAvailableCount(Product $product): int
{
    return $product
        ->articles
        ->map(fn(Article $article) => (int)($article->stock / $article->pivot->amount))
        ->min();
}
