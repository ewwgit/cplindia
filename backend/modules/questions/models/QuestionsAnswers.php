<?php

namespace backend\modules\questions\models;

use Yii;

/**
 * This is the model class for table "questions_answers".
 *
 * @property int $qaId
 * @property int $qId
 * @property int $answer
 * @property string $answerText
 */
class QuestionsAnswers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions_answers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qId', 'answer', 'answerText'], 'required'],
            [['qId', 'answer'], 'integer'],
            [['answerText'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'qaId' => 'Qa ID',
            'qId' => 'Q ID',
            'answer' => 'Answer',
            'answerText' => 'Answer Text',
        ];
    }
}
