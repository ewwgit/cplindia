<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
       public $js = [    		
    		//'js/modernizr.custom.97074.js',
    		//'js/bootstrap.min.js',    	
    		//'js/jquery.hoverdir.js',
    		'js/jQuery.scrollSpeed.js',
    		///'js/jquery.flexisel.js',
    		//'js/cbpAnimatedHeader.js',
    		//'js/classie.js',
    		'js/script.js',
    		'js/jquery.countdown.js',
    		'js/jquery.countdown.min.js',
    		//'js/carouseller.min.js',
    		//'js/html5gallery.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
