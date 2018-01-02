<?php


namespace Source\Definition;


class Path
{
    public static function getPaths()
    {
        return
            [
                'MVC' =>
                    [
                        'MODELS' => __DIR__ . '/../MVC/Model',
                        'VIEWS' => __DIR__ . '/../MVC/View',
                        'CONTROLLERS' => __DIR__ . '/../MVC/Controller'
                    ]
            ];
    }
}