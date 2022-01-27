<?php
	require '../includes/auth.php';
?>
<!DOCTYPE html>
<html>
	<?php 
		require '../includes/header.php';
		require '../includes/svgs.php';
	?>
<body class="bg-white roboto-light">

  	<div class="loadingContainer">
  		<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
  	</div>
	<div class="container">

		<div class="row mt-4 align-items-center justify-content-between">
			<div class="col-auto">
				<span class="fs-1 fs-md-3 px-2 rounded-3 roboto-light fw-bold float-start"><span id="logoo">Notes</span></span>
			</div>
			<div class="col-auto">
				<button onclick="fetchNotes()" class="btn btn-info btn-sm ms-1 text-white"><?php hashicon(); ?></button>
				<a class="btn overflow-hidden bg-white border btn-sm ms-1" href="../cloud/"><span><?php cloudicon(); ?></span></a>
				<a data-bs-toggle="modal" data-bs-target="#addnote" class="btn overflow-hidden bg-white border btn-sm ms-1" href=".cAddFolder"><span><?php plusicon(); ?></span></a>
				<a href="../../sayonara.php" class="btn overflow-hidden bg-white border btn-sm ms-1">
				<?php logouticon(); ?></a>
			</div>
		</div>

		<div class="row p-1 mt-1" id="notesContainer">
			<div class="p-5 text-warning fw-bold text-center"></div>
		</div>
	</div>
	<div id="addnote" class="modal" tabindex="-1">
	  <div class="modal-dialog modal-xl modal-dialog-scrollable">
	    <div class="modal-content">
	      <div class="modal-body">
	        <div class="row justify-content-between align-items-center g-4">
	        	<div class="col-13">
	        		<input type="text" placeholder="Title" id="newnoteTitle" class="border-0 fs-4 form-control" autofocus>
	        	</div>
	        </div>
	        <div class="row align-items-center">
	        	<div class="col-12">
	        		<textarea id="newnoteContent" class="col-12 border-0 form-control roboto-regular" placeholder="何が？"></textarea>
	        	</div>
	        </div>
	        <div class="row align-items-center mt-4">
	        	<div class="col-12">
	        		<button onclick="newNote()" class="btn btn-sm btn-info float-end text-white" data-bs-dismiss="modal">新しい</button>
	        	</div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<div id="viewNote" class="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	  <div class="modal-dialog modal-xl modal-dialog-scrollable">
	    <div class="modal-content">
	      <div class="modal-body">
	      	<div id="viewNoteContainer">
		        <div class="p-5"></div>
		        <div class="p-5 text-center"></div>
		        <div class="p-5"></div>
	      	</div>
	      	<div class='col-12 mt-2'>
        		<button onclick='clearEditor()' class='btn btn-sm text-secondary border-secondary float-end' data-bs-dismiss='modal'>
        			<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x'><line x1='18' y1='6' x2='6' y2='18'></line><line x1='6' y1='6' x2='18' y2='18'></line></svg>
        		</button>
        		<button onclick='updateNote()' class='btn me-2 btn-sm btn-info float-end text-white' data-bs-dismiss='modal'>
        			<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg>
        		</button>
        	</div>
	      </div>
	    </div>
	  </div>
	</div>
	
	<?php
		require '../includes/footer.php';
	?>
	<script type="text/javascript">
		fetchNotes();
		function fetchNotes(){
			$.ajax({
				type: 'POST',
				url: '../ajaxpages/fetch_notes/',
				dataType: 'json',
				beforeSend: function(){
					$(".loadingContainer").addClass("loadingContainerActive");
				},
				success: function(response){
					$(".loadingContainer").removeClass("loadingContainerActive");
					$("#notesContainer").html(response);
				}
			});
		}

		function newNote(){
			var title = $("#newnoteTitle").val();
			var content = $("#newnoteContent").val();
			if(content != ""){
				$.ajax({
					type: 'POST',
					url: '../ajaxpages/add_note/',
					dataType: 'json',
					data:{
						title: title,
						content: content,
					},
					success: function(){
						fetchNotes();
					}
				});
			}
		}
		function remNote(noteid){
			$.ajax({
				type: 'POST',
				url: '../ajaxpages/rem_note/',
				dataType: 'json',
				data:{
					noteid: noteid,
				},
				success: function(){
					fetchNotes();
				}
			});
		}
		function viewNote(noteid){
			$.ajax({
				type: 'POST',
				url: '../ajaxpages/view_note/',
				dataType: 'json',
				data:{
					noteid: noteid,
				},
				beforeSend: function(){
					$(".loadingContainer").addClass("loadingContainerActive");
				},
				success: function(response){
					$(".loadingContainer").removeClass("loadingContainerActive");
					$("#viewNoteContainer").html(response);
				}
			});
		}
		function clearEditor(){
			$("#viewNoteContainer").html("<div class='p-5'></div><div class='p-5 text-center'></div><div class='p-5'></div>");
			$(".loadingContainer").removeClass("loadingContainerActive");
		}
		function updateNote(){
			var title = $("#viewnoteTitle").val();
			var noteid = $("#viewnoteId").val();
			var content = $("#viewnoteContent").val();
			$.ajax({
				type: 'POST',
				url: '../ajaxpages/update_note/',
				dataType: 'json',
				data:{
					noteid: noteid,
					title: title,
					content: content,
				},
				beforeSend: function(){
					$("#viewNoteContainer").html("<div class='p-5'></div><div class='p-5 text-center'></div><div class='p-5'></div>");
					$(".loadingContainer").addClass("loadingContainerActive");
				},
				success: function(response){
					$(".loadingContainer").removeClass("loadingContainerActive");
					fetchNotes();
				}
			});
		}
	</script>

</body>
</html>