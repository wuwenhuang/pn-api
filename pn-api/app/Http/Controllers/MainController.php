<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class MainController extends BaseController
{
    /**
     * Call Custom App\Models\{Model} Protected Method
     *
     * @param $model
     * @param string $method
     * @param array $params
     *
     * @return mixed
     */
    protected static function call_model_method( $model, $method = '', $params = [], $toArray = true ){

        $my_model = "App\\Models\\" . $model;

        $ref = new \ReflectionClass( $my_model );

        $my_method = $ref->getMethod( $method );

        $my_method->setAccessible(true);

        $result = $my_method->invokeArgs( new $my_model(),  [ serialize($params) ]);

        if( $toArray and is_array($result) ){
            $result = array_values( $result );
        }

        return $result;
    }
}
