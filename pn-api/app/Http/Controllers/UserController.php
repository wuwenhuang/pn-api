<?php

namespace App\Http\Controllers;

use App\Services\Validator\UserValidator;
use App\Services\Validator\Validator;
use Illuminate\Http\Response;

class UserController extends MainController
{
    public function getUsers()
    {
        $result = parent::call_model_method(
            'UserModel',
            'get_users',
            []
        );

        return response()->json($result, 200);
    }

    /**
     * Signup user
     *
     * @return mixed
     */
    public function signup()
    {
        $insert = app('request')->all();

        try {
            $userValidator = new UserValidator($insert);
        }catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }

        $result = parent::call_model_method(
            'UserModel',
            'create_user',
            [
                'insert' => $insert
            ]
        );

        return response()->json($result, 200);
    }

    /**
     * Change Password
     *
     * @param $userId
     * @return mixed
     */
    public function changePassword($userId)
    {
        $info = app('request')->all();

        if (empty($userId)) {
            return response()->json('No user id passed in', 401004);
        }

        if (!isset($info['password'])) {
            return response()->json('Password need passed in', 401006);
        }
        if (!isset($info['confirm_password'])) {
            return response()->json('Confirm password need passed in', 401007);
        }

        try {
            $userValidator = new UserValidator($info);
            $userValidator->validateConfirmPassword($info['password'], $info['confirm_password']);

        }catch (\Exception $e) {
            return response()->json($e->getMessage(), 401010);
        }

        $result = parent::call_model_method(
            'UserModel',
            'change_password',
            [
                'where' => ['_id' => $userId],
                'set' => $info
            ]
        );

        return response()->json($result, 200);
    }

    /**
     * Sign in user
     *
     * @return Response
     */
    public function signin()
    {
        $signin = app('request')->all();

        try {
            $userValidator = new UserValidator($signin);
        }catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }

        $result = parent::call_model_method(
            'UserModel',
            'find_user',
            ['where' => $signin]
        );

        if (empty($result)) {
            return response()->json('Could not find user', 403);
        }

        return response()->json($result, 200);
    }
}
