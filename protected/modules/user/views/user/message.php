<?php
//$this->layout='//layouts/column2';
$this->setPageTitle(UserModule::t("Login"));
?>

<?php $this->widget('application.components.BreadCrumb', array(
    'crumbs' => array(
        array('name' => 'Главная', 'url' => array('/')),
        array('name' => UserModule::t("Login")),
    )
)); ?>

<h1 class="h1content"><?php echo  $title; ?></h1>

<div class="form">
    <?php echo $content; ?>

</div><!-- yiiForm -->

