<?php

namespace frontend\widgets\comments;


use yii\base\Widget;

class Comments extends Widget
{
    //Виджет просмотра комментариев статьи
    public $model; //модель статьи
    public function run()
    {
        return $this->render('_view', [
            'items' => $this->model->comments,
        ]);
    }
}