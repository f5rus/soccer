<?php
$this->layout='//layouts/column1';
$this->setPageTitle("Список стадионов");
?>

<?php $this->widget('application.components.BreadCrumb', array(
    'crumbs' => array(
        array('name' => 'Главная', 'url' => array('/')),
        array('name' => 'Стадионы'),
    )
)); ?>

<h1 class="h1content"><?php echo 'Список стадионов'; ?></h1>

<ul class="userlist">
    <?php $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView' => '/stadium/_view',
        'sorterHeader' => '',
        'summaryText' => '',
        'pagerCssClass'=>'custom-pager',
    )); ?>
</ul>



