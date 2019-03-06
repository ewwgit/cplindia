<?php

namespace backend\modules\questions\controllers;

use Yii;
use backend\modules\questions\models\QuestionsMaster;
use backend\modules\questions\models\QuestionsMasterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\modules\questions\models\QuestionMasterMain;
use backend\modules\quiz\models\QuizMaster;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\questions\models\QuestionsOptions;
use backend\modules\questions\models\QuestionsAnswers;

/**
 * QuestionsmasterController implements the CRUD actions for QuestionsMaster model.
 */
class QuestionsmasterController extends Controller
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
     * Lists all QuestionsMaster models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionsMasterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single QuestionsMaster model.
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
     * Creates a new QuestionsMaster model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($quzId)
    {
        $model = new QuestionMasterMain();
        $questionsModel = new QuestionsMaster();
         
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
        	//echo 'hello'; exit;
        	 
        	Yii::$app->response->format = Response::FORMAT_JSON;
        	if (!$model->validate()) {
        		return ActiveForm::validate($model);
        	}
        	//echo '<pre>';print_r(Yii::$app->request->post());exit;
        	//	print_r($model->questionsoptions); exit;
        	$questions = $model->questionSave();
        	 
        	Yii::$app->getSession()->setFlash('success', 'You are successfully added Questions.');
        	  return $this->redirect(['/quiz/quizmaster/view', 'id' => $model->quizId]);
        }
        //$Assessments = $questionsModel->getAllAssessments();
        $quizes = $questionsModel->getAllQuizes();
      $model->quizId = $quzId;
        $model->allquizes = $quizes;
        return $this->render('create', [
        		'model' => $model,
        ]);
        
    }

    /**
     * Updates an existing QuestionsMaster model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = new QuestionMasterMain();
        $questionsModel = new QuestionsMaster();
        $questionsInfo = $this->findModel($id);
        $model->qId = $questionsInfo->qId;
        $model->selectedQuizId = $questionsInfo->quizId;
        $model->question = $questionsInfo->question;
      //  print_r( $model->question); exit;
        $model->status = $questionsInfo->status;
        $model->quizId = $questionsInfo->quizId;
        $questionOptions = $model->searchOptions();
        $model->options1 = $questionOptions[1];
        $model->options2 = $questionOptions[2];
        $model->options3 = $questionOptions[3];
        $model->options4 = $questionOptions[4];
       // print_r( $model->options4); exit;
         
        //print_r($questionOptions); exit();
        $questionAnswers = $model->searchAnswers();
        $model->answer =  $questionAnswers['answer'];
       
        $questionAnswers = $model->searchAnswers();
        if (Yii::$app->request->isAjax ) {
        	Yii::$app->response->format = Response::FORMAT_JSON;
        	return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
      
        	$questions = $model->questionUpdate();
        	Yii::$app->getSession()->setFlash('success', 'You are successfully update Question.');
        	return $this->redirect(['/quiz/quizmaster/view', 'id' => $model->quizId]);
        	//return $this->redirect(['sets/view', 'id' => $model->setId]);
        }
         $quizes = $questionsModel->getAllQuizes();
        $model->allquizes = $quizes;
        return $this->render('update', [
        		'model' => $model,
        		'populatedinfo' => $this->populateInfo($model->qId)
        ]);
    }

    /**
     * Deletes an existing QuestionsMaster model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
    	$qmodel = QuestionsMaster::find()->where(['qId'=>$id])->one();
        $this->findModel($id)->delete();

       // return $this->redirect(['index']);
     	return $this->redirect(['/quiz/quizmaster/view', 'id' => $qmodel->quizId]);
    }

    /**
     * Finds the QuestionsMaster model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return QuestionsMaster the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = QuestionsMaster::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function populateInfo($id)
    {
    	$answers= QuestionsAnswers::findAll(['qId'=>$id]);
    	$data = ArrayHelper::toArray($answers, [
    			'qaId',
    			'answer'
    	]);
    	$ans_list = array();
    	$text_ans = '';
    	foreach ($data as $key => $val_ans)
    	{
    		$option = QuestionsOptions::findOne(['qId'=>$id,'optionId'=>$val_ans['answer']]);
    		$data_opt = ArrayHelper::toArray($option, [
    				'qopId',
    				'options'
    		]);
    		$ans_list[] = $val_ans['answer'];
    		$text_ans .= $data_opt['options'].',';
    	}
    	return array('ans_list'=>$ans_list,'ans_text'=>$text_ans);
    	 
    }
    
}
