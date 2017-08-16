<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-5">
            <div id="sidebar" style="padding-left: 20px;">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Profil Web',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
                                        array('label'=>'Table Generator', 'url'=>array('/site/tg')),
                                ),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Penyusun',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
							array('label'=>'Penanggung Jawab', 'url'=>array('/site/penanggungjawab')),
							array('label'=>'Angkatan 49 DAPS', 'url'=>array('/site/angkatan49')),
                        ),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();	
		?>
		</div><!-- sidebar -->
	</div>
	<div class="span-19 last">
		<div id="content">
			<?php echo $content; ?>
		</div><!-- content -->
	</div>
</div>
<?php $this->endContent(); ?>