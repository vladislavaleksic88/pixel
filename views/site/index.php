<?php

use yii\helpers\Html;
?>

<h1>History</h1>

<?php if (!$formData): ?>
<div class="alert alert-info">
    No form data yet.
</div>
<?php endif; ?>

<?php if ($formData): ?>
<table class="table">
    <thead>
        <tr>
            <th scope="col">Parameters</th>
            <th scope="col">Result</th>
            <th scope="col">Browser</th>
            <th scope="col">Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($formData as $formDataRecord): ?>
            <tr>
                <th scope="row"><?= Html::encode($formDataRecord->parameters) ?></th>
                <td><?= Html::encode($formDataRecord->result) ?></td>
                <td><?= Html::encode($formDataRecord->browser) ?></td>
                <td><?= Html::encode($formDataRecord->created_at) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>

<?= Html::a( 'Go to the form', ['form/index'], ['class' => 'btn btn-primary']); ?>
