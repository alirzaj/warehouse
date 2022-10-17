<?php

namespace App\Actions;

use App\Models\Article;

class ImportArticlesFromJson
{
    public function __invoke(string $json): void
    {
        $articles = json_decode($json, associative: true)['articles'] ?? [];

        Article::query()->insert($articles);
    }
}
