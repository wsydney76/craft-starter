<?php

namespace modules\main;

use Craft;
use craft\events\DefineFieldLayoutElementsEvent;
use craft\models\FieldLayout;
use modules\main\fieldlayoutelements\NewRow;
use yii\base\Event;
use yii\base\Module;

class MainModule extends Module
{
    public function init()
    {

        Craft::setAlias('@modules/main', $this->getBasePath());

        // Set the controllerNamespace based on whether this is a console or web request
        $this->controllerNamespace = Craft::$app->request->isConsoleRequest ?
            'modules\\main\\console\\controllers' :
            'modules\\main\\controllers';

        // Add Drafts Warning to UI Elements
        Event::on(
            FieldLayout::class,
            FieldLayout::EVENT_DEFINE_UI_ELEMENTS, function(DefineFieldLayoutElementsEvent $event) {
            if ($event->sender->type == 'craft\\elements\\Entry') {
                $event->elements[] = new NewRow();
            }
        }
        );
    }
}
