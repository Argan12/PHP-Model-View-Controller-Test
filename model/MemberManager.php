<?php
	require_once('model/Database.php');
	
	class MemberManager extends Database {
		public function newMember($firstname, $lastname, $mail_address, $password) {
			$database = $this->dbConnect();
			$psswd_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$new_member = $database->prepare('INSERT INTO newmembers(firstname, lastname, mail_address, password, date) VALUES(?, ?, ?, ?, NOW())');
			$register = $new_member->execute(array(htmlspecialchars($firstname), htmlspecialchars($lastname), htmlspecialchars($mail_address), htmlspecialchars($psswd_hash)));

			return $register;
		}
	
		public function accessAllowed($mail_address, $password) {
			$database = $this->dbConnect();
			$log = $database->prepare('SELECT member_id, firstname, lastname, mail_address, password FROM newmembers WHERE mail_address=?');
			$log->execute(array($mail_address));
				
			return $log;
		}
	}	