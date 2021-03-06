<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\AdminlteAsset;
use yii\widgets\Menu;

AdminlteAsset::register($this);
AppAsset::register($this);

// set timezone
Yii::$app->setTimeZone(Yii::$app->timezone->name);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> | <?= settings('website_title') ?></title>
    <meta name="description" content="<?= settings('website_description') ?>">
    <link rel="icon" href="<?= Url::to('@web/favicon.ico') ?>" type="image/x-icon" />
    <link rel="shortcut icon" href="<?= Url::to('@web/favicon.ico') ?>" type="image/x-icon" />
    <?php $this->head() ?>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition skin-purple fixed layout-top-nav">
<?php $this->beginBody() ?>

<div class="wrapper">

    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <?= Html::a(settings('website_title'), ['/'], ['class'=>'navbar-brand']) ?>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                    <?=
                    Menu::widget([
                        'options' => ['class' => 'nav navbar-nav'],
                        'items' => [
                            ['label' => Yii::t('app','How Works'),
                                'url' => ['/site/how-works'],
                                'template' => '<a href="{url}"><i class="fa fa-question"></i> {label}</a>',
                            ],
                            ['label' => Yii::t('app','Contact'),
                                'url' => ['/site/contact'],
                                'template' => '<a href="{url}"><i class="fa fa-envelope"></i> {label}</a>',
                            ],
                        ],
                    ]);
                    ?>

                    <ul class="nav navbar-nav navbar-right">
                      <?php if (Yii::$app->user->isGuest): ?>
                      <!-- Guess -->
                      <li class="bg-aqua">
                        <?= Html::a(Yii::t('app','Login'), ['/user/login'], ['class'=>'']) ?>
                      </li>
                      <!-- <li class="bg-red">
                        <?php //echo Html::a(Yii::t('app','Register'), ['/user/register'], ['class'=>'']) ?>
                      </li> -->
                      <?php else: ?>
                      <!-- User -->
                      <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <?= Html::img('img/icon-profile.png', ['class'=>'user-image', 'alt'=>'Imagen de usuario']) ?>
                          <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                        </a>
                        <ul class="dropdown-menu">
                          <!-- User image -->
                          <li class="user-header">
                            <?= Html::img('img/icon-profile.png', ['class'=>'img-circle', 'alt'=>'Imagen de usuario']) ?>

                            <p>
                              <?= Yii::$app->user->identity->username ?>
                            </p>
                          </li>
                          <!-- Menu Footer-->
                          <li class="user-footer">
                            <div class="pull-left">
                              <?= Html::a(Yii::t('app','Profile'), ['/user/profile'], ['class'=>'btn btn-default btn-flat']) ?>
                            </div>
                            <div class="pull-right">
                              <?= Html::a(Yii::t('app','Logout'), ['/user/logout'], ['class'=>'btn btn-default btn-flat', 'data-method'=>'post']) ?>
                            </div>
                          </li>
                        </ul>
                      </li>
                      <?php endif; ?>
                    </ul>
                    <?=
                    Menu::widget([
                        'options' => ['class' => 'nav navbar-nav navbar-right'],
                        'items' => [
                            ['label' => Yii::t('app','Surveys'),
                                'template' => '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-sticky-note"></i> {label} <span class="caret"></span></a>',
                                'submenuTemplate' => '<ul class="dropdown-menu" role="menu">{items}</ul>',
                                'options' => ['class' => 'dropdown'],
                                'visible' => !Yii::$app->user->isGuest,
                                'items' => [
                                    [
                                        'label' => Yii::t('app','Overview'),
                                        'url' => ['/survey/index'],
                                    ],
                                    [
                                        'label' => Yii::t('app','Create survey'),
                                        'url' => ['/survey/new-survey'],
                                    ],
                                ],
                            ],
                            ['label' => Yii::t('app','Contacts list'),
                                'template' => '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-male"></i> {label} <span class="caret"></span></a>',
                                'submenuTemplate' => '<ul class="dropdown-menu" role="menu">{items}</ul>',
                                'options' => ['class' => 'dropdown'],
                                'visible' => !Yii::$app->user->isGuest,
                                'items' => [
                                    [
                                        'label' => Yii::t('app','Overview'),
                                        'url' => ['/contacts/index'],
                                        'template' => '<a href="{url}">{label}</a>',
                                    ],
                                    [
                                        'label' => Yii::t('app','Create List'),
                                        'url' => ['/contacts/create'],
                                        'template' => '<a href="{url}">{label}</a>',
                                    ],
                                ],
                            ],
                            ['label' => Yii::t('app','Options'),
                                'template' => '<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i> {label} <span class="caret"></span></a>',
                                'submenuTemplate' => '<ul class="dropdown-menu" role="menu">{items}</ul>',
                                'options' => ['class' => 'dropdown'],
                                'visible' => Yii::$app->user->can("admin"),
                                'items' => [
                                  [
                                      'label' => Yii::t('app','Users'),
                                      'url' => ['/user/admin'],
                                      'template' => '<a href="{url}"><i class="fa fa-users"></i> {label}</a>',
                                  ],
                                  [
                                      'label' => Yii::t('app','Preferences'),
                                      'url' => ['/options/index'],
                                      'template' => '<a href="{url}"><i class="fa fa-cog"></i> {label}</a>',
                                  ],
                                ],
                            ],
                        ],
                    ]);
                    ?>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </header>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
    <!-- Main content -->
    <?php if (Url::current() == Url::to(['site/index'])): ?>
        <section class="container-app">
            <?= $content ?>
        </section>
    <?php else: ?>
        <section class="container container-app">
            <?= $content ?>
        </section>
    <?php endif ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="container">
      <strong>Copyright &copy; <?= settings('website_title') ?> <?= date('Y') ?> | <?= Yii::t('app','Developed by') ?> <a href="http://www.luism.net">Luis Mendieta</a>.</strong>
    </div>
  </footer>
</div>
<!-- ./wrapper -->
<div id="loading"><i class="fa fa-refresh fa-5x fa-spin"></i></div>

<?= $this->render('alerts') ?>

<?php $this->endBody() ?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?= settings('google_analytics_id') ?>', 'auto');
  ga('send', 'pageview');
</script>
</body>
</html>
<?php $this->endPage() ?>
