<?php

namespace backend\modules\assignment\models;

use Yii;

/**
 * This is the model class for table "user_assignments".
 *
 * @property int $uassId
 * @property int $userId
 * @property int $asId
 * @property string $attachmentUrl
 * @property string $fileType
 * @property string $uploadedDate
 * @property int $createdDate
 * @property int $updatedDate
 */
class UserAssignments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $aname;
    public static function tableName()
    {
        return 'user_assignments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'asId','sem_id','attachmentUrl', 'fileType', 'uploadedDate',], 'required'],
           // [['userId', 'asId', ], 'integer'],
            [['attachmentUrl', 'fileType'], 'string'],
            [['uploadedDate'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uassId' => 'Uass ID',
            'userId' => 'User ID',
        	'sem_id' => 'Semister Name',
            'asId' => 'Assignment Name',
            'attachmentUrl' => 'Attachment Url',
            'fileType' => 'File Type',
            'uploadedDate' => 'Uploaded Date',
         
        ];
    }
}
