<?php

namespace backend\modules\questions\models;

use Yii;
use backend\modules\questions\models\QuestionsOptions;
use backend\modules\questions\models\QuestionsAnswers;
use backend\modules\quiz\models\QuizMaster;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "questions_master".
 *
 * @property int $qId
 * @property int $quizId
 * @property string $question
 * @property string $status
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class QuestionsMaster extends \yii\db\ActiveRecord
{
	//public $assessmentName;
	public $optionsOne;
	public $optionsTwo;
	public $optionsThree;
	public $optionsFour;
	public $answers;
	public $optionId;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'questions_master';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question','quizId'], 'required'],
            [['question', 'status'], 'string'],
            [['createdDate', 'updatedDate'], 'safe']
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'qId' => 'Q ID',
            'question' => 'Question',
        	'quizId' =>'Quiz',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'ipAddress' => 'Ip Address',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsAnswers()
    {
        return $this->hasMany(QuestionsAnswers::className(), ['qId' => 'qId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
/*     public function getCreatedBy0()
    {
        return $this->hasOne(Admin::className(), ['id' => 'createdBy']);
    } */

    /**
     * @return \yii\db\ActiveQuery
     */
   /*  public function getUpdatedBy0()
    {
        return $this->hasOne(Admin::className(), ['id' => 'updatedBy']);
    } */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionsoptions()
    {
        return $this->hasMany(QuestionsOptions::className(), ['qId' => 'qId']);
    }
    
     public function getQuizesrelation()
    {
    	return $this->hasOne(QuizMaster::className(), ['quizId' => 'quizId']);
    }
   /* 
    public function getAssesmentsetrelation()
    {
    	return $this->hasOne(AssesmentSets::className(), ['assetId' => 'setId']);
    } */
    
    public function getAllQuizes()
    {
    
    	$allquizsobj = QuizMaster::find()->select(['quizId','name'])->where(['status'=>'Active'])->all();
    	$data = ArrayHelper::toArray($allquizsobj, [
    			'quizId',
    			'name'
    	]);
    
    	$quizIdCol = array_column($data, 'quizId');
    	$nameCol = array_column($data, 'name');
    	$quizesData = array_combine($quizIdCol, $nameCol);
//     	print_r($AssessmentsData);exit();
    	return $quizesData;
    }
    
  
    
    public function behaviors()
    {
    	return [
    			[
    					'class' => TimestampBehavior::className(),
    					'createdAtAttribute' => 'createdDate',
    					'updatedAtAttribute' => 'updatedDate',
    					'value' => Date('Y-m-d H:i:s'),
    			],
    	];
    }
    public function beforeSave($insert)
    {
    	if (parent::beforeSave($insert)) {
    		$this->ipAddress = $_SERVER['REMOTE_ADDR']?:($_SERVER['HTTP_X_FORWARDED_FOR']?:$_SERVER['HTTP_CLIENT_IP']);
    		$this->createdBy = Yii::$app->user->identity->id;
    		$this->updatedBy = Yii::$app->user->identity->id;
    		return true;
    	} else {
    		return false;
    	}
    }
    public static function getOptions($qid)
    {
    	$options = QuestionsOptions::find()->select('options')->where(['qId'=>$qid])->all();
    	return $options;
    }
    public static function getAnswers($qid)
    {
    	$answers = QuestionsAnswers::find()->select('answerText')->where(['qId'=>$qid])->all();
    	return $answers;
    }
}
