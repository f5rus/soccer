<?php
$this->layout='//layouts/column1';
$this->setPageTitle("Написать сообщение");
?>

<?php $this->widget('application.components.BreadCrumb', array(
    'crumbs' => array(
        array('name' => 'Главная', 'url' => array('/')),
        array('name' => "Сообщения"),
        array('name' => "Написать сообщение"),
    )
)); ?>


<h1 class="h1content"><?php echo "Написать сообщение"; ?></h1>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation'); ?>

<div class="form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-form',
		'enableAjaxValidation'=>false,
	)); ?>

	<!--<p class="note"><?php //echo MessageModule::t('Gh <span class="required">*</span> are required.'); ?></p>-->

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'receiver_id'); ?>
		<?php echo CHtml::textField('receiver', $receiverName) ?>
		<?php echo $form->hiddenField($model,'receiver_id'); ?>
		<?php echo $form->error($model,'receiver_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subject'); ?>
		<?php echo $form->textField($model,'subject'); ?>
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body'); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton(MessageModule::t("Send")); ?>
	</div>

	<?php $this->endWidget(); ?>

</div>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>
