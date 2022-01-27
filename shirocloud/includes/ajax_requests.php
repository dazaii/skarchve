<script>
	reload($("#cf").val());

	function previewWindow(tree){
		$.ajax({
			type: 'POST',
			url: '../ajaxpages/preview_window/',
			dataType: 'json',
			data: {
				tree: tree
			},
			success: function(response){

				//lookin good gallery
				$(document).ready(function(){
					$("#fileContainer").html(response);
					
					var w = $(".imageindexpreviewwidth");
					var h = $(".imageindexpreviewheight");
					var imgClass = $(".imgpiccontainer");
					col = (screen.width >= 768)?2:3;
					resizeview(w, h, imgClass, col, 1);
				});
			}
		});
	}

	//fetch folders
	function reload(tree){
		if(tree == 0){
			$("#uploadd").addClass("d-none");
		}else{
			$("#uploadd").removeClass("d-none");
		}
		nav(tree);
		$("#currentDir").val(tree);
		$("#cf").val(tree);
		previewWindow(tree);
		files(tree);
		$.ajax({
			type: 'POST',
			url: '../ajaxpages/fetch_folders/',
			dataType: 'json',
			data: {
				tree: tree
			},
			beforeSend: function(){
				$(".loadingContainer").addClass("loadingContainerActive");
			},
			success: function(response){
				$(".loadingContainer").removeClass("loadingContainerActive");
				$("#misete").html(response);
			}
		});
	}
	//fetch file nav
	function nav(tree){
		$.ajax({
			type: 'POST',
			url: '../ajaxpages/filenav/',
			dataType: 'json',
			data: {
				tree: tree
			},
			success: function(response){
				$("#miset").html(response);
			}
		});
	}
	//fetch files
	function files(tree){
		$.ajax({
			type: 'POST',
			url: '../ajaxpages/fetch_files/',
			dataType: 'json',
			data: {
				tree: tree
			},
			success: function(response){
				$("#fileContainer2").html(response);
			}
		});
	}

	//new folder
	function newfolder(){
		var fname = $("#newfoldername").val();
		if(fname != ""){
			$.ajax({
				type: 'POST',
				url: '../ajaxpages/new_folder/',
				dataType: 'json',
				data: {
					foldername: fname,
				},
				success: function(response){
					reload(response);
				}
			});
		}
	}
	//delete warning
	function rembuffer(folderid, foldername){
		$("#sayonarafolder").val(folderid);
		$("#sayonaraf").html(foldername);
	}
	//recursive delete request
	function recursivedelete(){
		var folderid = $("#sayonarafolder").val();
		$("#sayonarafolder").val("");
		$.ajax({
			type: 'POST',
			url: '../ajaxpages/recursive_delete/',
			dataType: 'json',
			data: {
				folderid: folderid,
			},
			success: function(response){
				reload(response);
			}
		});
	}
	// delete file request
	function remfile(fid){
		$.ajax({
			type: 'POST',
			url: '../ajaxpages/remfile/',
			dataType: 'json',
			data: {
				fid: fid,
			},
			success: function(response){
				reload(response);
			}
		});
	}

	// f i l e   s h a r i n g

	function sharefile(fid){
		$.ajax({
			type: 'POST',
			url: '../ajaxshared/sharefile/',
			dataType: 'json',
			data: {
				fid: fid,
			},
			success: function(response){
				$("#sharethis").html(response);
				reload($("#cf").val());
			}
		});
	}
	function sharefilecalledfromgallery(fid){
		$.ajax({
			type: 'POST',
			url: '../ajaxshared/sharefile/',
			dataType: 'json',
			data: {
				fid: fid,
			},
			beforeSend: function(){
				$("#gallery").modal('toggle');
			},
			success: function(response){
				$("#sharethis").html(response);
				reload($("#cf").val());
			}
		});
	}



	// g a l l e r y

	var currentImg = 0;
	var currentClassName = "imageindex";
	var totalimg = 0;
	
	// delete file request
	function remfilecalledfrommodal(fid){
		$.ajax({
			type: 'POST',
			url: '../ajaxpages/remfile/',
			dataType: 'json',
			data: {
				fid: fid,
			},
			success: function(response){
				reload(response);
				$("#gallery").modal('toggle');
			}
		});
	}

	function galleryImageBuffer(imgidx, i, classnamae){
		$("#imgpage").html(imgidx+1);
		currentImg = imgidx;
		currentClassName = classnamae;
		var totalImages = $("."+classnamae).length;
		totalimg = totalImages;
		if(imgidx != -1 && imgidx <= totalImages){
			var img = $("."+classnamae).eq(imgidx);
			var fileid = img.val();
			$.ajax({
				type: 'POST',
				url: '../ajaxpages/loadimg/',
				dataType: 'json',
				data: {
					imgid: fileid,
				},
				beforeSend: function(){
					$(".loadingContainer").addClass("loadingContainerActive");
				},
				success: function(response){
					$(".imgview").eq(i).html(response);
					galleryImageBufferSide(imgidx-1, 0, classnamae);
					galleryImageBufferSide(imgidx+1, 2, classnamae);
					$(".loadingContainer").removeClass("loadingContainerActive");
				}
			});
		}
	}
	function galleryImageBufferSide(imgidx, i, classnamae){
		var totalImages = $("."+classnamae).length;
		totalimg = $("."+classnamae).length;
		if(imgidx != -1 && imgidx <= totalImages){
			var img = $("."+classnamae).eq(imgidx);
			var fileid = img.val();
			$.ajax({
				type: 'POST',
				url: '../ajaxpages/loadimg/',
				dataType: 'json',
				data: {
					imgid: fileid,
				},
				success: function(response){
					$(".imgview").eq(i).html(response);
				}
			});
		}
	}


	function galleryNext(){
		if(totalimg > (currentImg+1)) galleryImageBuffer(currentImg + 1, 1,currentClassName);
	}
	function galleryPrev(){
		if(0 <= (currentImg-1)) galleryImageBuffer(currentImg - 1, 1,currentClassName);
	}

//gallery navigation algorithm 1
/*
	function galleryNext(){
		
		if((currentImg + 2) <= totalimg){
			$(".imgview").eq(0).html($(".imgview").eq(1).html());
			$(".imgview").eq(1).html($(".imgview").eq(2).html());
			galleryImageBufferSide(currentImg + 2, 2, currentClassName);
			currentImg++;
			$("#imgpage").html(currentImg+1);
		}else{
			$(".imgview").eq(2).html("");
		}
	}
	function galleryPrev(){
		if((currentImg-1) >= 0){
			$(".imgview").eq(2).html($(".imgview").eq(1).html());
			$(".imgview").eq(1).html($(".imgview").eq(0).html());
			if(currentImg-1 == 0){
				$(".imgview").eq(0).html("");
			}else{
				galleryImageBufferSide(currentImg-2, 0, currentClassName);
			}
			currentImg--;
			$("#imgpage").html(currentImg+1);
		}else{
			$(".imgview").eq(0).html("");
		}
	}

	*/

	//next/prev using keyboard
	document.onkeydown = function(event) {
        switch (event.keyCode) {
           case 37:
                galleryPrev();
              break;
           case 39:
                galleryNext();
              break;
           case 27:
           		$("#closeGallery").click();
        }
    };









    

	function clearGallery(){
		$(".imgview").eq(0).html("");
		$(".imgview").eq(1).html("Wait a minute");
		$(".imgview").eq(2).html("");
		$(".loadingContainer").removeClass("loadingContainerActive");
	}

	function autoopen(){
		$("#selectfileinput").trigger('click');
	}
	function autofocusnewfolder(){
		$("#newfoldername").focus();
	}






	//function
	function resizeview(imgWidthClass, imgHeightClass, imgContainerClass, columnlength, processremainder){

		var totalimg = imgWidthClass.length;
		var rows = totalimg / columnlength;
		//loops how many rows we have given that we have totalimages and column length for every row
		//say we have 20 images and we want to display them in 4 images(column) per row, we will have 5 rows in total
		for(var j=0; j<rows; j++){
			var totalratio = 0;
			//the goal of this loop is to just get the total ratio of every image per row
			for(var i=(j*columnlength); i<columnlength+(j*columnlength); i++){
				var imgContainer = imgContainerClass.eq(i);
				var width = imgWidthClass.eq(i).val();
				var height = imgHeightClass.eq(i).val();
				totalratio += width/height;
			}
			//time for changing its width // formula is ratio / total ratio * 100 to make it in 100.00% format
			for(var i=(j*columnlength); i<columnlength+(j*columnlength); i++){
				var imgContainer = imgContainerClass.eq(i);
				var width = imgWidthClass.eq(i).val();
				var height = imgHeightClass.eq(i).val();
				var ratio = width/height;
				var finalwidth = (ratio/totalratio)*100;
				imgContainer.width(finalwidth+"%");
			}
		}


			//the same as the above code with a little modifications and is only for remaining images
			var remainder = totalimg % columnlength;



			if(remainder != 0){
				var totalratio = 0;
				for(var i=(totalimg-remainder); i<totalimg; i++){
					var imgContainer = imgContainerClass.eq(i);
					var width = imgWidthClass.eq(i).val();
					var height = imgHeightClass.eq(i).val();
					totalratio += width/height;
				}
				if(remainder < columnlength){
					var diff = columnlength - remainder;
					totalratio += (diff*((screen.width >= 768)?1:(.7)));
				}
				if(processremainder){
					for(var i=(totalimg-remainder); i<totalimg; i++){
						var imgContainer = imgContainerClass.eq(i);
						var width = imgWidthClass.eq(i).val();
						var height = imgHeightClass.eq(i).val();
						var ratio = width/height;
						var finalwidth = (ratio/totalratio)*100;
						imgContainer.width(finalwidth+"%");
					}
				}
			}
			
	}







</script>




