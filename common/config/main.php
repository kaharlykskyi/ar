<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',

        '@prjpath' => Yii::getAlias('@frontend').'/web',
        '@repository' => Yii::getAlias('@frontend').'/web/uploads',
        '@repository_www' => '/uploads',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'name' => 'ArtViza',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'tcpdf' => [
            'class' => 'cinghie\tcpdf\TCPDF',
        ],
    ],
];
