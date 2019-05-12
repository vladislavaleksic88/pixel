<?php

namespace app\services;

use app\models\FormField;
use app\models\FormData;
use app\services\FormParser;

class FormManager
{
    public $fields = [];
    public $resultExpression = '';

    public function __construct($file)
    {
        $formParser = new FormParser($file);
        $this->_makeFormFieldModels($formParser->getParameters());
        $this->resultExpression = $formParser->getResultExpression();
    }

    /**
     * Returns parameters as a list of FormField models.
     * 
     * @return FormField[] array of empty FormField models
     */
    public function getFormFieldModels()
    {
        return $this->fields;
    }

    /**
     * Saves user inputs to DB and returns evaluated result expression.
     * 
     * @param FormField[] $formFields array of populated FormField models
     * @param string $userAgent informations about user's browser
     * @return string
     */
    public function saveAndGetResult($formFields, $userAgent)
    {
        $parameters = $this->_getFormatedParameters($formFields);
        $result = $this->_getResult($formFields);
        $this->_saveToDB($parameters, $result, $userAgent);

        return $result;
    }

    /**
     * Creates array of FormField models from parameters.
     * 
     * @param array $parameters array of objects with name, min and max properties
     */
    private function _makeFormFieldModels($parameters)
    {
        foreach ($parameters as $parameter) {
            $this->fields[$parameter['name']] = $this->_createFieldModel($parameter);
        }
    }

    /**
     * Creates FormField model.
     * 
     * @param string $name
     * @param float $min
     * @param float $max
     * 
     * @return FormField
     */
    private function _createFieldModel($parameter)
    {
        $fieldModel = new FormField();
        $fieldModel->name = $parameter['name'];
        $fieldModel->min = $parameter['min'];
        $fieldModel->max = $parameter['max'];

        return $fieldModel;
    }

    /**
     * Formats array of FormField models for DB input.
     * 
     * @param FormField[] $formFields array of populated FormField models
     * @return array list of names and values of user's form input
     */
    private function _getFormatedParameters($formFields)
    {
        return array_reduce($formFields, function ($result, $formField) {
            $result[$formField->name] = $formField->value;

            return $result;
        }, []);
    }

    /**
     * Evaluates result expression based on user input.
     * 
     * @param FormField[] $formFields array of populated FormField models
     * @return string result of evaluated expression
     */
    private function _getResult($formFields)
    {
        $result = $this->resultExpression;

        foreach ($formFields as $formField) {
            $result = str_replace($formField->name, $formField->value, $result);
        }

        return eval(sprintf('return %s;', $result));
    }

    /**
     * Saves user form inputs to DB via FormData model
     * 
     * @param array  $parameters list of names and values of user's form input
     * @param string $result evaluated result expression
     * @param string $browser informations about user's browser
     * @return string result of evaluated expression
     */
    private function _saveToDB($parameters, $result, $browser)
    {
        $formData = new FormData();
        $formData->parameters = $parameters;
        $formData->result = $result;
        $formData->browser = $browser;
        $formData->save();
    }
}
