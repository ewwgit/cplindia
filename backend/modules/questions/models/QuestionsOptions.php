<?php

namespace backend\modules\questions\models;

use Yii;

/**
 * This is the model class for table "questions_options".
 *
 * @property int $qopId
 * @property int $qId
 * @property int $optionId
 * @property string $options
 */
class QuestionsOptions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'questions_options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['qId', 'optionId', 'options'], 'required'],
            [['qId', 'optionId'], 'integer'],
            [['options'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'qopId' => 'Qop ID',
            'qId' => 'Q ID',
            'optionId' => 'Option ID',
            'options' => 'Options',
        ];
    }
}
