<?php

class Check implements ArrayAccess, IteratorAggregate
{
    protected $data = [
        'checks' => [],
        'args' => [],
    ];

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this);
    }

    /**
     * parse the rules
     */
    public function parse(string $checkExpression)
    {

        $checks = explode('|', $checkExpression);

        foreach ($checks as $check) {
            if (strpos($check, ':') !== false) {
                $arr = [];
                $arr = explode(':', $check);
                $check = $arr[0];
                $args =  $this->data['args'];
                $args[$arr[0]] = $arr[1];
                $this->data['args'] = $args;
            }
            array_push($this->data['checks'], $check);
        }
    }
}
