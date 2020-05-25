<?php
	
	class C_regex
	{
		private $member_name_regex = "/^[가-힣a-zA-Z]{1,20}$/";
		private $member_nick_name_regex = "/^[a-z]{1,30}$/";
		private $member_pwd_regex = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%&*])[A-Za-z\d!@#$%&*]{10,30}$/";
		private $member_email_addr_regex = "/^[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_\.]?[0-9a-zA-Z])*\.[a-zA-Z]{2,3}$/i";
		private $member_phone_num_regex = "/^[0-9]{9,11}$/";

		private $product_name_regex = "/^(.+){1,100}$/";

		const SUCCESS_ = 0;
		const ERROR_VALUE_INVALID = 2001;

		private function _signup_form_check($signup_form) {
			$ret = true;
			
			// props check
			$ret = $ret && array_key_exists("name", $signup_form);
			$ret = $ret && array_key_exists("nick_name", $signup_form);
			$ret = $ret && array_key_exists("pwd", $signup_form);
			$ret = $ret && array_key_exists("phone_num", $signup_form);
			$ret = $ret && array_key_exists("email_addr", $signup_form);

			if(array_key_exists("sex", $signup_form)) {
				if ($signup_form["sex"] == 'M' || $signup_form["sex"] == 'F') {
					$ret = $ret && true;
				}
				else {
					$ret = $ret && false;
				}
			}

			if(!$ret) {
				return $ret;
			}

			// regex check 
			$ret = $ret && preg_match($this->member_name_regex, $signup_form["name"]);
			$ret = $ret && preg_match($this->member_nick_name_regex, $signup_form["nick_name"]);
			$ret = $ret && preg_match($this->member_pwd_regex, $signup_form["pwd"]);
			$ret = $ret && preg_match($this->member_phone_num_regex, $signup_form["phone_num"]);
			$ret = $ret && preg_match($this->member_email_addr_regex, $signup_form["email_addr"]);

			return $ret;
		}

		public function signup_form_check($signup_form) {
			if($this->_signup_form_check($signup_form)) return self::SUCCESS_;
			return self::ERROR_VALUE_INVALID;
		}
	}
?>