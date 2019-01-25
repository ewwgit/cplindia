<?php 

use common\models\User;
use yii\helpers\Url;
use backend\modules\user\models\AdminUsers;
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
        <?php 
              $roleiddata = User::find()->select(['role'])->where(['role'=> Yii::$app->user->identity->role])->one();
              
              ?>
              <?php if($roleiddata['role'] == 1){?>
            <div class="pull-left image">
            
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Admin</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
            <?php }else{
            	if($roleiddata['role'] == 2)
            	{
            		
            		$userimage = AdminUsers::find()->select(['profileImage'])->where(['userId' =>Yii::$app->user->identity->id])->one();
            ?>
                        <div class="pull-left image">
                   <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
               
              
            </div>
            <div class="pull-left info">
                <p><?php echo Yii::$app->user->identity->username ?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
            <?php } }?>
            
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
         <?php if($roleiddata['role'] == 1){?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                		[
                		'label' => 'Roles',
                		'icon' => 'users',
                		'url' => ['/roles/roles'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/roles/roles/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/roles/roles'],],
                		],
                		],
                		[
                		'label' => 'Admin Users',
                		'icon' => 'users',
                		'url' => ['/user/adminusers'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/user/adminusers/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/user/adminusers'],],
                		],
                		],
                		[
                		'label' => 'Courses',
                		'icon' => 'book',
                		'url' => ['/semisters/semisters'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/semisters/semisters/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/semisters/semisters'],],
                		],
                		],
                		[
                		'label' => 'Guest Lectures',
                		'icon' => 'book',
                		'url' => ['/lecture/guestlectures'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/lecture/guestlectures/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/lecture/guestlectures'],],
                		],
                		],
                		[
                		'label' => 'Assignments',
                		'icon' => 'book',
                		'url' => ['/assignment/assignment'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/assignment/assignment/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/assignment/assignment'],],
                		],
                		],
                		[
                		'label' => 'Workshop',
                		'icon' => 'book',
                		'url' => ['/workshop/workshop'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/workshop/workshop/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/workshop/workshop'],],
                		],
                		],
                		[
                		'label' => 'Final Project',
                		'icon' => 'book',
                		'url' => ['/project/project'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/project/project/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/project/project'],],
                		],
                		],
                		[
                		'label' => 'Quiz',
                		'icon' => 'book',
                		'url' => ['/quiz/quizmaster'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/quiz/quizmaster/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/quiz/quizmaster'],],
                		],
                		],
                	/* 	[
                		'label' => 'Courses',
                		'icon' => 'users',
                		'url' => ['/courses/courses'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/courses/coursesmaster/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/courses/coursesmaster'],],
                		],
                		], */
                ],
            ]
        ) ?>
        <?php } else{
        if($roleiddata['role'] == 2){?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                		
                		[
                		'label' => 'Courses',
                		'icon' => 'book',
                		'url' => ['/semisters/semisters'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/semisters/semisters/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/semisters/semisters'],],
                		],
                		],
                		[
                		'label' => 'Guest Lectures',
                		'icon' => 'book',
                		'url' => ['/lecture/guestlectures'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/lecture/guestlectures/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/lecture/guestlectures'],],
                		],
                		],
                		[
                		'label' => 'Assignments',
                		'icon' => 'book',
                		'url' => ['/assignment/assignment'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/assignment/assignment/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/assignment/assignment'],],
                		],
                		],
                		
                	/* 	[
                		'label' => 'Courses',
                		'icon' => 'users',
                		'url' => ['/courses/courses'],
                		'items' => [
                				['label' => 'Create', 'icon' => 'plus-circle', 'url' => ['/courses/coursesmaster/create'],],
                				['label' => 'View all', 'icon' => 'eye', 'url' => ['/courses/coursesmaster'],],
                		],
                		], */
                ],
            ]
        ) ?>
        <?php } }?>

    </section>

</aside>
<style>
.images{
    width: 25px;
    height: 25px;
    border-radius: 50%;
    margin-right: 10px;
    margin-top: -2px;
}
.user-panel>.image>img {
   max-width:45px;
   height:45px;
    }

</style>
