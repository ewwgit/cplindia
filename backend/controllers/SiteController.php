<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use common\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                		[
                		'actions' => ['request-password-reset', 'error'],
                		'allow' => true,
                		
                		],
                		[
                				'actions' => ['reset-password', 'error'],
                				'allow' => true,
                		
                		],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionRequestPasswordReset()
    {
    	$this->layout= 'main-login';
    	$model = new PasswordResetRequestForm();
    	if ($model->load(Yii::$app->request->post()) && $model->validate()) {
    		if ($model->sendEmail()) {
    			Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
    			return $this->goHome();
    			 
    		} else {
    			Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
    		}
    	}
    
    	return $this->render('requestPasswordResetToken', [
    			'model' => $model,
    	]);
    }
    
    public function actionResetPassword($token)
    {
    	$this->layout= 'main-login';
    	try {
    		$model = new ResetPasswordForm($token);
    	} catch (InvalidParamException $e) {
    		throw new BadRequestHttpException($e->getMessage());
    	}
    
    	if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
    		Yii::$app->getSession()->setFlash('success', 'New password was saved.');
    
    		return $this->goHome();
    	}
    
    	return $this->render('resetPassword', [
    			'model' => $model,
    	]);
    }
}
