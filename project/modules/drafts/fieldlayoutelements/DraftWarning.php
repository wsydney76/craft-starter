<?php

namespace project\modules\drafts\fieldlayoutelements;

use Craft;
use craft\base\ElementInterface;
use craft\elements\Entry;
use craft\fieldlayoutelements\BaseUiElement;

class DraftWarning extends BaseUiElement
{
    /**
     * @inheritdoc
     */
    protected function selectorLabel(): string
    {
        return Craft::t('drafts', 'Draft Warning');
    }

    /**
     * @inheritdoc
     */
    public function formHtml(ElementInterface $element = null, bool $static = false)
    {
        if (!$element instanceof Entry) {
            return '';
        }
        return Craft::$app->view->renderTemplate('drafts/draft_warning.twig', ['element' => $element]);
    }
}
