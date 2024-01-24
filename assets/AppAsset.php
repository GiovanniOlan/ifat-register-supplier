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

        /**
         * Template css assets import
         *
         * @author GiovanniOLan <giovanniolanperez@gmail.com>
         */
        'https://fonts.googleapis.com/css2?family=Russo+One&display=swap',
        'https://fonts.googleapis.com/css2?family=Pacifico&display=swap',
        'https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap',
        'https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap',
        'https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap',
        'template/css/vendors/bootstrap.css',
        'template/css/animate.min.css',
        'template/css/vendors/font-awesome.css',
        'template/css/vendors/feather-icon.css',
        'template/css/vendors/slick/slick.css',
        'template/css/vendors/slick/slick-theme.css',
        'template/css/bulk-style.css',
        'template/css/vendors/animate.css',
        'template/css/style.css',
    ];
    public $js = [
        /**
         * Template js assets import
         *
         * @author GiovanniOLan <giovanniolanperez@gmail.com>
         */
        'template/js/jquery-3.6.0.min.js',
        'template/js/jquery-ui.min.js',
        'template/js/bootstrap/bootstrap.bundle.min.js',
        'template/js/bootstrap/bootstrap-notify.min.js',
        'template/js/bootstrap/popper.min.js',
        'template/js/feather/feather.min.js',
        'template/js/feather/feather-icon.js',
        'template/js/lazysizes.min.js',
        'template/js/slick/slick.js',
        'template/js/slick/slick-animation.min.js',
        'template/js/slick/custom_slick.js',
        'template/js/auto-height.js',
        'template/js/fly-cart.js',
        'template/js/quantity-2.js',
        'template/js/wow.min.js',
        'template/js/custom-wow.js',
        'template/js/script.js',
    ];
    public $depends = [
        /**
         * Disable yii2 jquery and yii2 bootstrap
         *
         * @author GiovanniOLan <giovanniolanperez@gmail.com>
         */
//        'yii\web\YiiAsset',
//        'yii\bootstrap5\BootstrapAsset'
    ];
}
