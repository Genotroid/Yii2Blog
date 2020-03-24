<?php

use yii\helpers\Html;

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header text-center">
                        <h1><b><?= $model->title ?></b></h1>
                    </div>
                    <div class="box-body text-center">
                        <?php if ($mainPic = $model->main_pic) { ?>
                            <?= \yii\helpers\Html::img(
                                $mainPic->getPreviewWebPath(),
                                [
                                    'alt' => $model->title
                                ]
                            ) ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <p><?= $model->content ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-8 offset-2">
            <?php if(!\Yii::$app->user->isGuest) { ?>
            <div class="row">
                <?= frontend\widgets\comments\AddComment::widget(['slug' => $model->slug]) ?>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-lg-10">
                    <?= frontend\widgets\comments\Comments::widget(['model' => $model]) ?>
                </div>
            </div>
        </div>
    </div>
</section>
