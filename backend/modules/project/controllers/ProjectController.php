<?php

namespace backend\modules\project\controllers;

use Yii;
use backend\modules\project\models\Project;
use backend\modules\project\models\ProjectSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;

/**
 * ProjectController implements the CRUD actions for Project model.
 */
class ProjectController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Project models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Project model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Project model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Project();

        if ($model->load(Yii::$app->request->post())) {
        	
        	if($model->validate())
        	{
        	$model->from_date = date('Y-m-d', strtotime($model->from_date));
        	$model->to_date = date('Y-m-d', strtotime($model->to_date));
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy =  Yii::$app->user->identity->id;
        	$model->createdDate = date('Y-m-d H:i;s');
        	$model->updatedDate = date('Y-m-d H:i;s');
        if($model->save()){
        		
        		$uinfomail = User::find()->select('email')->where('role=4')->all();
        		$umails = array();
        		foreach($uinfomail as $umail)
        		{
        			$umails[] = $umail['email'];
        		}
        		$body='Hello Fellows';
        	//	$body.=$name;
        		$body.='<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    					Project Details are added in Cpl India';
        		$body.='<br><br>Please check your account ';
        		
        			
        		$body.='<br><br><br><u>Thanks&Regards,</u>';
        		$body.='<br>&nbsp;CPLIndia Team.';
        			
        		\Yii::$app->mailer->compose()
        		->setFrom('ngh@expertwebworx.in')
        		->setTo($umails)
        		->setSubject('Notication for New project')
        		->setHtmlBody($body)
        		->send();
        		Yii::$app->getSession()->setFlash('success', 'Project details added successfully ');
                return $this->redirect(['index']);
        	}
        }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Project model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
        	      	$model->updatedBy =  Yii::$app->user->identity->id;
        	      	$model->updatedDate = date('Y-m-d H:i:s');
        	      	$model->save();
        	      	return $this->redirect(['index']);
        	      	
            //return $this->redirect(['view', 'id' => $model->projectId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Project model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Project model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Project the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Project::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
