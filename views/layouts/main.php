<?php

/** @var yii\web\View $this */

/** @var string $content */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">

    <head>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>

    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    <?= $this->render('header') ?>

    <?= $this->render('menu-start-mobile') ?>

    <?= $content ?>
    
    <?= $this->render('footer') ?>

    <?= $this->render('quick-view') ?>

    <?= $this->render('location') ?>

    <?= $this->render('cookie-bar') ?>

    <?= $this->render('deal-box') ?>

    <?= $this->render('tap-to-top') ?>

    <?= $this->render('bg-overlay') ?>

    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>