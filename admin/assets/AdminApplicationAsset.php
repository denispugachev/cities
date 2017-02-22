<?php

namespace admin\assets;

use yii\web\AssetBundle;

/**
 * Admin application asset bundle.
 */
class AdminApplicationAsset extends AssetBundle
{
    /** {@inheritDoc} */
    public $basePath = '@webroot';

    /** {@inheritDoc} */
    public $baseUrl = '@web';

    /** {@inheritDoc} */
    public $css = [
        'css/site.css',
    ];

    /** {@inheritDoc} */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
