<?php

namespace App\Console\Commands;

use App\Libraries\WechatPostSpider;
use App\Post;
use Goutte\Client;
use Illuminate\Console\Command;

class ImportPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import posts!';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $client = new Client();
        foreach (config('post-urls') as $url) {
            /**
             * 这里 url 可能需要索引，但是用 url 做唯一标示不太好，索引太大
             */
            if (Post::where('url', $url)->exists()) {
                continue;
            }
            $wechatPostSpider = new WechatPostSpider($client, $url);
            $this->savePost($wechatPostSpider);
            $this->info('create one post!');
        }
    }

    protected function savePost(WechatPostSpider $wechatPostSpider)
    {
        Post::create([
            'url' => $wechatPostSpider->getUrl(),
            'author' => $wechatPostSpider->getAuthor(),
            'title' => $wechatPostSpider->getTitle(),
            'content' => $wechatPostSpider->getContent(),
            'post_date' => $wechatPostSpider->getPostDate(),
        ]);
    }
}
