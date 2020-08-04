<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\Entry;
use craft\elements\GlobalSet;

/**
 * m200213_103908_setup migration.
 */
class m200213_103908_setup extends Migration
{

    /**
     * @return bool|void
     * @throws \Throwable
     * @throws \craft\errors\ElementNotFoundException
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {

        $entry = Entry::find()->section('search')->site('de')->one();
        if ($entry) {
            $entry->title = 'Suche';
            Craft::$app->elements->saveElement($entry);
        }

        $entry = Entry::find()->section('postIndex')->site('en')->one();
        if ($entry) {
            $entry->title = 'Posts';
            $entry->setFieldValue('teaser', 'New Stuff');
            Craft::$app->elements->saveElement($entry);
        }
        $entry = Entry::find()->section('postIndex')->site('de')->one();
        if ($entry) {
            $entry->title = 'Beiträge';
            $entry->setFieldValue('teaser', 'Das Neueste');
            Craft::$app->elements->saveElement($entry);
        }

        $entry = Entry::find()->section('topicIndex')->site('en')->one();
        if ($entry) {
            $entry->title = 'Topics';
            Craft::$app->elements->saveElement($entry);
        }
        $entry = Entry::find()->section('topicIndex')->site('de')->one();
        if ($entry) {
            $entry->title = 'Themen';
            Craft::$app->elements->saveElement($entry);
        }

        $entry = Entry::find()->section('about')->site('de')->one();
        if ($entry) {
            $entry->title = 'Über uns';
            Craft::$app->elements->saveElement($entry);
        }

        $global = GlobalSet::find()->handle('siteInfo')->one();
        if ($global) {
            $global->setFieldValue('siteName', 'Starter');
            $global->setFieldValue('copyright', 'Starter GmbH');
            Craft::$app->elements->saveElement($global);
        }

        $global = GlobalSet::find()->handle('siteNavigation')->one();
        if ($global) {
            $entryIds = [];
            foreach (['postIndex', 'topicIndex', 'about'] as $handle) {
                $entry = Entry::find()->section($handle)->one();
                if ($entry) {
                    $entryIds[] = $entry->id;
                }
            }
            $global->setFieldValue('primaryNavigation', [
                'new1' => [
                    'type' => 'topLevelLinks',
                    'fields' => [
                        'entries' => $entryIds
                    ]
                ]
            ]);
            Craft::$app->elements->saveElement($global);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m200213_103908_setup cannot be reverted.\n";
        return false;
    }
}
