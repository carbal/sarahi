<?php 
	function getZona($id){
		$zona = '';
		switch ($id) {
			case 1:
				$zona = 'YUCATÁN';
				break;
			case 2:
				$zona = 'QUINTANA ROO';
				break;
			case 3:
				$zona = 'CAMPECHE';
				break;
			default:
				$zona = 'ERROR!';
				break;
		}

		return $zona;
	}
 ?>