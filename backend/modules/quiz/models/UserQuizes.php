<?php

namespace backend\modules\quiz\models;

use Yii;

/**
 * This is the model class for table "user_quizes".
 *
 * @property int $qassessmentId
 * @property int $quizId
 * @property int $userId
 * @property string $marks
 * @property string $totalMarks
 * @property string $passMarks
 * @property string $examDate
 * @property string $result
 */
class UserQuizes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $semname;
    public static function tableName()
    {
        return 'user_quizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quizId', 'userId', 'marks', 'totalMarks', 'passMarks', 'examDate', 'result'], 'required'],
            [['quizId', 'userId'], 'integer'],
            [['examDate'], 'safe'],
            //[['marks', 'totalMarks', 'passMarks'], 'string', 'max' => 250],
            //[['result'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'qassessmentId' => 'Qassessment ID',
            'quizId' => 'Quiz ID',
            'userId' => 'User ID',
            'marks' => 'Marks',
            'totalMarks' => 'Total Marks',
            'passMarks' => 'Pass Marks',
            'examDate' => 'Exam Date',
            'result' => 'Result',
        ];
    }
}
