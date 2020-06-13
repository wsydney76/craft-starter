<?php

namespace project\modules\main;

use Craft;
use yii\base\Module;

class MainModule extends Module
{
    public function init()
    {
        // Set the controllerNamespace based on whether this is a console or web request
        $this->controllerNamespace = Craft::$app->request->isConsoleRequest ?
            'project\\modules\\main\\console\\controllers' :
            'project\\modules\\main\\controllers';

    }
}
