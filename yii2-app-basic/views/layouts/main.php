<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
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
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $this->widget('zii.widgets.CMenu',array(
'items'=>array(
array('label'=>'Home', 'url'=>array('/site/index')),
array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
array('label'=>'Contact', 'url'=>array('/site/contact')),
array('label'=>'Login', 'url'=>array('/user/login'), 'visible'=>Yii::$app->user->isGuest),
array('label'=>'Register', 'url'=>array('/user/registration'), 'visible'=>Yii::$app->user->isGuest),
array('label'=>'Profile', 'url'=>array('/user/profile'), 'visible'=>!Yii::$app->user->isGuest),
array('label'=>'Logout ('.Yii::$app->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::$app->user->isGuest)
),
)); 
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; My Company <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
