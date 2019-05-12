<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\FormData;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', ['formData' => FormData::find()->all()]);
    }
}
