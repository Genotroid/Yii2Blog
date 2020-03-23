<?php

namespace frontend\widgets\comments;

use common\models\Comment;
use yii\base\Widget;

class AddComment extends Widget
{
    public $slug;

    public function run()
    {
        return $this->render('_form', [
            'model' => new Comment(),
            'slug' => $this->slug,
        ]);
    }
}