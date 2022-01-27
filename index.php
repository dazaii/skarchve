<html>
	<head>
		<?php
			require 'includes/index_header.php';
		?>
		<style>
			.theme{
				color: #555555;
			}
		</style>
	</head>
	<body class='roboto-light theme'>
		<div class="container">
		<div class="fw-normal text-center fs-1 roboto-light mt-4">Shirocloud</div>
			<div id="loginready" class="text-center text-info">
				<div style="height: auto; width: 100%;" id='container'>
				    
				    <div id='form-box' class="col-5 bg-light text-dark">
				      <i id='prev-btn' class='fas fa-arrow-left'></i>
				      <i id='next-btn' class='fas fa-arrow-right'></i>
				      <div id='input-group' class="col-12">
				        <input id='input-field' required>
				        <label id='input-label' style="color: #000;"></label>
				        <div class="bg-info py-5 col-12" id='input-progress'></div>
				      </div>
				      <div id='progress-bar'></div>
				    </div>
				  </div>
			</div>
		</div>
		
		<script type="text/javascript" src="lib/js/bootstrap.bundle.js"></script>
		<script type="text/javascript" src="lib/js/forked/dynamiclogin.js"></script>
		<script>
			$("#loginready").hide();
			loaad();
			function loaad(){
				$.ajax({
					type: 'POST',
					url: 'shiro_check/',
					dataType: 'json',
					success: function(response){
						if(response == "notloggedin"){
							$("#loginready").show();
						    inputField.focus();
						}else{
							$("#loginready").show();
							$("#loginready").html(response);
						}
					}
				});
			}
		</script>
		
	</body>
</html>