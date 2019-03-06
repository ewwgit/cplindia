<?php

namespace backend\modules\lecture\models;

use Yii;

/**
 * This is the model class for table "guest_lectures".
 *
 * @property int $letureId
 * @property string $topicname
 * @property string $apiUrl
 * @property int $speaker_id
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class GuestLectures extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $semname;
	public $spname;
    public static function tableName()
    {
        return 'guest_lectures';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['topicname','sem_id','apiUrl', 'speaker_id', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate'], 'required'],
            [['apiUrl'], 'string'],
            [['speaker_id', 'createdBy', 'updatedBy'], 'integer'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['topicname'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
        		'sem_id'=>'Semester Name',
        		'course_id'=>'Course Name',
            'letureId' => 'Leture ID',
            'topicname' => 'Topicname',
            'apiUrl' => 'Api Url',
            'speaker_id' => 'Speaker',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
