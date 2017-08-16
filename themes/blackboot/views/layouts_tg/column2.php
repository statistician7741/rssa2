<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<div class="span-5">
            <div id="sidebar" style="padding-left: 20px;">
		<?php
		if(Yii::app()->user->getState('level')==2){
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Dimensi',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
                                        array('label'=>'Topik', 'url'=>array('/topik')),
                                        array('label'=>'Variabel', 'url'=>array('/variabel')),
                                        array('label'=>'Wilayah', 'url'=>array('/wilayah')),
                                        array('label'=>'Kategori', 'url'=>array('/kategori')),
                                        array('label'=>'Sumber Data', 'url'=>array('/sumberdata')),
                                ),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Data',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
                            array('label'=>'Tambah', 'url'=>array('/fakta/tambah')),
							array('label'=>'Ubah', 'url'=>array('/fakta/edit')),
                            array('label'=>'Impor', 'url'=>array('/fakta/import')),
                        ),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Lainnya',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
                            array('label'=>'Ensiklopedi Indikator', 'url'=>array('/kamusindikator')),
							array('label'=>'Tabel Tersimpan', 'url'=>array('/tabeltersimpan')),
                        ),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		}else if(Yii::app()->user->getState('level')==1){	
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Admin',
			));
			$this->widget('zii.widgets.CMenu', array(
				'items'=>array(
                            array('label'=>'Beranda', 'url'=>array('/artikel')),
							array('label'=>'Pengguna', 'url'=>array('/admin/pengguna')),
							array('label'=>'Unggah Gambar', 'url'=>array('/admin/upload')),
                        ),
				'htmlOptions'=>array('class'=>'operations'),
			));
			$this->endWidget();
		}	
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