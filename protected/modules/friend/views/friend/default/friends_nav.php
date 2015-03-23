<style>
    a.active{font-weight: bold;}
    .friends_nav {margin:12px 8px;}
    .friends_nav {height: 30px; border-radius: 5px; background: #f4f4f4; padding-top: 15px; padding-left: 20px; margin-bottom: 10px;}
    .friends_nav div a{text-decoration: none; color:#555; padding-right:15px;}
    .friends_nav div a:hover{color:#999;}

</style>

<div class="friends_nav">
    <div style="font-size: 14px; float:left;">

        <a href="<?php echo Yii::app()->baseUrl."/friend/my"?>" class="<?php echo $friend; ?>">Мои друзья</a>
        <a href="<?php echo Yii::app()->baseUrl."/friend/my/followed"?>" class="<?php echo $fol; ?>">Мои подписчики</a>
        <a href="<?php echo Yii::app()->baseUrl."/friend/my/followers"?>" class="<?php echo $sub; ?>">Ваши подписки</a>

    </div>
</div>