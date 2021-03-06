<?php

namespace craft\contentmigrations;

use Craft;
use craft\db\Migration;
use craft\elements\User;

/**
 * m200619_092625_assetindexes_settings migration.
 */
class m200619_092625_assetindexes_settings extends Migration
{

    public $sources = [
        'siteHeading' => ['type' => 'heading', 'heading' => 'Site Assets'],
        'images' => ['type' => 'key', 'tableAttributes' => ['filename', 'imageSize', 'dateModified', 'link']],
        'embeds' => ['type' => 'key', 'tableAttributes' => ['provider', 'filename', 'dateModified', 'link']],
        'downloadsHeading' => ['type' => 'heading', 'heading' => 'Downloads'],
        'documents' => ['type' => 'key', 'tableAttributes' => ['filename', 'size', 'kind', 'dateModified', 'link']],
        'internalHeading' => ['type' => 'heading', 'heading' => 'Internal'],
        'userPhotos' => ['type' => 'key', 'tableAttributes' => ['filename', 'imageSize', 'dateModified', 'link']],
        'temporaryUploads' => ['type' => 'key', 'tableAttributes' => ['filename', 'imageSize', 'dateModified']]
    ];

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $assetSettings = [
            'sources' => [],
            'sourceOrder' => []
        ];

        foreach ($this->sources as $handle => $source) {
            if ($source['type'] == 'key') {
                $volume = Craft::$app->volumes->getVolumeByHandle($handle);
                if ($volume) {
                    $rootFolder = Craft::$app->assets->getRootFolderByVolumeId($volume->id);
                    if ($rootFolder) {
                        $assetSettings['sources']['folder:' . $rootFolder->uid] = [
                            'tableAttributes' => $source['tableAttributes'],
                        ];
                        $assetSettings['sourceOrder'][] = ['key', 'folder:' . $rootFolder->uid];
                    }
                }
            }
            if ($source['type'] == 'heading') {
                $assetSettings['sourceOrder'][] = ['heading', $source['heading']];
            }
        }


        Craft::$app->elementIndexes->saveSettings('craft\\elements\\Asset', $assetSettings);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "There is nothing to be reverted.\n";
        return true;
    }
}
