<?php
	function include_template($template, $data) {
		if(is_readable($template)) {
			ob_start();
			extract($data);
			echo require_once($template);
		} else {
			echo '';
		}

		$html = ob_get_clean();
		return $html;
	};
?>