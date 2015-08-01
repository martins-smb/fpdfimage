<?php
	require('VariableStream.php');
	use \fpdf\FPDF;
	
	class FPDFImage extends FPDF {
		public function __construct($orientation='P', $unit='mm', $format='A4') {
			parent::__construct($orientation, $unit, $format);
			stream_wrapper_register('var', 'VariableStream');
		}
	
		function setImage($data, $x=null, $y=null, $w=0, $h=0, $link='') {
			$v = 'img'.md5($data);
			$GLOBALS[$v] = $data;
			$a = getimagesize('var://'.$v);
			if(!$a)
				$this->Error('Invalid image data');
			$type = substr(strstr($a['mime'],'/'),1);
			$this->Image('var://'.$v, $x, $y, $w, $h, $type, $link);
			unset($GLOBALS[$v]);
		}
	
		function GDImage($im, $x=null, $y=null, $w=0, $h=0, $link='') {
			ob_start();
			imagepng($im);
			$data = ob_get_clean();
			$this->setImage($data, $x, $y, $w, $h, $link);
		}
	}
?>
