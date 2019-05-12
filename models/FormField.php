<?php

namespace app\models;

use yii\base\Model;

class FormField extends Model
{
    public $name;
    public $value;
    public $min;
    public $max;


    /**
     * @return array the scenarios
     */
    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['value']
        ];
    }

    /**
     * @return array the validation rules
     */
    public function rules()
    {
        return [
            [
                'value',
                'required'
            ], [
                'value',
                'integer',
                'min' => $this->min,
                'when' => function ($model) {
                    return !empty($model->min);
                },
                'whenClient' => ''
            ], [
                'value',
                'integer',
                'max' => $this->max,
                'when' => function ($model) {
                    return !empty($model->max);
                }
            ]
        ];
    }
}
