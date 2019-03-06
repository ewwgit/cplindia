<?php
namespace backend\modules\quiz\models;

use yii\base\Model;
use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\db\Query ;
use backend\modules\questions\models\QuestionsOptions;

/**
 * Signup form
 */
class QuizTest extends Model
{
    
 public $questionId;
 public $questionTitle;
 public $options;
 public $optionId;
 public $incrementId;
 public $incrementhidId;
 public $sno;
 public $quizTime;
 public $quizId;
 public $marks;
 public $results;
 public $assessmentName;
 public $questionsdecremntCount;
 public $questionsCount;
 public $totalMarks;
 public $passMarks;
 public $eachquestioncarries;
 public $name;
 public $sem_id;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['questionId','questionTitle','options','optionId','incrementId','incrementhidId','sno','quizTime','assId','marks','name','results','questionsdecremntCount','questionsCount','eachquestioncarries','passMarks','totalMarks'],'safe']
        ];
    }
    
    
    
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
    	return [
    			'email' => 'Email',
    			'password' => 'Password',
    			'membership' => 'Membership',
    			'gender' => 'Gender',
    			'phoneNum' => 'Phone Number',
    			'dob' => 'Date Of Birth',
    			'address'=>'Address',
    			'marks'=>'marks'
    	];
    }
    public function getQuestions($id)
    {
    	$query = new Query;
    	
    		$query->select([
    				'questions_master.question',
    				'questions_master.qId',
    		]
    				)
    				->from('quiz_master')
    				->join('INNER JOIN', 'questions_master',
    						'quiz_master.quizId =questions_master.quizId')
    						->where(['quiz_master.quizId' => $id])
    						;
    	
    	$provider = new ActiveDataProvider([
    			'query' => $query,
    			'pagination' => false,
    	]);
    	$questions = $provider->getModels();
    	return $questions;
    	//print_r($questions);exit();
    }
    
    public function getQuestionOptions($qId)
    {
    	
    			$provider = new ActiveDataProvider([
    					'query' => QuestionsOptions::find()->select(['qId','optionId','options'])->where(['qId'=>$qId]),
    					'pagination' => false,
    			]);
    			$questionOptions = $provider->getModels();
    			
    			$questionOptionsArray = array();
    			foreach ($questionOptions as $data)
    			{
    				$questionOptionsArray[$data->optionId] = $data->options;
    			}
    			//print_r($questionOptionsArray);exit();
    			return $questionOptionsArray;
    			
    }

    
    
}
