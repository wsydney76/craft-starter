<?php

namespace project\modules\main\console\controllers;

use craft\console\Controller;
use yii\console\ExitCode;

class TestController extends Controller
{

    /**
     *
     * .\craft main/test/hello-world
     *
     * @return int
     */
    public function actionHelloWorld()
    {
        $this->stdout('Hello World');
        return ExitCode::OK;
    }
}
