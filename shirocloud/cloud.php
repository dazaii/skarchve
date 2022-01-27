<?php
	require '../includes/auth.php';
?>
<!DOCTYPE html>
<html>
	<?php require '../includes/header.php';
		if(!isset($_SESSION['currentfolderr'])){
			$_SESSION['currentfolderr'] = 0;
		}
		require '../includes/svgs.php';
	?>
<body class="roboto-light bg-white">
  	<div class="loadingContainer rounded-pill">
  		<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
  	</div>
	<div class="container-fluid" style="position: absolute; height: 100%">
		<div class="row justify-content-center h-100">
			<div class="cloudnavigator col-md-1 h-100 col-1">
				<div class="row gy-1 justify-content-center">
					<div class="col-12 py-1 px-2 text-center text-info">
						<a class="overflow-hidden text-info" href="../cloud/"><?php cloudiconfill(); ?></a>
					</div>					<div class="col-12 py-1 px-2 text-center rounded-pill">
						<a class="overflow-hidden text-dark" href="../../skillarchive/home/"><span><?php skillicon(); ?></span></a>
					</div>
					<div class="col-12 py-1 px-2 text-center rounded-pill">
						<?php hashicon(); ?>
					</div>
					<div class="col-12 py-1 px-2 text-center rounded-pill">
						<a class="overflow-hidden text-dark" href="../notes/"><span><?php notesicon(); ?></span></a>
					</div>

				</div>
			</div>
			<div class="col-md-10 col-11 h-100">
				<div class="row">
					<div class="col-12 col-md-7 bg-white border-bottom-0 border-top-0">
						<div class="row py-2 py-md-3 align-items-center justify-content-between" style="border-bottom: solid 1px #eee;">
							<div class="fw-bold roboto-regular col-auto">
								Shirocloud
							</div>
							<div class="col-auto">
								<button onclick="reload(0)" class="btn btn-info btn-sm ms-1 text-white"><?php hashicon(); ?></button>
								
								<a data-bs-toggle="modal" onclick="autoopen()" id="uploadd" class="btn overflow-hidden bg-white border btn-sm ms-1" href=".cUpload"><?php uploadicon(); ?></a>
								<a data-bs-toggle="collapse" onclick="autofocusnewfolder()" id="ike" class="btn overflow-hidden bg-white border btn-sm ms-1" href=".cAddFolder"><span><?php addfoldericon(); ?></span></a>
								<a href="../../sayonara.php" class="btn overflow-hidden bg-white border btn-sm ms-1">
								<?php logouticon(); ?></a>
							</div>
						</div>
						<!--MODAL FOR FILE SHARING-->
						<div style='z-index:10000' id="sharemodal" class="modal" tabindex="-1">
						  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
						    <div class="modal-content">
						      <div class="modal-body p-4" id="sharethis">
						      	Wait a minute
						      </div>
						    </div>
						  </div>
						</div>
						<!--MODAL FOR FILE UPLOAD-->
						<!--id is for toggle purpose when the upload finishes-->
						<div id="upmodal" class="modal fade cUpload" tabindex="-1">
						  <div class="modal-dialog modal-dialog-scrollable">
						    <div class="modal-content">
						      <div class="modal-body">
						      	<form id="fupload" class="row align-items-center justify-content-between" enctype="multipart/form-data">

							        <div class="col-auto">
							        </div>
							        <div class='col-auto p-2'>
							        	<h5 class='modal-title text-dark'>Upload</h5>
							        </div>
							        <div class='col-auto'>
							        	<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
							        </div>
							        <div class='w-100'></div>
							        <div class='col-12 p-4'>
							        	<input id="selectfileinput" type='file' name='korefiledane' class='form-control'>
								        <input type='hidden' name='currentdir' id='currentDir'>
							        </div>
							        <div class='col-12 px-4 pb-2'>
							        	<input type='submit' name='readyupload' class='btn text-white float-end btn-sm bg-green' value='Upload'>
							        </div>
							    </form>

							    <div id="progress-cont" style="display: none;">
							    	<!-- Progress bar -->
									<div class="progress bg-white">
									    <div class="progress-bar bg-info"></div>
									</div>

								    <!-- Display upload status -->
									<div class="text-center p-2" style="font-size: 14px;" id="uploadStatus"></div>
							    </div>

						      </div>
						    </div>
						  </div>
						</div>
						<!--MODAL FOR DELETE confirmation-->
						<div id="remfolder" class="modal" tabindex="-1">
						  <div class="modal-dialog modal-md modal-dialog-scrollable">
						    <div class="modal-content">
						      <div class="modal-header border-0">
						        <h5 class="modal-title text-dark">You sure you wanna delete this folder?</h5>
						        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						      </div>
						      <div class="modal-body">
						      	<div class="row text-center">
						      		<svg class='col text-warning' style='margin-top: -6px;' class='foldericon' xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='1' stroke-linecap='round' stroke-linejoin='round' class='feather feather-folder'><path d='M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z'></path></svg>
							        <span id="sayonaraf" class="fs-3"></span>
						      	</div>
						        <input type="hidden" id="sayonarafolder">
						      </div>
						      <div class="modal-footer border-0">
						        <button type="button" onclick="recursivedelete()" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Delete</button>
						      </div>
						    </div>
						  </div>
						</div>
						<!--Gallery-->
						<div id="gallery" class="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
						  <div class="modal-dialog modal-fullscreen">
						    <div class="modal-content">
						      <div class="modal-header border-0 row justify-content-between align-items-center">
						        <h3 id="galtitle" class="col-auto fs-2 text-dark">Gallery</h3>
						        <div class="col-auto">
						        	<button class="btn overflow-hidden bg-white border btn-sm ms-1" onclick="galleryPrev()">
							      		<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-left'><polyline points='15 18 9 12 15 6'></polyline></svg>
							      	</button>
						        	<span id="imgpage" class="fs-6 roboto-regular px-1">0</span>
							      	<button class="btn overflow-hidden bg-white border btn-sm ms-1" onclick="galleryNext()">
							      		<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-chevron-right'><polyline points='9 18 15 12 9 6'></polyline></svg>
							      	<button onclick="clearGallery()" id="closeGallery" class="btn overflow-hidden bg-white border btn-sm ms-1" data-bs-dismiss="modal">
							      		<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-x'><line x1='18' y1='6' x2='6' y2='18'></line><line x1='6' y1='6' x2='18' y2='18'></line></svg>
							      	</button>
						        </div>
						      </div>
						      <div style="margin-top: -25px; height: 100%" class="modal-body text-center">
					        		<div class="prev" onclick="galleryPrev()"></div>
					        		<div class="next" onclick="galleryNext()"></div>
						        <div class="mt-0 row imgnavigation justify-content-center align-items-center">
						        	<div class="d-none imgview">
						        		<div class="p-2"></div>
						        	</div>
						        	<div class="col-12">
						        		<div class="imgview" style="min-height: 500px; margin: 0 -18px;">Loading</div>
						        	</div>
						        	<div class="d-none imgview">
						        		<div class="p-2"></div>
						        	</div>
						        </div>
						      </div>
						    </div>
						  </div>
						</div>
						<div class="collapse cAddFolder">
							<div class="bg-light py-5 rounded-3 mt-2">
								<div class="card-body">
									<div class="container-fluid">
										<form onsubmit="newfolder()" action="#">
											<div class="row align-items-center justify-content-center">
												<div class="col-auto">
													<input id="newfoldername" placeholder="New Folder" class="form-control" type="text">
												</div>
												<div class="col-auto">
													<button type="submit" class="border mt-1 mt-md-0 border-info rounded-1 p-1 btn-info text-white" type="submit" data-bs-toggle="collapse" data-bs-target=".cAddFolder">
														<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-check'><polyline points='20 6 9 17 4 12'></polyline></svg>
													</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div><br>
						</div>

						<div id="miset" class="mt-2 mt-md-2 fst-italic roboto-regular">
							<button class='text-green btn btn-white btn-sm rounded-0 fst-normal py-1'><?php echo$namae;?> /</button>
						</div>
						<div id="misete" class='p-2 row gy-2'>
							<div class="text-center">もう少しだけ。。。</div>
						</div>
						<div id="fileContainer2">
							<div class="text-center"></div>
						</div>
					</div>
					<div class="col-md-5 col-12 responsiveborders">
						<div id="fileContainer" class="mt-3"></div>
					</div>
				</div>
			</div>
			
		</div>
		<input id="cf" type="hidden" value="<?php echo $_SESSION['currentfolderr']; ?>">
	</div>
	
	<?php
		require 'includes/ajax_requests.php';
		require '../includes/footer.php';
	?>
	<script type="text/javascript">
		    // File upload via Ajax
		    $("#fupload").on('submit', function(e){
		        e.preventDefault();
		        $.ajax({
		            xhr: function() {
		                var xhr = new window.XMLHttpRequest();
		                xhr.upload.addEventListener("progress", function(evt) {
		                    if (evt.lengthComputable) {
		                        var percentComplete = ((evt.loaded / evt.total) * 100);
		                        percentComplete = percentComplete.toFixed();

		                        if(percentComplete == 100){
					                $('#uploadStatus').html('finishing upload');
		                        }
		                        $(".progress-bar").width(percentComplete + '%');
		                        $(".progress-bar").html(percentComplete+'%');
		                    }
		                }, false);
		                return xhr;
		            },
		            type: 'POST',
		            url: '../file_upload/',
		            data: new FormData(this),
		            contentType: false,
		            cache: false,
		            processData:false,
		            beforeSend: function(){
		                $(".progress-bar").width('0%');
		                $('#uploadStatus').html('uploading');
		                $('#progress-cont').css("display", "block");
		            },
		            error:function(){
		                $('#uploadStatus').html('<p style="color:#EA4335;">File upload failed, please try again.</p>');
		            },
		            success: function(response){
	                    //toggle modal
		                $('#uploadStatus').html('');
						$("#upmodal").modal('toggle');
						reload($("#cf").val());
	                    $("#fupload")[0].reset();
		                $('#progress-cont').css("display", "none");
		            }
		        });
		    });
	</script>
</body>
</html>


