<?php
	class C_random
	{
		private $order_num_charset = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		private $order_num_len = 12;

		public function gen_order_num() {
			$order_num = "";
			$nmr_loops = $this->order_num_len;

			while($nmr_loops--) 
			{
				$order_num .= $this->order_num_charset[mt_rand(0, strlen($this->order_num_charset))];
			}

			return $order_num;
		}
	}
?>