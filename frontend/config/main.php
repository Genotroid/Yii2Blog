<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'ru-RU',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            'controllerMap' => [
                'registration' => [
                    'class' => \dektrium\user\controllers\RegistrationController::className(),
                    'on ' . \dektrium\user\controllers\RegistrationController::EVENT_AFTER_REGISTER => function ($e) {
                        $auth = Yii::$app->authManager;
                        $role = $auth->getRole('author');
                        $user = \dektrium\user\models\User::findOne(['username' => $e->form->username]);
                        $auth->assign($role, $user->id);
                        Yii::$app->response->redirect(array('/user/login'))->send();
                        Yii::$app->end();
                    }
                ],
            ],
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],

    'components' => [
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
            'cookieValidationKey' => '2YPjox5_yS_ACQ8zhKqfuJCHa5LUa25E',
        ],
        'session' => [
            'cookieParams' => [
                'httpOnly' => true,
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'baseUrl' => '',
            'rules' => [
                '/' => 'site/index',
                '/about.html' => 'site/about',
                '/articles' => 'article',
                '/article/<slug:[A-Za-z0-9_-]+>.html' => '/article/view',
            ],
        ],
    ],
    'params' => $params,
];
