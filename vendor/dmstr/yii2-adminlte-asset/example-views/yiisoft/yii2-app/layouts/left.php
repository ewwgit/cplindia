<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Admin</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
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

    </section>

</aside>
