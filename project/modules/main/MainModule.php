<?php

namespace project\modules\main;

use Craft;
use craft\events\DefineFieldLayoutElementsEvent;
use craft\models\FieldLayout;
use project\modules\main\fieldlayoutelements\NewRow;
use yii\base\Event;
use yii\base\Module;

class MainModule extends Module
{
    public function init()
    {
        // Set the controllerNamespace based on whether this is a console or web request
        $this->controllerNamespace = Craft::$app->request->isConsoleRequest ?
            'project\\modules\\main\\console\\controllers' :
            'project\\modules\\main\\controllers';

        // Add Drafts Warning to UI Elements
        Event::on(
            FieldLayout::class,
            FieldLayout::EVENT_DEFINE_UI_ELEMENTS, function(DefineFieldLayoutElementsEvent $event) {
            if ($event->sender->type == 'craft\\elements\\Entry') {
                $event->elements[] = new NewRow();
            }
        }
        );

        if (Craft::$app->request->getIsCpRequest()) {
            $user = Craft::$app->user->identity;
            if ($user && $user->disableFieldHandles) {
                Craft::$app->view->registerCss('.field .heading .code.small.copytextbtn {display:none;}');
            }
        }

    }
}
