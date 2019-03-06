<?php
namespace app\models;

use yii\base\Model;
use common\models\User;
use yii\helpers\ArrayHelper;
use app\modules\roles\models\Roles;

/**
 * Signup form
 */
class SignupAdminuser extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirmpassword;
    public $first_name;
    public $last_name;
    public $mobile;
    public $roles;
    public $role;
    public $profileImage;
    public $status;
    public $aduserId;
   
    public  $id;
    //public $isNewRecord;
    public $userId;
 
    public $createdBy;
    public $updatedBy;
    public $createdDate;
    public $updatedDate;
    


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
        	[['first_name','last_name','role','status'],'required'],
        	[['password'],'required','on'=>'create'],
        		['confirmpassword','required' ,'on' => 'create'],
        		//['agree','required','on'=>'signup'],
        		[['confirmpassword'], 'compare', 'compareAttribute' => 'password'],
        	['id','safe'],
            ['username', 'trim'],
            ['username', 'required','on'=>'create'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.','on'=>'create'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.','on' =>'create'],

            //['password', 'required'],
            //['password', 'string', 'min' => 6],
        	[['aduserId','userId','first_name','last_name','mobile','createdDate','updatedDate','createdBy','updatedBy'],'safe'],
        	//[['country','state','city','countryName','stateName','cityName'],'safe'],
        ];
    }
    public function attributeLabels()
    {
    	return [
    			'username'=>'User Name'
    			
    			];
    			
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->status = $this->status;
        $user->role = $this->role;
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
    
    public function getAllRoles()
    {
    
    	$allRolesobj = Roles::find()->where(('roleId > 1'))->all();
    	//print_r($allRolesobj);exit();
    	$data = ArrayHelper::toArray($allRolesobj, [
    			'roleId',
    			'role_name'
    	]);
    
    	$roleIdCol = array_column($data, 'roleId');
    	$RoleNameCol = array_column($data, 'role_name');
    	$RolesData = array_combine($roleIdCol, $RoleNameCol);
    	return $RolesData;
    }
}
