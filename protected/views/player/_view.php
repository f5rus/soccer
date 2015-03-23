<li class="user2">
    <div class="useravatar2">
        <?php echo CHtml::link(($data->photo_img)?CHtml::image(Yii::app()->baseUrl."/images/soccer/player/".$data->photo_img):CHtml::image(Yii::app()->baseUrl."/".'images/noavatar.gif'),array("player/view","id"=>$data->id)); ?>
    </div>
    <div class="userlogin">
        <?php echo CHtml::link(CHtml::encode($data->rusname),array("player/view","id"=>$data->id)) ?>
    </div>
    <div class="username">
        <?php
        echo CHtml::encode($data->name);?>
    </div>
</li>