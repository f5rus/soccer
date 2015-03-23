<?php
$this->layout='//layouts/column1';
$this->setPageTitle("Список бомбардиров");
?>

<?php $this->widget('application.components.BreadCrumb', array(
    'crumbs' => array(
        array('name' => 'Главная', 'url' => array('/')),
        array('name' => "Список бомбардиров"),
    )
)); ?>



<h1 class="h1content"><?php echo 'Список бомбардиров'; ?></h1>

    <div class="table-container">
    <div style="padding-bottom:5px;"></div>
    <ul>
        <?php for($i=0;$i<count($players);$i++): ?>
            <?php $this->renderPartial('_view',array(
                'player'=>$players[$i],
                'stats'=>$stats[$i],
                'team'=>$teams[$i],
                'number'=>($i+1),
                'head'=>true,
            )); ?>
        <?php endfor; ?>
    </ul>
</div>
<strong>Обозначения:</strong> <b>ГП</b> - Голевые передачи, <b>РП</b> - Реализованые пенальти.

<style>
    .table-container {overflow:hidden; margin:20px 0 12px;}
    .table {width: 100%; float:left; height:20px; line-height:20px; background:#e8e8e0; border-radius:3px; font-size:11px; color:#000; margin:2px 10px 0 0;}
    .table:hover {background: rgba(18, 158, 248, 0.14)
    }
    .table .table-th{color: white !important; font-weight: bold;}
    .t-th{background: #4096EA;  height:24px; line-height:24px;}
    .table .item {padding:0 6px; float:left; border-left:0px solid #c8c8c3;}


    .table .item:first-child {border-left:0;}
    .table .width50 {width:50px}
    .table .width30 {width:30px}
    .table .width70 {width:70px}
    .table .width150 {width:180px}
    .table .number {width:18px;}
    .table .teamhome {width:170px;}
    .table .teamhome .line-td {float:left;}
    .table .teamhome a, .game .teamaway a,.table .line-th div a{text-decoration: none; color: #222;height: 16px; background-repeat: no-repeat; background-size: 14px 14px;}
    .table .teamhome a:hover, .game .teamaway a:hover{color: #444}
    .table .teamaway {width:130px; text-align:left;}
    .table .score a{text-decoration:none; color:white; padding: 0 10px; border-radius: 2px;}
    .table .score a.fulltime{background: #fe444b;}
    .table .score a.nulltime{background: #bbb;}
    .table .score a:hover{background: #888}
    .table .line-th {float:left; font-size: 12px; text-align:center; color: #555; margin:0px 0px 0 0;}
    .table .line-th span {color: #888;}
    .table .line-td {font-size:13px; font-weight:bold; float:left;}
    .table .line-td span {font-size:17px; color: #555;}

    .short-statistic-descr {color:#a1a1a1; overflow:hidden;margin:5px;}
</style>