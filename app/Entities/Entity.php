<?php

namespace App\Entities;

abstract class Entity
{
    protected $fieldMap = [];

    public function __construct(array $fields = [], $mapping = false)
    {
        foreach ($fields as $field => $value){
            $mapping ? $this->fieldMapSet($field, $value) : $this->fieldSet($field, $value);
        }
    }

    protected function fieldMapSet($field, $value) {
        if (isset($this->fieldMap[$field])) {
            $name = $this->fieldMap[$field];
            $value = $this->preProcessField($name, $value);
            $this->$name = $value;
        }
    }

    protected function fieldSet($field, $value) {
        $this->$field = $value;
    }

    protected function preProcessField($name, &$value) {
        return $value;
    }

    public function setModelAttributes($entities, $list = false) {
        return $list ? collect($entities)->map(function ($entity) {
            return new static($entity, true);
        }) : new static($entities, true);
    }

}
