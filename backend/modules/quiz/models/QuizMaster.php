<?php

namespace backend\modules\quiz\models;

use Yii;

/**
 * This is the model class for table "quiz_master".
 *
 * @property int $quizId
 * @property int $sem_id
 * @property int $courseId
 * @property string $name
 * @property string $description
 * @property string $validFrom
 * @property string $validTime
 * @property string $quizTime
 * @property int $totalMarks
 * @property int $passMarks
 * @property int $eachquestioncarries
 * @property string $status
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class QuizMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $semname;
	//public $qId;
    public static function tableName()
    {
        return 'quiz_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sem_id', 'courseId', 'name', 'description', 'validFrom', 'validTo', 'quizTime', 'totalMarks', 'passMarks', 'eachquestioncarries', 'status'], 'required'],
            //[['sem_id', 'courseId', 'totalMarks', 'passMarks', 'eachquestioncarries', 'createdBy', 'updatedBy'], 'integer'],
            [['description', 'status'], 'string'],
            [['validFrom', 'validTo', 'createdDate', 'updatedDate'], 'safe'],
            [['name'], 'string', 'max' => 250],
           // [['quizTime'], 'string', 'max' => 5],
        		//[['validFrom', 'validTo',],'validateDate']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'quizId' => 'Quiz ID',
            'sem_id' => 'Semister',
            'courseId' => 'Course',
            'name' => 'Quiz Name',
            'description' => 'Description',
            'validFrom' => 'Valid From',
            'validTime' => 'Valid To',
            'quizTime' => 'Quiz Time in Minutes',
            'totalMarks' => 'Total Marks',
            'passMarks' => 'Pass Marks',
            'eachquestioncarries' => 'Eachquestioncarries',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
   /*  public function validateDate()
    {
    	$fdate = date('Y-m-d', strtotime($this->validFrom));
    	$tdate = date('Y-m-d', strtotime($this->validTo));
    	if($tdate < $fdate)
    	{
    		$this->addError('validTo', 'Valid to is always greater than valid from');
    	}
    } */
}
