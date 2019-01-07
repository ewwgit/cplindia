<?php

namespace app\modules\roles\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use common\models\User;

/**
 * This is the model class for table "roles".
 *
 * @property int $roleId
 * @property string $role_name
 * @property string $status
 * @property int $createdBy
 * @property int $udpatedBy
 * @property string $createdDate
 * @property string $updatedDate
 */
class Roles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'roles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
           // [['roleId'], 'required'],
            [['roleId', 'createdBy', 'updatedBy'], 'integer'],
        	[['role_name','description','status'],'required'],
        	[['role_name'],'validateName','on'=>'create'],
            [['status'], 'string'],
        	[['status'], 'required'],
            [['createdDate', 'updatedDate','description','updatedBy','createdBy'], 'safe'],
            [['role_name'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'roleId' => 'Role ID',
            'role_name' => 'Role Name',
            'status' => 'Status',
            'createdBy' => 'Created By',
            'udpatedBy' => 'Udpated By',
            'createdDate' => 'Created Date',
            'updatedDate' => 'Updated Date',
        ];
    }
    public static function getUsername($uId) {
    	$usernamedata = User::find()->select(['username'])->where(['id'=>$uId])->one();
    	return $usernamedata['username'];
    }
    public function validateName()
    {
    	$rolesData = Roles::find()->where(['role_name' => $this->role_name])->one();
    	if(!empty($rolesData))
    	{
    		$this->addError('role_name','This Role Name already taken');
    	}
    }
    

 
}
