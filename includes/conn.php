<?php
	
	session_start();
	class dbConnect{
		private $host = "localhost";
		private $user = "root";
		private $pass = "";
		public $conn;
		function __construct(){
			$this->conn = new mysqli($this->host,$this->user,$this->pass,"dropmb");
			if($this->conn->connect_error){
				return "sumimasen";
			}
		}
		function close(){
			$this->conn->close();
		}
	}
	class User{
		public $username;
		public $yusa;
		private $pasuwudo;
		private $stmt;
		private $db;
		function __construct(){
			if(!isset($_SESSION['kotoba'])){
				//$this->logout();
			}else{
				$this->yusa = $_SESSION['kotoba'];
			}
		}
		function sessionCheck(){
			if(!isset($_SESSION['kotoba'])){
				$this->logout();
			}
		}
		function login($username, $magicword){
			$this->db = new dbConnect();
			$this->stmt = $this->db->conn->prepare("select count, pasuwudo from iamoppa where name = ?");
			$this->stmt->bind_param("s", $username);
			$this->stmt->execute();
			$this->stmt->bind_result($this->yusa, $this->pasuwudo);
			if($this->stmt->fetch() and password_verify($magicword, $this->pasuwudo)){
				$_SESSION['kotoba'] = $this->yusa;
				$this->username = $username;
				return true;
			}else{
				return false;
			}
		}
		function verifypassword($magicword){
			$this->db = new dbConnect();
			$user = $_SESSION['kotoba'];
			$this->stmt = $this->db->conn->prepare("select pasuwudo from iamoppa where count = $user");
			$this->stmt->execute();
			$this->stmt->bind_result($this->pasuwudo);
			if($this->stmt->fetch() and password_verify($magicword, $this->pasuwudo)){
				return true;
			}else{
				return false;
			}
		}
		function logout(){
			header("Location: ../../sayonara.php");
		}
		function getId(){
			return $this->yusa;
		}
	}
?>