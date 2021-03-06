<?php
$this->layout='//layouts/column1';
$this->setPageTitle($model->rusname);
?>

<?php $this->widget('application.components.BreadCrumb', array(
    'crumbs' => array(
        array('name' => 'Главная', 'url' => array('')),
        array('name' => 'Игроки', 'url' => array('/player/')),
        array('name' => $model->rusname),
    )
)); ?>

<h1 class="h1content"><?php echo 'Игрок <strong>«'.$model->rusname.'» </strong>'; ?></h1>

<div style="">
<div class="userspage">
    <div style="text-align: center;" class="left_soccer_content">
        <div class="south" title="Фотография игрока" style="margin-bottom:5px"><span class="photo3"><span class="user_avatar">
                    <?php echo ($model->photo_img)?CHtml::image(Yii::app()->baseUrl.'/images/soccer/player/'.$model->photo_img):CHtml::image(Yii::app()->baseUrl.'/images/noavatar.gif'); ?>
                </span>
            </span>
        </div>


    </div>
    <div class="right_soccer_content">

        <div class="info_team">
            <div class="info_team_field"><div class="spanup width100">Команда</div> <div style="background: url('<?php if (isset($team->team->logo_img)) echo Yii::app()->baseUrl.'/images/soccer/team/'.$team->team->logo_img; ?>') no-repeat 0 0; background-size: 14px 14px; padding-left:20px;" class="info_team_value spanup"> <?php echo CHtml::link($team->team->rusname,array("/team/view","id"=>$team->team->id)); ?></div></div>

            <?php if ($model->country->id!=0): ?> <div class="info_team_field"><div class="spanup width100">Страна</div> <div style="background: url('<?php if (isset($model->country->image)) echo Yii::app()->baseUrl.'/images/soccer/country/'.$model->country->image; ?>') no-repeat 0 0; padding-left:20px;" class="info_team_value spanup"> <?php echo $model->country->name; ?></div></div><?php endif; ?>

            <?php if (isset($model->name)): ?><div class="info_team_field"><div class="spanup width100">Имя</div> <div class="info_team_value spanup"><?php echo $model->name; ?></div></div><?php endif; ?>
            <?php if (isset($model->city) && $model->city!=""): ?><div class="info_team_field"><div class="spanup width100">Город</div> <div class="info_team_value spanup"><?php echo $model->city; ?></div></div><?php endif; ?>
            <?php if (isset($model->birth_day) && $model->birth_day!="0000-00-00"): ?><div class="info_team_field"><div class="spanup width100">Родился</div> <div class="info_team_value spanup"><?php echo "".Date("d.m.Y",strtotime($model->birth_day))." (".Date::getAge($model->birth_day)." ".Yii::t('yii','год|года|лет',Date::getAge($model->birth_day)).")"; ?></div></div><?php endif; ?>

            <?php if (isset($model->number)): ?><div class="info_team_field"><div class="spanup width100">Номер</div> <div class="info_team_value spanup"><?php echo $model->number; ?></div></div><?php endif; ?>
            <?php if (isset($model->pos)): ?><div class="info_team_field"><div class="spanup width100">Позиция</div> <div class="info_team_value spanup"><?php echo $model->pos; ?></div></div><?php endif; ?>
            <?php if (isset($model->workingleg) && $model->workingleg!=0): ?><div class="info_team_field"><div class="spanup width100">Рабочая нога</div> <div class="info_team_value spanup"><?php echo $model->workingleg; ?></div></div><?php endif; ?>
            <?php if (isset($model->growth) && $model->growth!=0): ?><div class="info_team_field"><div class="spanup width100">Рост</div> <div class="info_team_value spanup"><?php echo $model->growth." см"; ?></div></div><?php endif; ?>
            <?php if (isset($model->weight) && $model->weight!=0 ): ?><div class="info_team_field"><div class="spanup width100">Вес</div> <div class="info_team_value spanup"><?php echo $model->weight." кг"; ?></div></div><?php endif; ?>
            <?php if (isset($model->price) && $model->price!=0): ?><div class="info_team_field"><div class="spanup width100">Цена</div> <div class="info_team_value spanup"><?php echo $model->price." €"; ?></div></div><?php endif; ?>


        </div>
    </div>
</div>
</div>

<div class="short-stat-container">
    <strong class="short-statistic-descr">Мини-статистика сезона 2014/2015:</strong>
    <div class="short-statistic">
        <div class="item">
            <div class="line-th">Игры</div>
            <div class="line-td"><?php echo $stats['games']; ?></div>
        </div>
        <div class="item">
            <div class="line-th">Голы</div>
            <div class="line-td"><?php echo $stats['goals']; ?></div>
        </div>
        <div class="item">
            <div class="line-th">Голевые передачи</div>
            <div class="line-td"><?php echo $stats['assists']; ?></div>
        </div>
        <div class="item">
            <div class="line-th">Желтые/красные катрочки</div>
            <div class="line-td"><?php echo $stats['yellowcards']."<span>/".$stats['redcards']."</span>"; ?></div>
        </div>
        <div style="clear:both"></div>
    </div>

</div>

<div class="game-container">
    <div style="padding-bottom:5px;"><strong class="short-statistic-descr">Последние сыгранные матчи:</strong></div>
    <ul>

        <?php /*foreach($lastgames as $game): ?>
            <?php $this->renderPartial('_view',array(
                'model'=>$game,
            )); */?>
        <?php //endforeach; ?>
        <?php /*foreach($nextgames as $game): ?>
            <?php $this->renderPartial('_view',array(
                'model'=>$game,
            )); */?>
        <?php //endforeach; ?>
    </ul>
</div>
