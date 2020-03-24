<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;

/* @var $this yii\web\View */
/* @var $model common\models\AboutPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="about-page-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-lg-10">
            <div class="box">
                <div class="box-header">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="box-body">
                    <?= $form->field($model, 'content')->widget(TinyMce::class, ['options' => ['rows' => 20]]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
