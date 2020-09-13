<?php

namespace modules\main\controllers;

use craft\web\Controller;

class TestController extends Controller
{

    public $allowAnonymous = ['hello-world'];

    /**
     * /actions/main/test/hello-world
     *
     * @return string
     */
    public function actionHelloWorld()
    {
        return 'Hello World';
    }
}
