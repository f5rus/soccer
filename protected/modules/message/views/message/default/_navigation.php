<style>
    a.active{font-weight: bold;}
    .friends_nav {margin:12px 8px;}
    .friends_nav {height: 30px; border-radius: 5px; background: #f4f4f4; padding-top: 15px; padding-left: 20px; margin-bottom: 10px;}
    .friends_nav div a{text-decoration: none; color:#555; padding-right:15px;}
    .friends_nav div a:hover{color:#999;}

</style>

<div class="friends_nav">
    <div style="font-size: 14px; float:left;">


        <a href="<?php echo $this->createUrl('inbox/') ?>">Входящие
            <?php if (Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId())): ?>
                (<?php echo Yii::app()->getModule('message')->getCountUnreadedMessages(Yii::app()->user->getId()); ?>)
            <?php endif; ?>
        </a>
        <a href="<?php echo $this->createUrl('sent/sent') ?>">Отправленные</a>
        <a href="<?php echo $this->createUrl('compose/') ?>">Написать сообщение</a>

    </div>
</div>

<?php if(Yii::app()->user->hasFlash('messageModule')): ?>
	<div class="success">
		<?php echo Yii::app()->user->getFlash('messageModule'); ?>
	</div>
<?php endif; ?>
