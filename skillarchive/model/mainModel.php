<?php
	include_once '../../includes/auth.php';

	class Model{
		public $db;
		private $yusa;
		function __construct(){
			$this->db = new dbConnect();
			$this->yusa = $_SESSION['kotoba'];
		}
		function getCat(){
			$user = $this->yusa;
			$sql = "select * from sa_categories where c_owner = $user";
			$res = $this->db->conn->query($sql);
			return $res;
		}
		function getCatRow($catid){
			$user = $this->yusa;
			$sql = "select * from sa_categories where c_owner = $user and c_id = $catid";
			$res = $this->db->conn->query($sql);
			$row = $res->fetch_assoc();
			return $row;
		}
		function insertToArc($title,$category,$content,$keywords){
			$user = $this->yusa;
			$sql = "insert into sa_skills(s_title,s_catid,s_content,s_keywords,s_owner) values(?,?,?,?,?)";
			$stmt = $this->db->conn->prepare($sql);
			$stmt->bind_param("sissi",$title,$category,$content,$keywords,$user);
			$stmt->execute();
			return 1;
		}
		function modifyArc($id,$title,$category,$content,$keywords){
			$user = $this->yusa;
			$sql = "update sa_skills set s_title=?, s_catid=?, s_content=?, s_keywords=? where s_id=?";
			$stmt = $this->db->conn->prepare($sql);
			$stmt->bind_param("sissi",$title,$category,$content,$keywords,$id);
			$stmt->execute();
			return 1;
		}
		function viewNf(){
			$user = $this->yusa;
			$sql = "select * from sa_skills, iamoppa, sa_categories where sa_skills.s_catid = sa_categories.c_id and s_owner = $user and iamoppa.count = $user order by s_id DESC LIMIT 14";
			$res = $this->db->conn->query($sql);
			return $res;
		}
		function viewSearch($svalue){
			$user = $this->yusa;
			$sql = "select * from sa_skills, sa_categories where (s_title LIKE '%$svalue%' or s_content LIKE '%$svalue%') and sa_skills.s_catid = sa_categories.c_id and s_owner = $user order by s_id DESC LIMIT 50";
			$res = $this->db->conn->query($sql);
			return $res;
		}
		function viewSearchLimit($svalue, $limit){
			$user = $this->yusa;
			$sql = "select * from sa_skills, sa_categories where (s_title LIKE '%$svalue%' or s_content LIKE '%$svalue%') and sa_skills.s_catid = sa_categories.c_id and s_owner = $user order by s_id DESC LIMIT $limit";
			$res = $this->db->conn->query($sql);
			return $res;
		}
		function viewsinglepost($svalue){
			$user = $this->yusa;
			$sql = "select * from sa_skills, sa_categories where s_id = $svalue and sa_skills.s_catid = sa_categories.c_id and s_owner = $user";
			$res = $this->db->conn->query($sql);
			return $res;
		}
		function viewNfByDate($mdy,$value){
			$user = $this->yusa;
			$sql = "select * from sa_skills, sa_categories where $mdy(created) = '$value' and sa_skills.s_catid = sa_categories.c_id and s_owner = $user order by s_id DESC LIMIT 14";
			$res = $this->db->conn->query($sql);
			return $res;
		}
		function viewNfByCat($catid){
			$user = $this->yusa;
			$sql = "select * from sa_skills, iamoppa, sa_categories where sa_skills.s_catid = sa_categories.c_id and s_owner = $user and s_catid = $catid and iamoppa.count = $user order by s_id DESC";
			$res = $this->db->conn->query($sql);
			return $res;
		}
		function insertCategory($catname){
			$user = $this->yusa;
			$sql = "insert into sa_categories(c_category, c_owner) values(?,?)";
			$stmt = $this->db->conn->prepare($sql);
			$stmt->bind_param("si", $catname, $user);
			$stmt->execute();
			return 1;
		}
		function modifyCategory($catid,$catname){
			$user = $this->yusa;
			$sql = "update sa_categories set c_category=? where c_id=?";
			$stmt = $this->db->conn->prepare($sql);
			$stmt->bind_param("si", $catname, $catid);
			$stmt->execute();
			return 1;
		}
		function deleteCategory($catid){
			$user = $this->yusa;
			$sql = "delete from sa_skills where s_catid = $catid and s_owner = $user";
			$this->db->conn->query($sql);
			$sql = "delete from sa_categories where c_id = $catid and c_owner = $user";
			$this->db->conn->query($sql);
			return 1;
		}
		function deleteFromArchive($id){
			$user = $this->yusa;
			$sql = "delete from sa_skills where s_id = $id and s_owner = $user";
			$this->db->conn->query($sql);
			return 1;
		}
		function getContents($id){
			$user = $this->yusa;
			$sql = "select * from sa_skills where s_id = $id and s_owner = $user";
			$res = $this->db->conn->query($sql);
			$row = $res->fetch_assoc();
			return $row;
		}

	}
?>