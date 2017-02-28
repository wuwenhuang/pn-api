<?php
namespace App\Services\Validator;

abstract class Validator
{
    public function __construct($request)
    {
        $this->validateEmpty($request);
    }

    abstract protected function validateEmpty($request);
}