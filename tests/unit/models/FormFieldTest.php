<?php

namespace test\unit\models;

use app\models\FormField;

class FormFieldTest extends \Codeception\Test\Unit
{
    public function testFormFieldWithNoLimits()
    {
        $formField = new FormField;

        $formField->name = 'test';
        $formField->value = 10;
        $this->assertTrue($formField->validate());
    }

    public function testFormFieldWithMinLimit()
    {
        $formField = new FormField;

        $formField->name = 'test';
        $formField->min = 20;
        $formField->value = 10;
        $this->assertFalse($formField->validate());
    }

    public function testFormFieldWithMaxLimit()
    {
        $formField = new FormField;

        $formField->name = 'test';
        $formField->max = 5;
        $formField->value = 10;
        $this->assertFalse($formField->validate());
    }

    public function testFormFieldWithMinAndMaxLimits()
    {
        $formField = new FormField;

        $formField->name = 'test';
        $formField->min = 5;
        $formField->max = 8;
        $formField->value = 10;
        $this->assertFalse($formField->validate());
        $formField->value = 8;
        $this->assertTrue($formField->validate());
    }
}
