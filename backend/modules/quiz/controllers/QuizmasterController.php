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
use backend\modules\quiz\models\QuizTest;
use backend\modules\questions\models\QuestionsAnswers;
use backend\modules\quiz\models\UserQuizes;
use yii\data\ActiveDataProvider;

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
        	if($model->validate())
        	{
        	$model->createdBy = Yii::$app->user->identity->id;
        	$model->updatedBy =  Yii::$app->user->identity->id;
        	$model->createdDate = date('Y-m-d H:i;s');
        	$model->updatedDate = date('Y-m-d H:i;s');
        	$model->save();
            return $this->redirect(['index']);
        	}
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
        $semisters = Semisters::find()->select('sem_id,name')->all();
        $semister =array();
        for($k=0;$k<count($semisters);$k++)
        {
        	//$hospital['Prompt'] = 'Select Hospital Name';
        	$semister[$semisters[$k]['sem_id']] = $semisters[$k]['name'];
        }
        $model->semname = $semister;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
        	
            return $this->redirect(['index']);
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
    public function actionQuizindex()
    {
    	$searchModel = new QuizMasterSearch();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	
    	return $this->render('quizindex', [
    			'searchModel' => $searchModel,
    			'dataProvider' => $dataProvider,
    	]);
    	
    }
 public function actionTest($id)
    {
       $model = new QuizTest();
       $quizesMain = QuizMaster::find()->select(['quizTime','totalMarks','passMarks','eachquestioncarries',])->where(['quizId'=>$id])->one();
      // print_r($quizesMain); exit();
       $quizTimeperiod = $quizesMain['quizTime']*60;
       date_default_timezone_set('Asia/Calcutta');
       $time = date('H:i:s');
       $time2 = gmdate("H:i:s", $quizTimeperiod);
       $secs = strtotime($time2)-strtotime("00:00:00");
       $result = date("Y/m/d H:i:s",strtotime($time)+$secs);
       $model->totalMarks = $quizesMain['totalMarks'];
       $model->passMarks = $quizesMain['passMarks'];
       $model->eachquestioncarries = $quizesMain['eachquestioncarries'];
        //print_r( $result); exit();

        if ($model->load(Yii::$app->request->post())) {
        	$session = Yii::$app->session;
        	$session->open();
        	$asseTestData = array();
        	//print_r($session['questionsData']); exit();
        	foreach ($session['questionsData'] as $session_name => $session_value)
        	{
        		if(is_array($session_value))
        		{
        			$asseTestData[]= $session_value;
        			unset($session[$session_name]);
        		}
        		//unset($session[$session_name]);
        	
        	}
        	//print_r($asseTestData);exit();
        	$model->questionsCount = count($asseTestData);
        	//print_r($model->questionsCount );exit();
        	$lastquestionArray = end($asseTestData);
        	$lastquestionId = $lastquestionArray['qId'];
        	//print_r($lastquestionId);exit();
        	$session = Yii::$app->session;
        	$session->open();
        	if($model->incrementhidId == '')
        	{
        		$model->incrementId = 0;
        	}
        	else {
        		$model->incrementId = $model->incrementhidId;
        	}
        	$model->questionsdecremntCount = $model->questionsCount-$model->incrementId;
       $session['assessments'.$model->incrementId] = [
        			$model->questionId => $model->optionId,
        			 
        	];
        	//print_r($session['quizmaster'.$model->incrementId] );
        	//print_r($lastquestionId); 
        	//print_r($model->questionId);
        	if($lastquestionId == $model->questionId)
        	{
        		//echo 'hello'; exit();
        		
        		return $this->redirect(['testcomplete','id'=>$id]);
        	}
        	if ($session->isActive)
        	{
        		if ($session->has('time_out'))
        		{
        			$model->quizTime = $session->get('time_out');
        		}
        		else {
        			$session->set('time_out', $result);
        			$model->quizTime = $session->get('time_out');
        		}
        	}
        	else {
        		$session->set('time_out', $result);
        		$model->quizTime = $session->get('time_out');
        	
        	}
        	
        	
        	//print_r($lastquestionId);exit();
        	//print_r($model->incrementhidId);exit();
        	
     	$assesmetquestion = $asseTestData[$model->incrementId];
        	$model->questionTitle = $assesmetquestion['question'];
        	$model->questionId = $assesmetquestion['qId'];
        	$questionOptionsData = $model->getQuestionOptions($model->questionId);
        	$model->options = $questionOptionsData;
        	$model->incrementhidId = $model->incrementId+1;
        	//print_r($model->incrementhidId);exit();
        	$model->sno = $model->incrementId+1;
        	
        	
        	
/* foreach ($session as $session_name => $session_value)
   print_r($session_name);exit(); */
        	
        	/* $assessmentsSessionData = array();
        	$assessmentsSessionData[]=$session['assessments']; */
        	//print_r($session['assessments']);exit();
        	$model->optionId = '';
        	$model->quizId=$id;
        	//print_r($model->incrementId);exit();
           return $this->render('quizTest', [
                'model' => $model,
            ]);
        } else {
        	
        	$testData = $model->getQuestions($id);
        	shuffle($testData);
        	 
        	$session = Yii::$app->session;
        	$session->open();
        	$session['questionsData'] = $testData;
        	unset($session['time_out']);
            $model->questionsCount = count($testData);
            
        	if($model->incrementhidId == '')
        	{
        		$model->incrementId = 0;
        	}
        	else {
        		$model->incrementId = $model->incrementhidId;
        	}
        	$model->questionsdecremntCount = $model->questionsCount-$model->incrementId;
        	$assesmetquestion = $testData[$model->incrementId];
        	$model->questionTitle = $assesmetquestion['question'];
        	$model->questionId = $assesmetquestion['qId'];
        	$questionOptionsData = $model->getQuestionOptions($model->questionId);
        	$model->options = $questionOptionsData;
        	$model->optionId = '';
        	// print_r($assesmetquestion);exit();
        	$model->incrementhidId = $model->incrementId+1;
        	$model->sno = $model->incrementId+1;
        	
        	//echo $assesmentTimeperiod;exit();
        	
        	$session = Yii::$app->session;
        	$session->open();
        	if ($session->isActive)
        	{
        		if ($session->has('time_out'))
        		{
        		$model->quizTime = $session->get('time_out');
        		}
        		else {
        			$session->set('time_out', $result);
        			$model->quizTime = $session->get('time_out');
        		}
        	}
        	else {
        		$session->set('time_out', $result);
        		$model->quizTime = $session->get('time_out');
        		
        	}
        	$model->quizId=$id;
        	//$model->assementendTime = $result;
        	//$model->assementendTime = "2015/11/08 15:38:09";
        	/* echo $result;
        	$result = "2015/11/08 15:38:09"; */
        	
            return $this->render('quizTest', [
                'model' => $model,
            ]);
        }
    }
    
    public function actionTestcomplete($id)
    {
    	
    
    	$model = new QuizTest();
    	$session = Yii::$app->session;
    	 $session->open();
    	 $assesemtuserTestData = array();
    	foreach ($session as $session_name => $session_value)
    	{
    		if(is_array($session_value))
    		{
    		$assesemtuserTestData[]= $session_value;
    		unset($session[$session_name]);
    		}
    		//unset($session[$session_name]);
    		
    	}
    	unset($session['time_out']);
    	$testcount = count($assesemtuserTestData);
    	//print_r($testcount); exit();
    	$testData = $model->getQuestions($id);
    	$count = count($testData);
    	$allanswers = array();
    	for($i=0; $i<$count; $i++)
    	{
    		$answer = QuestionsAnswers::find()->select(['qId','answer'])->where(['qId'=>$testData[$i]['qId']])->all();
    		$multipleQuestions = count($answer);
    		if($multipleQuestions > 1)
    		{
    			$multipleData = array();
    			$qId = '';
    			foreach ($answer as $answerData)
    			{
    				$qId =  $answerData['qId'];
    				$multipleData[] = $answerData['answer'];
    			}
    			$allanswers[$qId] = $multipleData;
    		}
    		else {
    			
    			foreach ($answer as $answerDatanew)
    			{
    				$allanswers[$answerDatanew['qId']] = $answerDatanew['answer'];
    			}
    			
    		}
    	}
    	//print_r($assesemtuserTestData); exit();
    	
    	
    	$formattedassesmentsArray = array();
    	foreach($assesemtuserTestData as $key=>$val)
    	{
    		if(!(empty($val)))
    		{
    		   foreach($val as $newKey => $newVal)
    		   {
    		   	$formattedassesmentsArray[$newKey] = $newVal;
    		   }
    		}
    	}
    	//print_r($formattedassesmentsArray); exit();
    	$correct = 0;
    	foreach ($formattedassesmentsArray as $key3 => $val3)
    	{
    		if(isset($allanswers[$key3]))
    		{
    		if(is_array($allanswers[$key3]))
    		{
    			if(in_array($val3,$allanswers[$key3]))
    			{
    				//echo $key3.'<br />';
    			$correct++;
    			}
    		}
    		else {
			    	   if($allanswers[$key3] == $val3)
			    	   {
			    	   	//echo $key3.'<br />';
			    	   	 $correct++;
			    	   }
    		}
    		}
    		
    	}
    	//echo $correct; exit();
    	$assesments = QuizMaster::find()->select(['sem_id','quizTime','name','totalMarks','passMarks','eachquestioncarries',])->where(['quizId'=>$id])->one();
    	$markes = $correct * $assesments['eachquestioncarries'];
    	if($markes >= $assesments['passMarks'] )
    	{
    		$result = 'PASS';
    	}
    	else {
    		$result = 'FAIL';
    	}
    	$UserAssessments = new UserQuizes();
    	$UserAssessments->sem_id = $assesments['sem_id'];
    	$UserAssessments->quizId = $id;
    	$UserAssessments->userId = Yii::$app->user->identity->id;
    	$UserAssessments->marks = $markes;
    	$UserAssessments->totalMarks = $assesments['totalMarks'];
    	$UserAssessments->examDate = date('Y-m-d H:i:s');
    	//$UserAssessments->certificate = $assesments['certificationAvailability'];
    	$UserAssessments->result = $result;
    	$UserAssessments->passMarks = $assesments['passMarks'];
    		if($UserAssessments->save())
    	{
    		$model->marks = $markes;
    		$model->results = $result;
    		$model->name = $assesments['name'];
    		$model->sem_id = $assesments['sem_id'];
    		$model->passMarks = $assesments['passMarks'];
    		$model->totalMarks = $assesments['totalMarks'];
    		/* \Yii::$app->mailer->compose(['html' => 'Assessments-complete-html'], ['assessments' => $model])
    		->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
    		->setTo('brahmi@expertwebworx.com')
    		->setSubject('Assesment Test')
    		->send(); */
    		
    		return $this->render('testcomplete', [
    				'model' => $model,
    		]);
    	}
    	
    	
    	return $this->render('testcomplete', [
    			'model' => $model,
    	]);
    }
    public function actionFellowmarks()
    {
    	$query = UserQuizes::find();
    	//print_r($query); exit();
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    	]);
    	return $this->render('fellowmarks', [
    			
    			'dataProvider' => $dataProvider,
    	]);
    	
    	
    }
    public function actionMarks()
    {
    	
    	$query = UserQuizes::find()->where(['userId'=>Yii::$app->user->identity->id]);
    	//print_r($query); exit();
    	$dataProvider = new ActiveDataProvider([
    			'query' => $query,
    	]);
    	return $this->render('marks', [
    			 
    			'dataProvider' => $dataProvider,
    	]);
    }
    
    
}
