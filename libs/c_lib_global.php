<?php
	
	// include all lib class
	include __DIR__.'/utils/c_error.php';
	include __DIR__.'/db/c_db_mysql.php';
	include __DIR__.'/regex/c_regex.php';
	include __DIR__.'/rand/c_random.php';

	class C_lib_global
	{
		private $conf_json;

		private $c_error;
		private $c_db_mysql;
		private $c_regex;
		private $c_random;

		public function __construct() {

			$this->conf_json = json_decode(file_get_contents(__DIR__.'./../conf/conf.json'), true);
			
			$this->c_error = new C_error();
			$this->c_db_mysql = new C_db_mysql($this->conf_json);
			$this->c_regex = new C_regex();
			$this->c_random = new C_random();

			// $this->c_db_mysql->close_conn();
		}

		public function get_c_error() {
			return $this->c_error;
		}

		public function get_c_db_mysql() {
			return $this->c_db_mysql;
		}

		public function get_c_regex() {
			return $this->c_regex;
		}

		public function get_c_random() {
			return $this->c_random;
		}
	}

?>