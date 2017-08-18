<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if( ! function_exists('user_role') )
{
	function user_role($user_type = 'administrator')
	{
		switch ($user_type) {
			case 'administrator':
				return 'Super Admin';
				break;
			case 'reader':
				return 'Pembaca';
				break;
			case 'operator':
				return 'Operator';
				break;
			case 'writer':
				return 'Penulis';
				break;
			default:
				# code...
				break;
		}
	}
}

/* End of file admin_helper.php */
/* Location: ./application/helpers/admin_helper.php */