<?php
namespace App\Services\Validator;

class UserValidator extends Validator
{

    protected function validateEmpty($request)
    {
        if (empty($request)) {
            throw new \Exception('Request empty', 401003);
        }
    }

    public function validatePassword($password, $newPassword)
    {
        if ($password == $newPassword) {
            throw new \Exception('Password match with the new Passoword', 401001);
        }
    }

    public function validateConfirmPassword($newPassword, $confirmPassword)
    {
        if ($newPassword == $confirmPassword) {
            throw new \Exception('Password should be same as confirm password', 401002);
        }
    }
}