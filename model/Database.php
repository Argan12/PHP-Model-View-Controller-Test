<!-- Connection to database -->

<?php 
	abstract class Database {
		protected function dbConnect() {
			$database = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
			return $database;
		}
	}
