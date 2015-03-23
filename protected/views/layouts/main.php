<?php /* @var $this Controller */
Yii::app()->clientScript->scriptMap['jquery.js'] = false;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="icon" href="<?php echo Yii::app()->baseUrl."/icon.png"; ?>" type="image/x-icon">
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/posts.css" />

    <!--<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>-->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery-1.11.0.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tipsy.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/cookie.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle)." - ".Text::getSiteName(); ?></title>
</head>
<body>




<?php $this->widget('application.extensions.widgets.topbar.TopBarWidget', array(
    'username' => (Yii::app()->user->isGuest)?"Гость":Yii::app()->user->name,
)); ?><!-- /topbar -->



<div id="main" style="width:1080px; margin: 0 auto; background: rgb(244, 244, 244); margin-top:45px;">
    <?php echo $content; ?>
</div><!-- main -->


<div class="footer"> <!--style="background: url('<?php //echo Yii::app()->baseUrl; ?>/images/design/footerlogo.png') no-repeat top right;"-->
    <div class="nav">
        <span>© <?php echo date("Y",strtotime("now")); ?> <strong><a style="border:0; padding:0" href="<?php echo Yii::app()->CreateUrl('/'); ?>">LIONSHOT.RU</a></strong></span>
        <a class="footerlink" href="<?php echo Yii::app()->CreateUrl('/about'); ?>">О сайте</a>
        <a class="footerlink" href="<?php echo Yii::app()->CreateUrl('/users'); ?>">Пользователи</a>
        <a class="footerlink" href="<?php echo Yii::app()->CreateUrl('/rules'); ?>">Правила</a>
        <a class="footerlink" href="<?php echo Yii::app()->CreateUrl('/api'); ?>">API</a>
    </div>
</div><!-- /footer -->

<?php if(!Yii::app()->user->isGuest): ?>
<script>

    $(document).ready( function () {

        var uid=<?php echo Yii::app()->user->getId(); ?>; //$(this).data("user-id");
        //user_name = $(this).parent().prev().prev().html();
        // alert(user_name);
        $.ajax({
            url: '<?php echo Yii::app()->CreateUrl("/user/profile/activity"); ?>',
            type: 'GET',
            data: "id="+uid,
            success: function (html) {
                //current_page=$("#yw1 .selected a").html();
                //new Noty('Онлайн: '+html+'!',4000);
                //$(".userlist").load($('#createurl-userpage').html()+current_page+' .userlist');
                onlineuser();
                return;
            }
        });
    });
</script>
<?php endif;?>

<script>
    function onlineuser() {
        //alert('yess');
        $.get('<?php echo Yii::app()->CreateUrl("/user/user/online",array("action"=>"count")); ?>', function(content){
            if (content=="0"){
                $(".useronline").parent().parent().hide();//html("Пользователей онлайн нет");
            }
            else {
                var text="пользователей";
                $(".useronline").parent().parent().show();
                $(".useronline").html(content);
            }
            //new Noty('Онлайн: '+content+'!',4000);
        });
        setTimeout(function(){onlineuser()},60000)
    }
    onlineuser();
</script>

<div id="scrollTop" style="width: 100px; display: block;"><div id="scrollTopButton">Вверх!</div></div>

</body>
</html>














