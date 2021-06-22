<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ParseRSS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:rss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Парсер новостей с сайта http://static.feed.rbc.ru/';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get(env('RSS_URL'));
        $rss = simplexml_load_string($response->body());

        foreach ($rss->channel->item as $item)
        {
            \Log::info($item->title);
        }
    }
}
