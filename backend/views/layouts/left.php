<?php

use yii\helpers\Url;

?>

<aside class="main-sidebar">
    <section class="sidebar">
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    [
                        'label' => 'Статьи',
                        'icon' => 'id-card',
                        'url' => Url::to(['article/index']),
                        'active' => Yii::$app->controller->id === 'author',
                    ],
                    [
                        'label' => 'Страницы',
                        'icon' => 'folder',
                        'items' => [
                            [
                                'label' => 'О нас',
                                'icon' => 'info',
                                'url' => Url::to(['about-page/index']),
                                'visible' => ['admin']
                            ]
                        ]
                    ]
                ]
            ]
        ) ?>
    </section>
</aside>