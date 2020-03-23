<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">
    <div class="row">
        <?php $form = ActiveForm::begin(); ?>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-8">
                    <div class="box">
                        <div class="box-body">
                            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                            <?= $form->field($model, 'content')->widget(TinyMce::class, ['options' => ['rows' => 20]]) ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-body">
                            <?= $form->field($model, 'main_pic')->widget(floor12\files\components\FileInputWidget::class) ?>
                            <?= $form->field($model, 'status')->dropDownList($model::getStatuses()) ?>
                            <div class="form-group">
                                <?= Html::submitButton('Сохранть', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
