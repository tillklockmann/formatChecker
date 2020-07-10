<?php

abstract class AbstractFormatChecker
{
    protected $checksCollection = [];

    protected $params;


    public function __construct($params)
    {
        $this->params = $params;
    }

    public function addCheck(string $paramName, string $checkExpression)
    {
        $check = new Check;
        $check->parse($checkExpression);
        $check['name'] = $paramName;

        $this->checksCollection[] = $check;
    }

    public function runChecks()
    {
        foreach ($this->checksCollection as $obj) {
            foreach ($obj['checks'] as $check) {
                $this->{'check_' . $check}($obj['name'], $obj['args']);
            }
        }
    }

    
}