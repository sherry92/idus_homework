<?php

	class C_db_mysql
	{
		private $conn_write;
		private $conn_read;

		const SUCCESS_ = 0;

		const ERROR_QUERY_PARAMETER = 1001;

		const ERROR_DUPLICATE_MEMBER = 1101; 

		private function create_conn($conf_json) {
			$this->conn_write = mysqli_connect(
											$conf_json["DB_WRITE"]["HOST"], 
											$conf_json["DB_WRITE"]["USER"],
											$conf_json["DB_WRITE"]["PWD"],
											$conf_json["DB_WRITE"]["DB_NAME"]);

			// if (mysqli_connect_errno())
			// {
			// 	echo "Failed to connect to Write MySQL: ".mysqli_connect_error();
			// }
			// else 
			// {
			// 	echo "Success to connect to Write MySQL";
			// }

			$this->conn_write->set_charset('utf8');

			$this->conn_read = mysqli_connect(
											$conf_json["DB_READ"]["HOST"],
											$conf_json["DB_READ"]["USER"],
											$conf_json["DB_READ"]["PWD"],
											$conf_json["DB_READ"]["DB_NAME"]);

			// if (mysqli_connect_errno())
			// {
			// 	echo "Failed to connect to Read MySQL: ".mysqli_connect_error();
			// }
			// else
			// {
			// 	echo "Success to connect to Read MySQL";
			// }

			$this->conn_read->set_charset('utf8');
		}

		private function create_table() {
			$sql = "CREATE TABLE IF NOT EXISTS `members`("
					."`name` VARCHAR(20) NOT NULL, "
					."`nick_name` VARCHAR(30) NOT NULL, "
					."`passwd` VARCHAR(30) NOT NULL, "
					."`phone_num` VARCHAR(20) NOT NULL, "
					."`email_addr` VARCHAR(100) NOT NULL, "
					."`sex` CHAR(1), "
					."`last_order` VARCHAR(12), "
					."`session_id` CHAR(32), "
					."PRIMARY KEY(`nick_name`), "
					."KEY name_email_key (`name`, `email_addr`)"
					.") ENGINE=InnoDB DEFAULT CHARSET=utf8";

			mysqli_query($this->conn_write, $sql);

			// if(mysqli_query($this->con_write, $sql))
			// {
			// 	echo "Table members created successfully";
			// }
			// else
			// {
			// 	echo "Error creating table: ".mysqli_error($this->con_write);
			// }

			$sql = "CREATE TABLE IF NOT EXISTS `orders` ("
					."`order_num` CHAR(12) NOT NULL, "
					."`product_name` VARCHAR(100) NOT NULL, "
					."`payment_time` DATETIME NOT NULL, "
					."`orderer_nick_name` VARCHAR(30) NOT NULL, "
					."PRIMARY KEY (`order_num`), "
					."KEY orderer (`orderer_nick_name`) "
					.") ENGINE=InnoDB DEFAULT CHARSET=utf8";

			mysqli_query($this->conn_write, $sql);

			// if(mysqli_query($this->con_write, $sql))
			// {
			// 	echo "Table orders created successfully";
			// }
			// else
			// {
			// 	echo "Error creating table: ".mysqli_error($this->con_write);
			// }
		}

		private function _insert_member($signup_form) {
			$sql = "SELECT count(*) as cnt FROM members WHERE nick_name = ?";
			
			$pstmt = $this->conn_read->prepare($sql);
			$pstmt->bind_param("s", $signup_form['nick_name']);

			if (!$pstmt->execute()) {
				return self::ERROR_QUERY_PARAMETER;
			}
			$result = $pstmt->get_result()->fetch_assoc()['cnt'];

			if ($result != 0) {
				return self::ERROR_DUPLICATE_MEMBER; 
			}

			$sql = "INSERT INTO members (name, nick_name, passwd, phone_num, email_addr, sex) VALUES (?,?,?,?,?,?)";

			$pstmt = $this->conn_write->prepare($sql);
			$pstmt->bind_param("ssssss", 
								$signup_form['name'],
								$signup_form['nick_name'],
								$signup_form['pwd'],
								$signup_form['phone_num'],
								$signup_form['email_addr'],
								$signup_form['sex']);
			
			if (!$pstmt->execute()) return self::ERROR_QUERY_PARAMETER;

			return self::SUCCESS_;
		}

		private function init($conf_json) {
			$this->create_conn($conf_json);
			$this->create_table();
		}

		public function __construct($conf_json) {
			$this->init($conf_json);
		}

		public function insert_member($signup_form) {
			return $this->_insert_member($signup_form);
		}

		public function close_conn() {
			mysqli_close($this->conn_write);
			mysqli_close($this->conn_read);
		}
	}
?>