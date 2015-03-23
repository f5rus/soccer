<?php
$this->layout='//layouts/column1';
$this->setPageTitle("Список игроков");
?>

<?php $this->widget('application.components.BreadCrumb', array(
    'crumbs' => array(
        array('name' => 'Главная', 'url' => array('/')),
        array('name' => 'Игроки'),
    )
)); ?>

<h1 class="h1content"><?php echo 'Список игроков'; ?></h1>

<ul class="userlist">
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView' => '/player/_view',
        'sortableAttributes'=>array(
            'rusname',
            'birth_day',
            'price',
            'growth',
            'weight',
        ),
        'sorterHeader' => 'Сортировать по:',
        'summaryText' => 'Всего игроков: <strong>{count}</strong> | Показано с <strong>{start}</strong> по <strong>{end}</strong>',
        'pagerCssClass'=>'custom-pager',
    )); ?>
</ul>

<style>ul.pagination{padding-left: 0 !important;}</style>



