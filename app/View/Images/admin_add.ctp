<?php
echo $this->Form->create('Image', array('enctype' => 'multipart/form-data'));
echo $this->Form->input('Image.documentary_id');
echo $this->Form->input('filename', array('between'=>'<br>','type'=>'file', 'Label'=>"Archivo:"));
echo $this->Form->end("Guardar");