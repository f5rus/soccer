<li class="user2">
    <div class="useravatar">
        <?php echo CHtml::link(($data->photo_img)?CHtml::image(Yii::app()->baseUrl."/images/soccer/stadium/".$data->photo_img):CHtml::image(Yii::app()->baseUrl."/".'images/noavatar.gif'),array("stadium/view","id"=>$data->id)); ?>
    </div>
    <div class="userlogin">
        <?php echo CHtml::link(CHtml::encode($data->name),array("stadium/view","id"=>$data->id)) ?>
    </div>
    <div class="username">
        <?php
        echo CHtml::encode($data->city);?>
    </div>
</li>