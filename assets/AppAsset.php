<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'template/css/vendors/font-awesome.css',
        'template/css/vendors/feather-icon.css',
        'template/css/vendors/slick/slick.css',
        'template/css/vendors/slick/slick-theme.css',
        'template/css/bulk-style.css',
        'template/css/style.css',
        // 'https://fonts.gstatic.com',
        'https://fonts.googleapis.com/css2?family=Russo+One&display=swap',
        'https://fonts.googleapis.com/css2?family=Pacifico&display=swap',
        'https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap',
        'https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap',
        'https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap',

    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
