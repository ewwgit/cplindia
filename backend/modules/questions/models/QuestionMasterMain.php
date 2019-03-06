<?php

namespace backend\modules\questions\models;

use Yii;
use yii\base\Model;
use backend\modules\questions\models\QuestionsMaster;
use backend\modules\questions\models\QuestionsOptions;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\validators\RequiredValidator;
use yii\data\ActiveDataProvider;

class QuestionMasterMain extends Model
{
	public $qId;
	public $quizId;
	public $question;
	public $status;
	public $options;
	public $optionId;
	public $answer;
	public $answerText;
	public $questionsoptions;
	public $options1;
	public $options2;
	public $options3;
	public $options4;
	public $selectedQuizId;
	public $opt_list;
	public $allquizes;
	
		

/**
 * @inheritdoc
 */
public function rules()
{
	return [
			//[['setId'], 'required'],
			[['questionsoptions'],'safe'],
			//['question', 'filter', 'filter' => 'trim'],
			//['question', 'required'],
			//['options','required'],
			//['optionId','required'],
			[['quizId','status','options1','options2','options3','options4','selectedSetId','allquizes','answer'],'safe'],
			['questionsoptions', 'validateQuestion'],
			
	];
}
public function behaviors()
{
	return [
			[
					'class' => TimestampBehavior::className(),
					'createdAtAttribute' => 'created_at',
					'updatedAtAttribute' => 'updated_at',
					'value' => Date('Y-m-d H:i:s'),
			],
	];
}

/**
 * @inheritdoc
 */
 
public function attributeLabels()
{
	return [
			'quizId' => 'Quizes',
			'question' => 'Question',
			'options' => 'Options',
			'optionId' => 'optionsId',
			'answer' => 'Answer',
			'status' => 'Status',
	];
}

/**
 * Questions created using other table fields.
 *
 * @return QuestionMaster|null the saved model or null if saving fails
 */
 
public function questionSave()
{
	//echo "<pre>";print_r($this->questionsoptions);exit();
	//if($this->validate())
	//{
		$count = 0;
		//echo '<pre>';
		//print_r($this->questionsoptions);exit();
		foreach ($this->questionsoptions as $questionsopt)
		{
			//print_r($questionsopt['question']); 
			
			$questions = new QuestionsMaster();
			$questions->quizId = $this->quizId;
			$questions->question = $questionsopt['question'];
			$questions->status = 'Active';
			
			
			if ($questions->save()) {
				
				
				$qId = $questions->qId;
				for($i=1;$i<=4;$i++)
				{
					$questionsOptions = new QuestionsOptions();
					$questionsOptions->qId = $qId;
					$questionsOptions->optionId = $i;
					$questionsOptions->options = $questionsopt['options'.$i];					
					$questionsOptions->save();
				}				
				
			
				
					$questionsAnswers = new QuestionsAnswers();
					$questionsAnswers->qId = $qId;
					$questionsAnswers->answer =  $questionsopt['answer'] ;
					$questionsAnswers->answerText = $questionsopt['options'.$questionsopt['answer']];
					$questionsAnswers->save();
					
			
				
			}
			//echo "asdfsdf";exit;
			
		}
	
		
	//}
	//else
	//{
		
	//}
	
}	


public function questionUpdate()
{
	if($this->validate())
	{
		//print_r($this);exit();
		foreach ($this->questionsoptions as $questionsopt)
		{
			$questions = new QuestionsMaster();
			$questions = QuestionsMaster::find()->where(['qId'=>$this->qId])->one();
			$questions->quizId = $this->quizId;
			$questions->question = $questionsopt['question'];
			$questions->status = $this->status;
			if ($questions->save()) {
				$qId = $questions->qId;
				for($i=1;$i<=4;$i++)
				{
					$questionsOptions = new QuestionsOptions();
					$questionsOptions = QuestionsOptions::find()->where(['qId'=>$this->qId,'optionId' =>$i])->one();
					$questionsOptions->options = $questionsopt['options'.$i];
					$questionsOptions->save();
				}
				QuestionsAnswers::deleteAll('qId = :qId', [':qId' => $this->qId]);
				foreach ($questionsopt['optionId'] as $answer)
				{						
					$questionsAnswers = new QuestionsAnswers();
					$questionsAnswers->qId = $qId;
					$questionsAnswers->answer = (int)$answer;
					$questionsAnswers->answerText = $questionsopt['options'.(int)$answer];
					if($questionsAnswers->save())
					{}else{}
				}
				
			}
		}

	}

}


public function questionSaveold()
{
	if($this->validate())
	{
		//print_r($this);exit();
		$questions = new QuestionsMaster();
		$questions->quizId = $this->quizId;
		$questions->question = $this->question;

		if ($questions->save()) {
			$qId = $questions->qId;
			$count = count($this->options);
				
			for($i=0;$i<$count;$i++)
			{
				$questionsOptions = new QuestionsOptions();
				$questionsOptions->qId = $qId;
				$questionsOptions->optionId = $i+1;
				$questionsOptions->options = $this->options[$i];
				$questionsOptions->save();
			}
				
			$questionsAnswers = new QuestionsAnswers();
			$questionsAnswers->qId = $qId;
			$questionsAnswers->answer = 1;
			$questionsAnswers->answerText = $this->answerText;
			$questionsAnswers->save();
			//print_r($questionsAnswers);exit();
		}
		//$Questions->save();
		//print_r($questions);exit();
	}
	return null;
}

public function validateQuestion($attribute)
{
	$requiredValidator = new RequiredValidator();
	//$requiredValidator->message = 'failed new.';

	foreach($this->$attribute as $index => $row) {
		$error = null;
		$requiredValidator->validate($row['question'], $error);
		if (!empty($error)) {
			$key = $attribute . '[' . $index . '][question]';
			$this->addError($key, 'Question  can not be blank');
		}
		$requiredValidator->validate($row['options1'], $error);
		if (!empty($error)) {
			$key = $attribute . '[' . $index . '][options1]';
			$this->addError($key,'options1 can not be blank' );
		}
		$requiredValidator->validate($row['options2'], $error);
		if (!empty($error)) {
			$key = $attribute . '[' . $index . '][options2]';
			$this->addError($key, 'options2 can not be blank');
		}
		$requiredValidator->validate($row['options3'], $error);
		if (!empty($error)) {
			$key = $attribute . '[' . $index . '][options3]';
			$this->addError($key, 'options3 can not be blank');
		}
		$requiredValidator->validate($row['options4'], $error);
		if (!empty($error)) {
			$key = $attribute . '[' . $index . '][options4]';
			$this->addError($key, 'options4 can not be blank');
		}
		$requiredValidator->validate($row['answer'], $error);
		if (!empty($error)) {
			$key = $attribute . '[' . $index . '][answer]';
			$this->addError($key, 'please check any of the options for answer');
		}
		
		
	}
	
}

public function searchOptions()
{

	$query = QuestionsOptions::find()->where(['qId' => $this->qId]);

	$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
	]);

	$questionsData = $dataProvider->getModels();
	$i=1;
	$optionsData = array();
	//print_r($questionsData);exit();
	foreach ($questionsData as $questionsOptions)
	{
		//print_r($questionsOptions->options);exit();
		$optionsData[$i] = $questionsOptions->options;
		$i++;
	}
	//$this->options1 = $optionsData[1];
	//$this->options2 = $optionsData[2];
	//$this->options3 = $optionsData[3];
	//$this->options4 = $optionsData[4];
	return $optionsData;
	//print_r($this->options1);
	//return $dataProvider;
}
public function searchAnswers()
{
	$query = QuestionsAnswers::find()->where(['qId' => $this->qId]);
	$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => false,
	]);
	$questionsData = $dataProvider->getModels();
	$optionsData = array();
	$optionsData['answerText'] ='';
	$optionsData['answer'] = '';
	foreach ($questionsData as $questionsOptions)
	{
		$optionsData['answerText'] = $questionsOptions->answerText;
		$optionsData['answer'] = $questionsOptions->answer;
	}
	//$this->answerText = $optionsData['answerText'];
	//$this->answer = $optionsData['answer'];
	
	//print_r($this->answer);exit();
	return $optionsData;
}

}