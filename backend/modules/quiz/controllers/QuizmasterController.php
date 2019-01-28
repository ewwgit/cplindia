<?php

namespace backend\modules\quiz\controllers;

use Yii;
use backend\modules\quiz\models\QuizMaster;
use backend\modules\quiz\models\QuizMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\semisters\models\Semisters;
use backend\modules\courses\models\Courses;
use backend\modules\questions\models\QuestionsMasterSearch;

/**
 * QuizmasterController implements the CRUD actions for QuizMaster model.
 */
class QuizmasterController extends Controller
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
     * Lists all QuizMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuizMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QuizMaster model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
      $searchModel = new QuestionsMasterSearch();
    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	
    	return $this->render('questionlist', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    		    'quizId' => $id
    	]);
    }

    /**
     * Creates a new QuizMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new QuizMaster();
        $semisters = Semisters::find()->select('sem_id,name')->all();
        $semister =array();
        for($k=0;$k<count($semisters);$k++)
        {
        	//$hospital['Prompt'] = 'Select Hospital Name';
        	$semister[$semisters[$k]['sem_id']] = $semisters[$k]['name'];
        }
        $model->semname = $semister;

        if ($model->load(Yii::$app->request->post()) ) {
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy =  Yii::$app->user->identity->id;
        	$model->createdDate = date('Y-m-d H:i;s');
        	$model->updatedDate = date('Y-m-d H:i;s');
        	$model->save();
            return $this->redirect(['view', 'id' => $model->quizId]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing QuizMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
            return $this->redirect(['view', 'id' => $model->quizId]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing QuizMaster model.
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
     * Finds the QuizMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuizMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuizMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionLoadcourses($sem_id)
    {
    	$cdata = Courses::find()->select('courseId,name')->where(['sem_id'=>$sem_id])->all();
    	$cinfo = array();
    	for($k =0;$k<count($cdata);$k++)
    	{
    		$cinfo[$cdata[$k]['courseId']]  = $cdata[$k]['name'];
    		// print_r($subspeciInfo); exit;
    	}
    	//print_r($cinfo); exit();
    	foreach($cinfo as $sl=>$kl)
    	{
    		echo '<option value="'.$sl.'">'.$kl.'</option>';
    	}
    	//print_r($cinfo);exit();
    }
}
