<?php if($head && $number==1): ?>
<li class="table t-th">
    <div class="item number">
        <div class="line-th table-th">#</div>
    </div>
    <div class="item teamhome">
        <div class="line-td table-th">Игрок</div>
    </div>
    <div class="item width150">
        <div class="line-th table-th">Команда</div>
    </div>


    <div class="item width30">
        <div class="line-th table-th"><strong>Голы</strong></div>
    </div>

    <div class="item width30">
        <div class="line-th table-th">РП</div>
    </div>
    <div class="item width30">
        <div class="line-th table-th">ГП</div>
    </div>
</li>
<?php endif; ?>

<li class="table" id="tbl-<?php echo $player->id; ?>" data-team-id="<?php echo $player->id; ?>" data-nubmer="<?php echo $number; ?>">
    <div class="item number">
        <div class="line-th">
            <span><?php echo $number; ?></span>
        </div>
    </div>
    <div class="item teamhome">
        <div class="line-td">
            <?php echo CHtml::link($player->rusname,array('//player/'.$player->id),array('style'=>'background-image: url('.Yii::app()->baseUrl."/images/soccer/player/".$player->photo_img.'); padding-left:18px; background-position: top left; "')); ?>
        </div>
    </div>
    <div class="item width150">
        <div class="line-th"><div style="background: url('<?php if (isset($team->logo_img)) echo Yii::app()->baseUrl.'/images/soccer/team/'.$team->logo_img; ?>') no-repeat 0 0; background-size: 14px 14px; padding-left:20px;" class="info_team_value spanup"> <strong><?php echo CHtml::link($team->rusname,array("/team/view","id"=>$team->id)); ?></strong></div></div>
    </div>


    <div class="item width30">
        <div class="line-th"><strong><?php echo $stats['goals'];?></strong></div>
    </div>

    <div class="item width30">
        <div class="line-th"><?php echo $stats['pen_score'];?></div>
    </div>
    <div class="item width30">
        <div class="line-th"><?php echo $stats['assists'];?></div>
    </div>

</li>