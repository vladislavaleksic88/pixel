<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin();

foreach ($formFields as $index => $formField) {
    echo $form->field($formField, "[$index]value")->label($formField->name);
}

echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);

ActiveForm::end();
