<?php  
  $baseUrl = Yii::app()->theme->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerScriptFile('http://www.google.com/jsapi');
  $cs->registerCoreScript('jquery');
  $cs->registerScriptFile($baseUrl.'/js/jquery.gvChart-1.0.1.min.js');
  $cs->registerScriptFile($baseUrl.'/js/pbs.init.js');
  $cs->registerCssFile($baseUrl.'/css/jquery.css');

  
  $baseUrl = Yii::app()->theme->baseUrl; 
  $cs = Yii::app()->getClientScript();
  $cs->registerCssFile($baseUrl.'/css/jquery.css');
  
  $this->pageTitle=Yii::app()->name . ' - Interface Elements';

  $sample_content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed turpis diam, facilisis nec egestas quis, pharetra eget diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed turpis diam, facilisis nec egestas quis, pharetra eget diam. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed turpis diam, facilisis nec egestas quis, pharetra eget diam.';
?>

<?php $this->pageTitle=Yii::app()->name; ?>

<h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
<!--<div class="flash-error">This is an example of an error message to show you that things have gone wrong.</div>
<div class="flash-notice">This is an example of a notice message.</div>
<div class="flash-success">This is an example of a success message to show you that things have gone according to plan.</div>-->

<div class="span-13">
<h3>Artikel Terkini</h3>
<?php
$this->widget('zii.widgets.jui.CJuiAccordion', array(
    'panels'=>array(
        'Artikel 1'=>$sample_content,
        'Artikel 2'=>$sample_content,
		'Artikel 3'=>$sample_content, 
        // panel 3 contains the content rendered by a partial view
        //'panel 3'=>$this->renderPartial('_partial',null,true),
    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        'animated'=>'bounceslide',
    ),
	'htmlOptions'=>array('class'=>'shadowaccordion'),
));
?>
</div>

<div class="span-13 last">
<h3>Artikel Terpopuler</h3>
<?php
$this->widget('zii.widgets.jui.CJuiAccordion', array(
    'panels'=>array(
        'Artikel 1'=>$sample_content,
        'Artikel 2'=>$sample_content,
		'Artikel 3'=>$sample_content, 
        // panel 3 contains the content rendered by a partial view
        //'panel 3'=>$this->renderPartial('_partial',null,true),
    ),
    // additional javascript options for the accordion plugin
    'options'=>array(
        'animated'=>'bounceslide',
    ),
	'htmlOptions'=>array('class'=>'shadowaccordion'),
));
?>
<br/>
</div>


<!--<div class="flash-notice span-22 last">
<p>This is a "static" page. You may change the content of this page
by updating the file <tt><?php echo __FILE__; ?></tt>.</p>
</div>-->