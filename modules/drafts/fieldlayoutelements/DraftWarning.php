<?php

namespace modules\drafts\fieldlayoutelements;

use Craft;
use craft\base\ElementInterface;
use craft\elements\Entry;
use craft\fieldlayoutelements\BaseUiElement;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use yii\base\Exception;

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
    protected function selectorIcon()
    {
        return '@app/icons/alert.svg';
    }


    /**
     * @param ElementInterface|null $element
     * @param bool $static
     * @return string|null
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws Exception
     */
    public function formHtml(ElementInterface $element = null, bool $static = false)
    {
        if (!$element instanceof Entry) {
            return '';
        }

        return Craft::$app->view->renderTemplate('drafts/draft_warning.twig',
            ['element' => $element]);
    }
}
