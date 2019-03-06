<?php

namespace backend\modules\subject\models;

use Yii;
use backend\modules\subject\models\SubjectsDocuments;

/**
 * This is the model class for table "subjects".
 *
 * @property int $subId
 * @property string $name
 * @property string $description
 * @property string $attachmentUrl
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class Subjects extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
	public $imageFiles;
	public $subdocurl;
	public $sem_name;
	public $course_name;
    public static function tableName()
    {
        return 'subjects';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description','createdBy', 'updatedBy', 'createdDate', 'updatedDate'], 'required'],
       //   [['attachmentUrl'], 'required','on'=>'create'],
            [['createdBy', 'updatedBy'], 'integer'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['name', 'description'], 'string', 'max' => 250],
        	[['imageFiles'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,mp4', 'maxFiles' => 4,'maxSize' => 1024 * 1024 * 2],
        	//['attachmentUrl', 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf,docx,doc','maxSize' => 1024 * 1024 * 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'subId' => 'Sub ID',
            'name' => 'Subject Name',
            'description' => 'Subject Description',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        		'imageFiles'=>'Subject Documents',
        ];
        
    }
    public function upload()
    {
    	if ($this->validate()) {
    	
    		foreach ($this->imageFiles as $file) {
    			 
    			$subdocfiles = new SubjectsDocuments();
    			$subdocfiles->subId = $this->subId;
    			$type=$file->type;
    			$docurl = time().$file->name;
    			$file->saveAs('coursedocs/'.$docurl );
    			$subdocfiles->attachmentUrl = $docurl;
    			$subdocfiles->fileType = $type;
    			$subdocfiles->fileType =  $file->type;
    			$subdocfiles->save();
    			
    		}
    		return true;
    	} else {
    		/* $errors = $this->errors;
    		 print_r($errors);exit(); */
    		return false;
    	}
    }
}
