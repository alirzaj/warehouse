<?php

namespace App\Console\Commands;

use App\Actions\ImportArticlesFromJson;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the articles from a json file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ImportArticlesFromJson $importArticlesFromJson)
    {
        $path = $this->ask('Give the path of your json file (relative to storage/app directory)');

        $importArticlesFromJson(Storage::get($path));

        $this->info('articles are imported successfully');

        return Command::SUCCESS;
    }
}
