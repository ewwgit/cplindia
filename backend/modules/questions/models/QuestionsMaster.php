<?php

namespace backend\modules\questions\models;

use Yii;

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
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['quizId', 'question', 'status', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate'], 'required'],
            [['quizId', 'createdBy', 'updatedBy'], 'integer'],
            [['question', 'status'], 'string'],
            [['createdDate', 'updatedDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'qId' => 'Q ID',
            'quizId' => 'Quiz ID',
            'question' => 'Question',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
