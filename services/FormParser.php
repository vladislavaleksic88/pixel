<?php

namespace app\services;

class FormParser
{
    const XML_PARAMETER = 'parametro'; // name of XML tag of each parameter definition
    const XML_RESULTS = 'risultato';   // name of XML tag of result expression
    const XML_NAME = 'nome';           // name of XML attribute for parameter name
    const XML_MIN = 'maggiore';        // name of XML tag for parameter's lower limit
    const XML_MAX = 'minore';          // name of XML tag for parameter's upper limit

    public $xml = null;

    public function __construct($file)
    {
        $xml = simplexml_load_file($file) or die(sprintf('Error: Cannot read %s XML file.', $file));
        $this->xml = json_decode(json_encode($xml), true); // turns SimpleXMLElement to array
    }

    /**
     * Parses parameters from XML file and creates array parameter definitions.
     * 
     * @return array array of parameter definitions from XML file
     */
    public function getParameters()
    {
        if (!$this->xml || !isset($this->xml[self::XML_PARAMETER])) {
            return [];
        }

        return array_map(function ($parameter) {
            return [
                'name' => $parameter['@attributes'][self::XML_NAME],
                'min' => $this->_getFloatOrNull($parameter, self::XML_MIN),
                'max' => $this->_getFloatOrNull($parameter, self::XML_MAX)
            ];
        }, $this->xml[self::XML_PARAMETER]);
    }

    /**
     * Returns float value of object's parameter or null if it does not exists.
     * 
     * @param object $object
     * @param string $parameterName
     * @param float|null
     */
    private function _getFloatOrNull($array, $key)
    {
        return isset($array[$key]) ? (float) $array[$key] : null;
    }

    /**
     * Parses result expression from XML file.
     * 
     * @param SimpleXMLElement $xml loaded XML file
     */
    public function getResultExpression()
    {
        return $this->xml && isset($this->xml[self::XML_RESULTS])
            ? $this->xml[self::XML_RESULTS]
            : '';
    }
}
