<?php

use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;

?>

<?php $form = ActiveForm::begin([
    'id' => 'review-form',
    'action' => Url::toRoute(['/article/add-comment', 'slug' => $slug]),
]) ?>

<?= $form->field($model, 'text')->textarea(['maxlength' => 70])->label($model->getAttributeLabel('text')) ?>

<?= Html::submitButton("Отправить", ['class' => 'btn']) ?>

<?php $form::end() ?>
