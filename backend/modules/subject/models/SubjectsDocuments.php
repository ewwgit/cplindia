<?php

namespace backend\modules\subject\models;

use Yii;

/**
 * This is the model class for table "subjects_documents".
 *
 * @property int $docId
 * @property int $subId
 * @property string $attachmentUrl
 * @property string $fileType
 */
class SubjectsDocuments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subjects_documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['subId', 'attachmentUrl', 'fileType'], 'required'],
            [['subId'], 'integer'],
            [['attachmentUrl', 'fileType'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'docId' => 'Doc ID',
            'subId' => 'Sub ID',
            'attachmentUrl' => 'Attachment Url',
            'fileType' => 'File Type',
        ];
    }
}
