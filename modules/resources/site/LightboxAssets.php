<?php

namespace modules\resources\site;

use craft\web\AssetBundle;

class LightboxAssets extends AssetBundle
{
    public function init()
    {
        $this->js = [
            'https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.0/dist/baguetteBox.min.js'
        ];

        $this->css = [
            'https://cdn.jsdelivr.net/npm/baguettebox.js@1.11.0/dist/baguetteBox.min.css'
        ];
    }
}
