<?php
$this->layout='//layouts/column1';
$this->setPageTitle("Список тренеров");
?>

<?php $this->widget('application.components.BreadCrumb', array(
    'crumbs' => array(
        array('name' => 'Главная', 'url' => array('/')),
        array('name' => 'Тренеры'),
    )
)); ?>

<h1 class="h1content"><?php echo 'Список тренеров'; ?></h1>

<ul class="userlist">
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView' => '/coach/_view',
        'sorterHeader' => '',
        'summaryText' => '',
        'pagerCssClass'=>'custom-pager',
    )); ?>
</ul>



