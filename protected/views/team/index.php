<?php
$this->layout='//layouts/column1';
$this->setPageTitle("Список команд");
?>

<?php $this->widget('application.components.BreadCrumb', array(
    'crumbs' => array(
        array('name' => 'Главная', 'url' => array('/')),
        array('name' => 'Команды'),
    )
)); ?>

<h1 class="h1content"><?php echo 'Список команд'; ?></h1>

<ul class="userlist">
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView' => '/team/_viewteam',
        'sorterHeader' => '',
        'summaryText' => '',
        'pagerCssClass'=>'custom-pager',
    )); ?>
</ul>



