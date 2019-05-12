<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\web\Controller;
use yii\base\Model;
use app\models\FormField;
use app\models\FormData;
use app\services\FormManager;

class FormController extends Controller
{
    /**
     * Displays the form.
     *
     * @return Response|string
     */
    public function actionIndex()
    {
        $formManager = new FormManager(Yii::getAlias('@app/data/form-definition.xml'));
        $formFields = $formManager->getFormFieldModels();

        if (Model::loadMultiple($formFields, Yii::$app->request->post()) && Model::validateMultiple($formFields)) {
            $result = $formManager->saveAndGetResult($formFields, Yii::$app->request->userAgent);

            return $this->redirect(['form/result', 'result' => $result]);
        }

        return $this->render('index', ['formFields' => $formFields]);
    }

    /**
     * Displays results of the form.
     *
     * @return string
     */
    public function actionResult($result)
    {
        return $this->render('result', ['result' => $result]);
    }
}
