<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Первое web-приложение!',
    'language'=>'ru',
	// preloading 'log' component
	'preload'=>array('log','EJSUrlManager'),

    /*'aliases' => array(
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change this if necessary
    ),*/

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.message.*',
        //av
        'application.modules.likes.models.*',
        'application.modules.comments.models.*',
        'application.modules.lookup.models.*',
        'application.modules.post.models.*',
        'application.modules.tag.models.*',
        'application.modules.video.models.*',
        'application.modules.forecast.models.*',
        'application.modules.subscription.models.*',
        //av

        //'bootstrap.helpers.TbHtml',
        //'application.modules.messages.models.*',
        //'application.modules.messages.components.*',
        /*'application.modules.rights.*',
        'application.modules.rights.models.*',
        'application.modules.rights.components.*',*/
        'ext.eoauth.*',
        'ext.eoauth.lib.*',
        'ext.lightopenid.*',
        'ext.eauth.*',
        'ext.eauth.services.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'mypassword',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
            //'generatorPaths' => array('bootstrap.gii'),
		),

        'user'=>array(
            # encrypting method (php hash function)
            'hash' => 'md5',
            # send activation email
            'sendActivationMail' => true,
            # allow access for non-activated users
            'loginNotActiv' => false,
            # activate user on registration (only sendActivationMail = false)
            'activeAfterRegister' => false,
            # automatically login from registration
            'autoLogin' => true,
            # registration path
            'registrationUrl' => array('/user/registration'),
            # recovery password path
            'recoveryUrl' => array('/user/recovery'),
            # login form path
            'loginUrl' => array('/user/login'),
            # page after login
            'returnUrl' => array('/user/profile'),
            # page after logout
            'returnLogoutUrl' => array('/user/login'),
        ),
        'friend' => array(
            'userModel' => 'User',
            'getNameMethod' => 'getFullName',
            'getSuggestMethod' => 'getSuggest',
        ),
        'mchat' => array(
            'userModel' => 'User',
        ),
        'message' => array(
            'userModel' => 'User',
            'getNameMethod' => 'getFullName',
            'getSuggestMethod' => 'getSuggest',
        ),

        /*'rights'=>array(
            'install'=>false, // Enables the installer.
        ),*/

        //av
        'post',
        'likes',
        'video',
        'forecast',
        'admin',
        'subscription',
        'comments'=>array(
            //you may override default config for all connecting models
            'defaultModelConfig' => array(
                //only registered users can post comments
                'registeredOnly' => false,
                'useCaptcha' => false,
                //allow comment tree
                'allowSubcommenting' => true,
                //display comments after moderation
                'premoderate' => false,
                //action for postig comment
                'postCommentAction' => 'comments/comment/postComment',
                //super user condition(display comment list in admin view and automoderate comments)
                'isSuperuser'=>'Yii::app()->user->checkAccess("moderate")',
                //order direction for comments
                'orderComments'=>'DESC',
            ),
            //the models for commenting
            'commentableModels'=>array(
                //model with individual settings
                'Post'=>array(
                    'registeredOnly'=>true,
                    'useCaptcha'=>false,
                    'allowSubcommenting'=>true,
                    //config for create link to view model page(page with comments)
                    'pageUrl'=>array(
                        'route'=>'post/post/view',
                        //'route'=>'video/video/view',
                        'data'=>array('id'=>'id'),
                    ),
                ),

                'Video'=>array(
                    'registeredOnly'=>true,
                    'useCaptcha'=>false,
                    'allowSubcommenting'=>true,
                    //config for create link to view model page(page with comments)
                    'pageUrl'=>array(
                        'route'=>'video/video/view',
                        //'route'=>'video/video/view',
                        'data'=>array('id'=>'id'),
                    ),
                ),
                //model with default settings
                'ImpressionSet',
            ),
            //config for user models, which is used in application
            'userConfig'=>array(
                'class'=>'User',
                'nameProperty'=>'username',
                'emailProperty'=>'email',
            ),
        ),
        //av


	),

	// application components
	'components'=>array(
        'EJSUrlManager' => array(
            'class' => 'ext.JSUrlManager.src.EJSUrlManager'
        ),
        'widgetFactory' => array(
            'widgets' => array(
                'CLinkPager' => array(
                    'header' => '',
                    'nextPageLabel'=>'→',
                    'prevPageLabel'=>'←',
                    'lastPageLabel'=>'»',
                    'firstPageLabel'=>'«',
                    'selectedPageCssClass' => 'active',
                    'hiddenPageCssClass' => 'disabled',
                    'htmlOptions' => array(
                        'class' => 'pagination pagination-centered',
                        'style' => 'padding-left: 33%',
                    ),
                ),
            ),
        ),

        'curl' => array(
            'class' => 'ext.curl.Curl',
            'options' => array(/* additional curl options */),
        ),
        'eauth' => array(
            'class' => 'ext.eauth.EAuth',
            'popup' => true, // Use the popup window instead of redirecting.
            'cache' => false, // Cache component name or false to disable cache. Defaults to 'cache'.
            'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
            'services' => array(
                'facebook' => array(
                    // register your app here: https://developers.facebook.com/apps/
                    'class' => 'CustomFacebookService',
                    'client_id' => '687121514736993',
                    'client_secret' => '2a8946642859488c347afd15b037b21d',
                ),
                'vkontakte' => array(
                    // register your app here: https://vk.com/editapp?act=create&site=1
                    'class' => 'CustomVKontakteService',
                    'client_id' => '4637575',
                    'client_secret' => 'SG8Sb3hoIcBPYV4Worpi',
                    'title' => 'VKontakte',
                ),
            ),
        ),
        'loid' => array(
            'class' => 'ext.lightopenid.loid',
        ),
        'cache' => array(
            //'class' => 'CApcCache',
            'class' => 'CFileCache',
        ),

        /*'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),*/

        'user'=>array(
            'class' => 'AuthWebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
        ),

		'urlManager'=>array(
			'urlFormat'=>'path',
            'showScriptName' => false,
			'rules'=>array(
                'login/<service:(google|google-oauth|yandex|yandex-oauth|twitter|linkedin|vkontakte|facebook|steam|yahoo|mailru|moikrug|github|live|odnoklassniki)>' => 'user/login',
                'login' => 'user/login',
                'logout' => 'user/logout',
                /*
                'posts'=>'post/list',
                'post/<id:\d+>'=>'post/read',
                'post/<year:\d{4}>/<title>'=>'post/read',
                */
                'users'=>'user',

                'post'=>'post/post',
                'post/<id:\d+>'=>'post/post/view',
                'video'=>'video/video',
                'video/<id:\d+>'=>'video/video/view',

                'about'=>'site/page/view/about',

                'table/index/<macthday:\d+>' => 'table/macthday',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

                //'' => 'site/index',


			),



		),

        /*'db'=>array(
            'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
        ),*/
        // uncomment the following to use a MySQL database

        'db'=>array(
            'connectionString' => 'mysql:host=localhost;dbname=myproject',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => 'tbl_',
        ),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
