<?php
	function include_template($template, $data) {
		if(is_readable($template)) {
			ob_start();
			extract($data);
			require_once($template);
		} else {
			return '';
		}

		$html = ob_get_clean();
		return $html;
	};

	function searchUserByEmail($email, $users) {
	    foreach($users as $user) {
	        if($user['email'] == $email) {
	            return $user;
            }
        }
        return false;
    }

    function isEmailUsed($email, $users) {
        foreach($users as $user) {
            if($user['email'] == $email) {
                return true;
            }
        }
        return false;
    }

    function set_price($price) {
        $formated_price = ceil($price);
        if ($formated_price < 1000) {
            return $formated_price;
        } else {
            return number_format($formated_price, 0, '', ' ');
        }
    };
