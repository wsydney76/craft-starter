<?php

namespace modules\drafts;

use Craft;
use craft\base\Element;
use craft\elements\Entry;
use craft\elements\User;
use craft\events\DefineFieldLayoutElementsEvent;
use craft\events\RegisterElementTableAttributesEvent;
use craft\events\RegisterTemplateRootsEvent;
use craft\events\SetElementTableAttributeHtmlEvent;
use craft\helpers\ElementHelper;
use craft\i18n\PhpMessageSource;
use craft\models\FieldLayout;
use craft\web\View;
use modules\drafts\fieldlayoutelements\DraftWarning;
use yii\base\Event;
use yii\base\Module;

class DraftsModule extends Module
{
    public function init()
    {

        Craft::setAlias('@modules/drafts', $this->getBasePath());

        parent::init();

        if (!Craft::$app->request->isCpRequest) {
            return;
        }

        // Set template root for cp requests
        Event::on(
            View::class,
            View::EVENT_REGISTER_CP_TEMPLATE_ROOTS, function(RegisterTemplateRootsEvent $event) {
            $event->roots['drafts'] = __DIR__ . DIRECTORY_SEPARATOR . 'templates';
        }
        );

        // Add Drafts Warning to UI Elements
        Event::on(
            FieldLayout::class,
            FieldLayout::EVENT_DEFINE_UI_ELEMENTS, function(DefineFieldLayoutElementsEvent $event) {
            if ($event->sender->type == 'craft\\elements\\Entry') {
                $event->elements[] = new DraftWarning();
            }
        }
        );

        // Register translation category
        Craft::$app->i18n->translations['drafts'] = [
            'class' => PhpMessageSource::class,
            'sourceLanguage' => 'en',
            'basePath' => __DIR__ . '/messages',
            'allowOverrides' => true,
        ];

        // Inject template into entries edit screen
        $user = Craft::$app->user->identity;
        if ($user && !$user->disableDraftHints) {
            Craft::$app->view->hook('cp.entries.edit.details', function(array $context) {
                if ($context['entry'] === null) {
                    return '';
                }
                return Craft::$app->view->renderTemplate(
                    'drafts/entries_edit_details',
                    ['context' => $context]);
            });
        }

        Event::on(
            Entry::class,
            Element::EVENT_REGISTER_TABLE_ATTRIBUTES, function(RegisterElementTableAttributesEvent $event) {
            $event->tableAttributes['draftNotes'] = ['label' => Craft::t('drafts', 'Draft Notes')];
            $event->tableAttributes['creatorId'] = ['label' => Craft::t('drafts', 'Draft Creator')];
        }
        );
        Event::on(
            Entry::class,
            Element::EVENT_SET_TABLE_ATTRIBUTE_HTML, function(SetElementTableAttributeHtmlEvent $event) {

            if ($event->attribute == 'creatorId') {
                $event->handled = true;
                /** @var Entry $entry */
                $entry = $event->sender;

                if (ElementHelper::isDraftOrRevision($entry)) {
                    /** @var User $user */
                    $user = User::find()->id($entry->creatorId)->one();
                    $event->html = $user ? $user->name : '';
                } else {
                    $event->html = '';
                }
            }

            if ($event->attribute == 'draftNotes') {
                $event->handled = true;
                /** @var Entry $entry */
                $entry = $event->sender;

                $event->html = ElementHelper::isDraftOrRevision($entry) ? $entry->draftNotes : '';
            }
        }
        );
    }
}
