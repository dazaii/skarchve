<?php

require '../../includes/auth.php';
$opt = "";
abstract class Folder{
	protected $foldername;
	protected $folderid;
	abstract function render();
}
class CurrentFolder{
	private $foldername;
	private $id;

	function __construct($fid){
		$this->id = $fid;
	}
	function containFiles(){
		$darega = $GLOBALS['darega'];
		$hasContent = $GLOBALS['dc']->conn->query("select * from files where ownerid = $darega and parent_folder = ($this->id)");
		if($hasContent->num_rows > 0) return true;
		else return false;
	}
	function list(){
		//accessing global variables
		//classes can't see global variables normally, and that's normal XD
		$dc = $GLOBALS['dc'];
		$owner = $GLOBALS['u']->getId();
		$fid = $this->id;
		$sql = "select * from filetree where parent_folder = $fid and ownerid = $owner order by folder_id DESC";
		$res = $dc->conn->query($sql);
		$stripe = 0;
		if($res->num_rows > 0){
			while($row = $res->fetch_assoc()){
				$foldername = $row['folder_name'];
				$folder_id = $row['folder_id'];
					$obj = new EvenFolder($foldername, $folder_id);
					$obj->render();
				$stripe++;
			}
		}else if($this->containFiles() == false){
			$GLOBALS['opt'] = "<br>
				<div class='p-5 bg-light fs-2 roboto-light'>Empty folder</div>
			";
		}
	}
	function getId(){
		return $this->id;
	}

}

class EvenFolder extends Folder{
	function __construct($foldername, $folderid){
		$this->folderid = $folderid;
		$this->foldername = $foldername;
	}
	function render(){
		$foldername = $this->foldername;
		$folder_id = $this->folderid;
		$ldelete =$GLOBALS['ldelete'];
		$GLOBALS['opt'] .="
			<div class='folder col-12 col-md-12 px-2'>
			<div class='row justify-content-center align-items-center gx-0 mx-0'>
				<div class='col'>
					<button onclick='reload($folder_id)' class='btn btn-white  text-start w-100 fs-6 btn-sm rounded-0'>

					<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' class='text-info' fill='currentColor' class='bi bi-folder-fill' viewBox='0 0 16 16'>
					  <path d='M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.825a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z'/>
					</svg>

					 <span class='roboto-regular fw-bold' style='font-size: 14px; color: #000;'>&nbsp;$foldername</span></button>
				</div>
				<div class='col-auto'>
					<a data-bs-toggle='modal' onclick='rembuffer($folder_id, \"$foldername\")' class='btn btn-white fs-11px text-warning fw-bold btn-sm ms-2' href='#remfolder'>

					<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>

					</a>
				</div>
			</div>
		</div>
		";
	}
}
class OddFolder extends Folder{
	function __construct($foldername, $folderid){
		$this->folderid = $folderid;
		$this->foldername = $foldername;
	}
	function render(){
		$foldername = $this->foldername;
		$folder_id = $this->folderid;
		$ldelete =$GLOBALS['ldelete'];
		$GLOBALS['opt'] .="
		<div class='folder col-12 col-md-6 px-2'>
			<div class='row justify-content-center align-items-center gx-0 mx-0'>
				<div class='col'>
					<button onclick='reload($folder_id)' class='btn text-start w-100 fs-6 btn-sm rounded-0 p-3'>

					<svg class='foldericon' style='margin-top: -6px;' xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-folder'><path d='M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z'></path></svg>

					 <span class='roboto-regular fw-bold' style='font-size: 14px; color: #000;'>&nbsp;$foldername</span></button>
				</div>
				<div class='col-auto'>
					<a data-bs-toggle='modal' onclick='rembuffer($folder_id, \"$foldername\")' class='btn btn-white fs-11px text-warning fw-bold btn-sm ms-2' href='#remfolder'>

					<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-trash-2'><polyline points='3 6 5 6 21 6'></polyline><path d='M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2'></path><line x1='10' y1='11' x2='10' y2='17'></line><line x1='14' y1='11' x2='14' y2='17'></line></svg>

					</a>
				</div>
			</div>
		</div>
		";
	}
}

	if(isset($_POST['tree'])){
		$folder = new CurrentFolder($_POST['tree']);
		$fid = $folder->getId();
		$_SESSION['currentfolderr'] = $fid;	//stores the current folder id
		$folder->list();
		echo json_encode($opt);
	}

?>