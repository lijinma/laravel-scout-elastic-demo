<?php namespace App\Libraries;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Created by PhpStorm.
 * User: lijinma
 * Date: 04/03/2017
 * Time: 9:05 PM
 */
class WechatPostSpider
{

    /**
     * @var Crawler|null
     */
    protected $crawler;

    /**
     * @var string
     */
    protected $url;

    /**
     * WechatPostSpider constructor.
     * @param Client $client
     * @param $url
     */
    public function __construct(Client $client, $url)
    {
        $this->url = $url;
        $this->crawler = $client->request('GET', $url);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return trim($this->crawler->filter('title')->text());
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return trim($this->crawler->filter('.rich_media_content')->text());
    }

    /**
     * @return string
     */
    public function getAuthor()
    {
        return trim($this->crawler->filter('#post-date')->nextAll()->text());
    }

    /**
     * @return string
     */
    public function getPostDate()
    {
        return $this->crawler->filter('#post-date')->text();
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}