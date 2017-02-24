<?php

namespace App\Http\Controllers;

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

        $result = parent::call_model_method(
            'UserModel',
            'find_user',
            ['where' => $signin]
        );

        if (empty($result)) {
            return response('Could not find user', 400);
        }

        return response()->json($result, 200);
    }
}
