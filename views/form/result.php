<?php

use yii\helpers\Html;
?>

<div class="alert alert-info">
    Thank you. Result is <strong><?= $result ?></strong>
</div>

<?= Html::a( 'Go back to form', ['form/index'], ['class' => 'btn btn-primary']) ?>
