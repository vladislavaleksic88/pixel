<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Json;

class FormData extends ActiveRecord
{
    // id, parameters, result, browser, created_at

    /**
     * @return array the behaviors
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at']
                ],
                'value' => new Expression('NOW()')
            ]
        ];
    }

    /**
     * Converts parameters to JSON before saving to DB.
     * 
     * @param boolean $insert
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
    
        $this->parameters = Json::encode($this->parameters);

        return true;
    }
}
