<?php
use yii\web\Response;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'modules' => [
        'v1' => [
            'class' => \api\modules\v1\Module::class,
        ],
    ],
    'components' => [
        'request' => [
            'baseUrl' => '/api',
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class,
            ]
        ],
        'response' => [
            'format' => Response::FORMAT_JSON,
        ],
        'user' => [
            'identityClass' => \common\models\User::class,
            'enableSession' => false,
            'loginUrl' => null,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => 'v1/cities',
                ],
                'GET v1/address' => 'v1/address/index',
            ],
        ],
        'addressFinder' => \api\components\AddressFinder::class,
    ],
    'params' => $params,
];
