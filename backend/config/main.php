<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
    		'roles' => [
    				'class' => 'app\modules\roles\roles',
    		],
    		'user' => [
    				'class' => 'backend\modules\user\Module',
    		],
    		'semisters' => [
    				'class' => 'backend\modules\semisters\Module',
    		],
    		'courses' => [
    				'class' => 'backend\modules\courses\Module',
    		],
    		'subject' => [
    				'class' => 'backend\modules\subject\Module',
    		], 
    		'lecture' => [
    				'class' => 'backend\modules\lecture\Module',
    		],
    		'assignment' => [
    				'class' => 'backend\modules\assignment\Module',
    		],
    		'workshop' => [
    				'class' => 'backend\modules\workshop\Module',
    		], 
    		'project' => [
            'class' => 'backend\modules\project\Module',
        ],
    		'quiz' => [
    				'class' => 'backend\modules\quiz\Module',
    		],
    		'questions' => [
    				'class' => 'backend\modules\questions\Module',
    		],
    		'events' => [
    				'class' => 'backend\modules\events\Module',
    		],
    	
    		
    		
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
    		'view' => [
    				'theme' => [
    						'pathMap' => [
    								'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app'
    						],
    				],
    		],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
