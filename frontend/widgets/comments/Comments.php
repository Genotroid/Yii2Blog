<?php

namespace frontend\widgets\comments;


use yii\base\Widget;

class Comments extends Widget
{
    public $model;
    public function run()
    {
        return $this->render('_view', [
            'items' => $this->model->comments,
        ]);
    }
}