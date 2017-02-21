<?php

/* @var $this \yii\web\View */
/* @var $content string */

use admin\assets\AdminApplicationAsset;
use common\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Html;

AdminApplicationAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Alert::widget() ?>

        <?php if (!Yii::$app->user->isGuest) { ?>
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Your API access token</h3>
                </div>
                <div class="panel-body">
                    <?= Yii::$app->user->getIdentity()->access_token; ?>
                </div>
            </div>
        <?php } ?>

        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="text-center"><strong>Cities sample RESTful application</strong></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
