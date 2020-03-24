<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
    ],
    'modules' => [
        'rbac' => 'dektrium\rbac\RbacWebModule',

        'user' => [
            'class' => 'dektrium\user\Module',
            'admins' => ['administrator']
        ],
        'files' => [
            'class' => 'floor12\files\Module',
            'storage' => '@frontend/web/storage',
            'cache' => '@frontend/web/storage_cache',
            'token_salt' => 'ywFLlGO5SCCkcxj9hg7-7whsZYNzR8cd',
        ],
    ]
];
