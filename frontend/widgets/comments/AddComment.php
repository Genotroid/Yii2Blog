<?php

namespace frontend\widgets\comments;

use common\models\Comment;
use yii\base\Widget;

class AddComment extends Widget
{
    //Виджет добавления нового комментраия
    public $slug; //slug статьи, для которой будет добавлен комментарий

    public function run()
    {
        return $this->render('_form', [
            'model' => new Comment(),
            'slug' => $this->slug,
        ]);
    }
}