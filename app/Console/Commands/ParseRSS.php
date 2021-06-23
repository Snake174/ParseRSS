<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\News;
use App\Models\Photos;
use App\Models\Logs;

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

        Logs::firstOrCreate([
            'dt' => date('Y-m-d h:i:s', time()),
            'method' => 'GET', 
            'url' => env('RSS_URL'), 
            'code' => $response->status(), 
            'body' => $response->body()
        ]);

        foreach ($rss->channel->item as $item)
        {
            $n = News::firstOrCreate([
                'title' => $item->title,
                'link' => $item->link,
                'description' => $item->description,
                'published' => strftime("%Y-%m-%d %H:%M:%S", strtotime($item->pubDate)),
                'author' => $item->author ? $item->author : null
            ]);

            if ($n->wasRecentlyCreated) 
            {
                if (isset($item->enclosure))
                {
                    foreach ($item->enclosure as $e)
                    {
                        if ($e['type'] == 'image/jpeg')
                        {
                            Photos::firstOrCreate([
                                'news_id' => $n->id,
                                'photo_url' => $e['url']
                            ]);
                        }
                    }
                }
            }
        }
    }
}
