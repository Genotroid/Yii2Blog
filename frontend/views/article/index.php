<?php
/* @var $articles array */

use yii\helpers\Html;

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = \yii\helpers\Html::encode($this->title);
?>
<div class="col-md-12">
    <div class="row">
        <?php foreach ($articles as $article) { ?>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header">
                    <h2 class="article-title">
                        <a href="<?= \yii\helpers\Url::toRoute(['article/view', 'slug' => $article->slug]) ?>">
                            <?= \yii\helpers\Html::encode($article->title) ?>
                        </a>
                    </h2>
                    <p class="date">
                        <?= date('d.m.Y', $article->created_at) ?>
                    </p>
                    <p class="author">
                        <?= $article->editor->username ?>
                    </p>
                </div>
                <div class="box-body">
                    <?php if ($image = $article->main_pic) { ?>
                        <?= \yii\helpers\Html::img(
                            $image->getPreviewWebPath(300),
                            [
                                'alt' => $model->title
                            ]
                        ) ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>


