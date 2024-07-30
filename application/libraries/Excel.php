
<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Excel
{
	public function __construct()
	{
		// Path ke file autoload.php
		require_once APPPATH . 'third_party/PHPExcel/Classes/PHPExcel.php';
		require_once APPPATH . 'third_party/PHPExcel/Classes/PHPExcel/IOFactory.php';
		spl_autoload_register(function ($class) {
			// Adjust the path to the PHPExcel classes
			$class = str_replace('_', DIRECTORY_SEPARATOR, $class);
			include APPPATH . 'third_party/PHPExcel/Classes/' . $class . '.php';
		});
	}
}
