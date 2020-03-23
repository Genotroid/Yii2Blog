<?php
/* @var $this \yii\web\View */

use yii\helpers\Url;
?>
<?php foreach ($items as $item) { ?>
    <div class="item">
        <div class="box">
            <div class="row">
                <div class="box-header">
                    <h3 class="title"><?= $item->editor->username ?></h3>
                </div>
                <div class="box-body">
                    <p><?=$item->text?></p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>