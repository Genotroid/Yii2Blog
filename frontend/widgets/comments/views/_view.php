<?php
/* @var $this \yii\web\View */

use yii\helpers\Url;

?>
<?php foreach ($items as $item) { ?>
    <div class="item">
        <div class="box">
            <div class="box-header" style="background-color: #c0c0c0">
                <h3 class="title"><?= $item->editor->username ?></h3>
            </div>
            <div class="box-body">
                <p><?= \yii\helpers\Html::encode($item->text) ?></p>
            </div>
        </div>
    </div>
<?php } ?>