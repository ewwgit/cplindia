<?php

namespace backend\modules\assignment\models;

use Yii;

/**
 * This is the model class for table "assignment".
 *
 * @property int $asId
 * @property int $sem_id
 * @property string $name
 * @property string $description
 * @property string $attachmentUrl
 * @property string $from_date
 * @property string $to_date
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 * @property string $status
 */
class Assignment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $semname;
    public static function tableName()
    {
        return 'assignment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sem_id', 'name', 'description', 'from_date', 'to_date', 'status'], 'required'],
        		[['sem_id', 'name', 'description', 'attachmentUrl', 'from_date', 'to_date', 'status'], 'safe'],
            [['sem_id', 'createdBy', 'updatedBy'], 'integer'],
            //[['description', 'attachmentUrl', 'status'], 'string'],
            [['from_date', 'to_date', 'createdDate', 'updatedDate'], 'safe'],
        		
            [['name'], 'string', 'max' => 250],
        		[['attachmentUrl'], 'required', 'on' => 'create'],
        	//['attachmentUrl', 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,docx,doc',],
        		['attachmentUrl', 'file',
        		'extensions'=>'pdf,doc,docx',
        		'wrongExtension'=>'Only {extensions} types are allowed',
        				'maxSize' => 1024 * 1024 * 2
        		],
        		[['from_date', 'to_date'],'validateDate'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'asId' => 'As ID',
            'sem_id' => 'Semister Name',
            'name' => 'Assignment Name',
            'description' => 'Description',
            'attachmentUrl' => 'Attachment Url',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
            'status' => 'Status',
        ];
    }
    public function validateDate()
    {
    	$fdate = date('Y-m-d', strtotime($this->from_date));
    	$tdate = date('Y-m-d', strtotime($this->to_date));
    	if($tdate < $fdate)
    	{
    		$this->addError('to_date', 'To date is always greater than from date');
    	}
    }
}
