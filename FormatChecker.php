<?php

class FormatChecker extends AbstractFormatChecker
{

    /**
     * checkRequired
     */
    protected function check_required($name, $args = [])
    {
        if (!isset($this->params[$name])) {
            throw new Exception('Der Parameter ' . $name . ' muss gesetzt sein.', 100);
        }
    }

    /**
     * check_max
     */
    protected function check_strlen_max($name, $args = [])
    {
        $max = $args['strlen_max'];
        $value = $this->params[$name];
        if (strlen($value) > $max) {
            $this->params[$name] = mb_strimwidth($value, 0, $max, null, 'UTF-8');
        }
        $this->params[$name] = $value;
    }

}