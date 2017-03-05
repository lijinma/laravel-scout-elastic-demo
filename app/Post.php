<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

/**
 * Class Post
 * @package App
 * @property string $url
 * @property string $author
 * @property string $content
 * @property string $title
 * @property string $post_date
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends Model
{
    use Searchable;
    protected $table = 'posts';

    protected $fillable = [
        'url',
        'author',
        'title',
        'content',
        'post_date'
    ];

    public $searchSettings = [
        'attributesToHighlight' => [
            '*'
        ]
    ];

    public $highlight = [];

    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'content' => $this->content
        ];
    }
}
