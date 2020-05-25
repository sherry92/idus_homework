<?php
	class C_error
	{
		const SUCCESS_ = 0;

		const ERROR_QUERY_PARAMETER = 1001;

		const ERROR_DUPLICATE_MEMBER = 1101;

		const ERROR_VALUE_INVALID = 2001;

		const ERR_MSG = array(
						self::SUCCESS_ => 'Success',
						self::ERROR_QUERY_PARAMETER => 'Error, Some query parameter invalid',
						self::ERROR_DUPLICATE_MEMBER => 'Error, Member is already singed up',
						self::ERROR_VALUE_INVALID => 'Error, Some value is invalid'
						);
	}
?>