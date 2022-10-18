<?php

namespace App\Console\Commands;

use App\Actions\ImportProductsFromJson;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:import';

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
    public function handle(ImportProductsFromJson $importArticlesFromJson)
    {
        $path = $this->ask('Give the path of your json file (relative to storage/app directory)');

        $importArticlesFromJson(Storage::get($path));

        $this->info('products are imported successfully');

        return Command::SUCCESS;
    }
}
