<?php

use App\Actions\ImportArticlesFromJson;
use App\Models\Article;
use function Pest\Laravel\assertDatabaseHas;

it('can import articles from json into the database', function () {
    $articles = Article::factory()->count(4)->raw();

    (new ImportArticlesFromJson())(json_encode(['articles' => $articles]));

    foreach ($articles as $article) {
        assertDatabaseHas(Article::class, $article);
    }
});
