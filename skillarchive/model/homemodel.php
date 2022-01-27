<?php
	if(isset($level)){
		include_once '../includes/auth.php';
	}else{
		include_once '../../includes/auth.php';
	}
	class HomeModel{
		public $db;
		private $yusa;
		function __construct(){
			$this->db = new dbConnect();
			$this->yusa = $_SESSION['kotoba'];
		}
		function getItemsPerPage(){
			return 10;
		}
		function getTotal(){
			$user = $this->yusa;
			$sql = "select COUNT(*) as total from sa_skills where s_owner = $user";
			$res = $this->db->conn->query($sql);
			$row = $res->fetch_assoc();
			$total = $row['total'];
			return $total;
		}
		function getPages(){
			$user = $this->yusa;
			$tot = $this->getTotal();
			$perpage = $this->getItemsPerPage();
			$paginationItems = ceil($tot/$perpage);
			return $paginationItems;
		}
		function viewPosts($offset){
			$offset--;
			$user = $this->yusa;
			$perpage = $this->getItemsPerPage();
			$offset*=$perpage;
			$sql = "select * from sa_skills, iamoppa, sa_categories where sa_skills.s_catid = sa_categories.c_id and s_owner = $user and iamoppa.count = $user order by s_title ASC, s_id DESC LIMIT $perpage OFFSET $offset";
			$res = $this->db->conn->query($sql);
			return $res;
		}
	}

?>