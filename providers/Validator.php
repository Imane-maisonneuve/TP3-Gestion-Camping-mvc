<?php

namespace App\Providers;

class Validator
{
    private $errors = array();
    private $key;
    private $value;
    private $name;

    public function field($key, $value, $name = null)
    {
        $this->key = $key;
        $this->value = $value;
        if ($name == null) {
            $this->name = ucfirst($key);
        } else {
            $this->name = ucfirst($name);
        }
        return $this;
    }

    //regles
    public function required()
    {
        if (empty($this->value)) {
            // $this->errors[$this->key] = "$this->name is required.";
            $this->errors[$this->key] = "Ce champ est requis.";
        }
        return $this;
    }

    public function max($length)
    {
        if (strlen($this->value) > $length) {
            $this->errors[$this->key] = "$this->name must be less than $length characters.";
        }
        return $this;
    }

    public function min($length)
    {
        if (strlen($this->value) < $length) {
            $this->errors[$this->key] = "$this->name must be more than $length characters.";
        }
        return $this;
    }

    public function int()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_INT)) {
            // $this->errors[$this->key] = "$this->name must be a interger";
            $this->errors[$this->key] = "Ce champ doit être un entier";
        }
        return $this;
    }

    public function email()
    {
        if (!empty($this->value) && !filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
            //$this->errors[$this->key] = "Invalid $this->name format.";
            $this->errors[$this->key] = "Invalid $this->name format.";
        }
        return $this;
    }

    public function bigger($limit)
    {
        if ($this->value >= $limit) {
            $this->errors[$this->key] = "$this->name must be less than or equal to $limit.";
        }
        return $this;
    }

    public function validateDate($format = 'Y-m-d')
    {
        $date = \DateTime::createFromFormat($format, $this->value);
        if (!$date || $date->format($format) !== $this->value) {
            $this->errors[$this->key] = "Format de date invalide. Veuillez utiliser le format $format .";
        }
        return $this;
    }

    //regles fin

    public function isSuccess()
    {
        if (empty($this->errors)) return true;
    }

    public function getErrors()
    {
        if (!$this->isSuccess()) return $this->errors;
    }
}
