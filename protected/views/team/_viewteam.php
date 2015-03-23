<li class="user2">
    <div class="useravatar">
        <?php echo CHtml::link(($data->logo_img)?CHtml::image(Yii::app()->baseUrl."/images/soccer/team/".$data->logo_img):CHtml::image(Yii::app()->baseUrl."/".'images/noavatar.gif'),array("team/view","id"=>$data->id)); ?>
    </div>
    <div class="userlogin">
        <?php echo CHtml::link(CHtml::encode($data->rusname),array("team/view","id"=>$data->id)) ?>
    </div>
    <div class="username">
        <?php
        echo CHtml::encode($data->name);?>
    </div>
</li>