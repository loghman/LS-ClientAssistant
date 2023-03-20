<?php

namespace Ls\ClientAssistant\Utilites\Modules;

class CMS
{
    public static function getPost(int $id, array $with = ['comment', 'product'])
    {
        // Including category
    }

    public static function getPosts(array $with = [], int $perPage = 20)
    {

    }

    public static function search(string $keyword, array $columns = [], array $with = [],  int $perPage = 20)
    {

    }

    public static function filter(array $keyValues = [], array $with = [], int $perPage = 20, $orderBy = 'latest')
    {
        // $orderBy => 'most_visited', 'latest', 'most_visited', 'most_commented', 'first', 'cheapest', ''
        $keyValues = [
            'author_id' => 1,
            'category_id' => 1,
        ];
    }

    public static function signal(int $postId, string $type, string $value)
    {
        //Example: type: 'visit', 'like', 'dislike', 'rate', 'bookmark',
        //         value: 1
    }
}