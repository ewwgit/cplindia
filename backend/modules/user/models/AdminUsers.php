<?php

namespace backend\modules\user\models;

use Yii;

/**
 * This is the model class for table "admin_users".
 *
 * @property int $aduserId
 * @property int $userId
 * @property string $first_name
 * @property string $last_name
 * @property string $mobile
 * @property string $profileImage
 * @property int $createdBy
 * @property int $updatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class AdminUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'admin_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'first_name', 'last_name', 'mobile', 'profileImage', 'createdBy', 'updatedBy', 'createdDate', 'updatedDate'], 'required'],
            [['userId', 'createdBy', 'updatedBy'], 'integer'],
            [['profileImage'], 'string'],
            [['createdDate', 'updatedDate'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 200],
            [['mobile'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'aduserId' => 'Aduser ID',
            'userId' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'mobile' => 'Mobile',
            'profileImage' => 'Profile Image',
            'createdBy' => 'Created By',
            'updatedBy' => 'Updated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
}
