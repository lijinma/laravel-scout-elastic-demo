<?php namespace App\Libraries;
/**
 * Created by PhpStorm.
 * User: lijinma
 * Date: 05/03/2017
 * Time: 4:53 PM
 */

trait EsSearchable
{
    public $searchSettings = [
        'attributesToHighlight' => [
            '*'
        ]
    ];

    public $highlight = [];
}