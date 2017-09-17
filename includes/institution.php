<?php
	class Institution{
		function __construct(){

		}

		public static function new_institution($institution_id, $name){
			global $database;
			$result = $database->query_db("INSERT INTO institutions(institution_id, institution_name) VALUES('".$institution_id."', '".$name."')");
			if($result){
				return true;
			}
			else{
				return false;
			}
		}












		

		public static function all(){
			global $database;
			$result = $database->query_db("SELECT * FROM institutions WHERE deleted = '".NO."' ");
			return $result;
		}

		public static function all_paginated($start_from, $records_per_page){
			global $database;
			$result = $database->query_db("SELECT * FROM institutions WHERE deleted = '".NO."' LIMIT ".$start_from.", ".$records_per_page." ");
			return $result;
		}

		public static function exists($email){
			global $database;
			$result = $database->query_db("SELECT * FROM institutions WHERE email = '".$email."' ");
			$answer = $database->num_rows($result);
			if( $answer > 0 ){
				return true;
			}
			else{
				return false;
			}
		}

		public static function find($id){
			global $database;
			$result = $database->query_db("SELECT * FROM institutions WHERE institution_id = '".$id."' AND deleted = '".NO."' ");
			return $result;
		}

		public static function find_deleted(){
			global $database;
			$result = $database->query_db("SELECT * FROM institutions WHERE deleted = '".YES."' ");
			return $result;
		}

		public static function count_institutions(){
			global $database;
			$result = $database->query_db("SELECT * FROM institutions WHERE deleted = '".NO."' ");
			$num = $database->num_rows($result);
			return $num;
		}

		public static function delete($id){
			global $database;
			$result = $database->query_db("UPDATE institutions SET deleted = '".YES."' WHERE institution_id = '".$id."' ");
			return $result;
		}

		public static function update($name, $email, $primary_phone, $secondary_phone, $id){
			global $database;
			$result = $database->query_db("UPDATE institutions SET institution_name = '".$name."', email = '".$email."', primary_phone = '".$primary_phone."', secondary_phone = '".$secondary_phone."' WHERE institution_id = '".$id."' ");
			return $result;
		}

		public static function restore($id){
			global $database;
			$results = $database->query_db("UPDATE institutions SET deleted = ".NO." WHERE institution_id='".$id."'");
			return $results;
		}
	}
?>