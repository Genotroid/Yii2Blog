<?php

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = 'Редактирование статьи: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="article-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
