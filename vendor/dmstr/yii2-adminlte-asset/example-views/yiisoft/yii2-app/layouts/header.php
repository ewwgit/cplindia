<?php
use yii\helpers\Html;
use common\models\User;
use yii\helpers\Url;
use backend\modules\user\models\AdminUsers;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

   <?= Html::a('<span class="logo-mini"></span><span class="logo-lg">' ."CPLIndia". '</span>', Yii::$app->homeUrl, ['class' => 'logo'])?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
               
                <!-- Tasks: style can be found in dropdown.less -->
          
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php 
              $roleiddata = User::find()->select(['role'])->where(['role'=> Yii::$app->user->identity->role])->one();
              $userimage = AdminUsers::find()->select(['profileImage'])->where(['userId' =>Yii::$app->user->identity->id])->one();
              if($roleiddata['role'] ==1)
              {
              ?>
                        <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"><?php echo Yii::$app->user->identity->username ?></span>
                           <?php }else{
            	if($roleiddata['role'] == 2)
            	{
            		
            		$userimage = AdminUsers::find()->select(['profileImage'])->where(['userId' =>Yii::$app->user->identity->id])->one();
            ?>
            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="User Image"/>
                        <span class="hidden-xs"> <?php echo Yii::$app->user->identity->username ?></span>
                        <?php } }?>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                        <?php 
                          if($roleiddata['role'] ==1)
              {
              ?>
                            <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                           <?php echo Yii::$app->user->identity->username ?>
                            </p>
                                 <?php }else{
            	if($roleiddata['role'] == 2)
            	{
            	?>  <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle"
                                 alt="User Image"/>

                            <p>
                           <?php echo Yii::$app->user->identity->username ?>
                            </p>
                            <?php }}?>
            	
                        </li>
                        <!-- Menu Body -->
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <?= Html::a(
                                    'Sign out',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
              <!--   <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li> -->
            </ul>
        </div>
    </nav>
</header>
