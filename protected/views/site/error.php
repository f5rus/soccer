<?php
$this->layout='//layouts/column1';
$this->setPageTitle("Ошибка");
?>

<?php $this->widget('application.components.BreadCrumb', array(
    'crumbs' => array(
        array('name' => 'Главная', 'url' => array('/')),
        array('name' => 'Ошибка'),
    )
)); ?>

<h1 class="h1content"><?php echo 'Ошибка сайта '.$code; ?></h1>

<div class="error">
    <h2><?php if ($message=='The requested page does not exist.') echo "Данной страницы не существует!"; else echo CHtml::encode($message) ?></h2>
</div>

<p>Через <b><span id="timeee">10</span></b> секунд вы будете перенаправлены на главную страницу сайта!</p>
<p>Если перенаправление не сработало, нажмите <a href="<?php echo Yii::app()->baseUrl; ?>"><b>сюда</b></a></p>


<script language="JavaScript" type="text/javascript">
    function Oyy(){
        location=Yii.app.createUrl('/');
        //alert("kuku");
    }
    function Oyy2(){
        var k= +document.getElementById('timeee').innerHTML;
        k--;
        document.getElementById('timeee').innerHTML=k;
        setTimeout( 'Oyy2()', 1000 );
    }

    setTimeout( 'Oyy()', 10000 );
    setTimeout( 'Oyy2()', 1000 );

</script>