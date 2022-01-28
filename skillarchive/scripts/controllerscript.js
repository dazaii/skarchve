reload();
function reload(){
	categories();
	seeMoreNandeshou();
	isdarkmode();
	$("#editorSubmitBtn").attr('onclick','addToArchive()');
}
function categories(){
	$.ajax({
		type: 'POST',
		url: '../controller/mainController/',
		dataType: 'json',
		data: {
			action: 'reloadCategories'
		},
		success: function(r){
			$("#timeline").html(r);
		}
	});
	viewCatOptions();
}
function catOnFeed(){
	$.ajax({
		type: 'POST',
		url: '../controller/mainController/',
		dataType: 'json',
		data: {
			action: 'reloadCategories'
		},
		beforeSend: function(){
			$(".loader").addClass("activeloader");
		},
		success: function(r){
			$("#nf").html(r);
			$(".loader").removeClass("activeloader");
		}
	});
	viewCatOptions();
}
function viewCatOptions(){
	$.ajax({
		type: 'POST',
		url: '../controller/mainController/',
		dataType: 'json',
		data: {
			action: 'reloadCategoryOptions'
		},
		success: function(r){
			$("#selectcat").html(r);
		}
	});
}
function addToArchive(){
	var cont = $("#myd").html();
	var container = document.getElementById('myd');
	var cat = $("#selectcat").val();
	var title = $("#createTitle").val();
	var boldContents = container.getElementsByTagName('b');
	var keywords = "";
	for(var i=0; i<boldContents.length; i++){
		keywords += boldContents[i].innerText+"|";
	}
	if(cat == 0){
		alert("Select a mastery");
		return;
	}
	$.ajax({
		type: 'POST',
		url: '../controller/archiveController/',
		dataType: 'json',
		data: {
			action: 'add',
			title: title || '@',
			category: cat,
			content: cont,
			keywords: keywords,
		},
		beforeSend: function(){
			$(".loader").addClass("activeloader");
		},
		success: function(response){
			$("#createTitle").val('');
			reload();
			newsFeed();
			$("#mydContainer").collapse("hide");
		}
	});
}
function newsFeed(){
	$.ajax({
		type: 'POST',
		url: '../controller/homecontroller/',
		dataType: 'json',
		data: {
			action: 'viewNewsFeed',
		},
		success: function(response){
			$("#nf").html(response);
			seeMoreNandeshou();
			$(".loader").removeClass("activeloader");
		}
	});
}
function seeMoreNandeshou(){
	var nfCont = document.getElementsByClassName("nfContent");
	var nfFade = document.getElementsByClassName("nfFade");
	var nfContSM = document.getElementsByClassName("nfContentSeeMore");
	for(var i=0;i<nfCont.length;i++){
		if(!(nfCont[i].offsetHeight >= 300)) nfContSM[i].style.display = "none";
		else{
			nfFade[i].style.display = "block";
		}
	}
}
function seeMore(selfBtn){
	selfBtn.style.display = 'none';
	var nodes = selfBtn.parentElement.children;
	nodes[0].style.display = "none";
}
function openPreferences(){
	var modal = document.getElementById('preferencesModal');
	var modalM = document.getElementById('mainModal');
	modal.style.display = "flex";
	modalM.classList.add('modalMain');
	modalM.classList.remove('modalMainOut');
	modal.classList.remove('modalFadeOut');
}
function closePreferences(){
	var modal = document.getElementById('preferencesModal');
	var modalM = document.getElementById('mainModal');
	modalM.classList.remove('modalMain');
	modalM.classList.add('modalMainOut');
	modal.classList.add('modalFadeOut');
	setTimeout(function(){modal.style.display='none';},500);
}

function scrolltop(){
	document.getElementsByTagName("body")[0].scrollIntoView();
}

function viewByCategory(catid){
	$("#mydContainer").collapse("hide");
	$.ajax({
		type: 'POST',
		url: '../controller/archiveController/',
		dataType: 'json',
		data: {
			action: 'viewNewsFeedByCategory',
			catid: catid
		},
		beforeSend: function(){
			$(".loader").addClass("activeloader");
		},
		success: function(response){
			$("#nf").html(response);
			$(".loader").removeClass("activeloader");
			seeMoreNandeshou();
		}
	});
}
function isdarkmode(){
	var theme = document.getElementById("theme");
	$.ajax({
		type: 'POST',
		url: '../controller/themeController/',
		dataType: 'json',
		data: {
			action: 'getTheme',
		},
		success: function(response){
			if(response == 1){
				theme.setAttribute('href','../../lib/css/darkmode.css');
			}else{
				theme.setAttribute('href','');
			}
		}
	});
}
function darkmode(selfnode){
	var theme = document.getElementById("theme");
	$.ajax({
		type: 'POST',
		url: '../controller/themeController/',
		dataType: 'json',
		data: {
			action: 'setTheme',
		},
		success: function(response){
			if(response == 1){
				theme.setAttribute('href','../../lib/css/darkmode.css');
			}else{
				theme.setAttribute('href','');
			}
		}
	});
}
function autofocusAddCatName(){
	$("#addCatName").focus();
}
function autofocusRenameCatName(){
	$("#renameCatInput").focus();
}
function autofocusSIPT(){
	$("#searchIPT").focus();
}

$("#addCatForm").on('submit', function(e){
	e.preventDefault();
	var catn = $("#addCatName").val();
	if(catn == "") return;
	$("#addCatModal").modal('toggle');
	$.ajax({
		type: 'POST',
		url: '../controller/catController/',
		data: new FormData(this),
        contentType: false,
        processData:false,
		success: function(){
			reload();
		}
	});
});

$("#deleteCatForm").on('submit', function(e){
	e.preventDefault();
	$("#deleteCatModal").modal('toggle');
	$.ajax({
		type: 'POST',
		url: '../controller/catController/',
		data: new FormData(this),
        contentType: false,
        processData:false,
		success: function(){
			reload();
		}
	});
});
$("#renameCatForm").on('submit', function(e){
	e.preventDefault();
	var catn = $("#renameCatInput").val();
	if(catn == "") return;
	$("#renameCatModal").modal('toggle');
	$.ajax({
		type: 'POST',
		url: '../controller/catController/',
		data: new FormData(this),
        contentType: false,
        processData:false,
		success: function(){
			catOnFeed();
		}
	});
});


function viewPost(id){
	$.ajax({
		type: 'POST',
		url: '../controller/archiveController/',
		dataType: 'json',
		data: {
			action: 'previewpost',
			svalue: id,
		},
		success: function(response){
			if(response){
				$("#singlepostview").html(response);
			}else{
				$("#singlepostview").html("<div class='col-12'><img class='w-100' src='../../lib/images/nanimo.png'></div>");
			}
		}
	});
}

function searchArchive2(sv){
	if(sv.length <= 2) return;
	$.ajax({
		type: 'POST',
		url: '../controller/archiveController/',
		dataType: 'json',
		data: {
			action: 'searcharchive2',
			svalue: sv,
		},
		success: function(response){
			if(response){
				$("#sResults2").html(response);
				seeMoreNandeshou();
			}else{
				$("#sResults2").html("<div class='col-12'><img class='w-100' src='../../lib/images/nanimo.png'></div>");
			}
		}
	});
}
function searchArchive(sv){
	if(sv.length <= 2) return;
	$.ajax({
		type: 'POST',
		url: '../controller/archiveController/',
		dataType: 'json',
		data: {
			action: 'searcharchive',
			svalue: sv,
		},
		success: function(response){
			if(response){
				$("#sResults").html(response);
				seeMoreNandeshou();
			}else{
				$("#sResults").html("<div class='col-12'><img class='w-100' src='../../lib/images/nanimo.png'></div>");
			}
		}
	});
}
function deleteFromArchive(id){
	$.ajax({
		type: 'POST',
		url: '../controller/archiveController/',
		dataType: 'json',
		data: {
			action: 'deletefromarchive',
			id: id,
		},
		beforeSend: function(){
			$(".loader").addClass("activeloader");
		},
		success: function(response){
			reload();
			newsFeed();
		}
	});
}
function getCatContents(id){
	autofocusRenameCatName();
	$.ajax({
		type: 'POST',
		url: '../controller/mainController/',
		dataType: 'json',
		data: {
			action: 'getcatcontents',
			id: id,
		},
		success: function(response){
			$("#renameCatId").val(response.c_id);
			$("#renameCatInput").val(response.c_category);
		}
	});
}
function getCatContentsForRemoval(id){
	autofocusRenameCatName();
	$.ajax({
		type: 'POST',
		url: '../controller/mainController/',
		dataType: 'json',
		data: {
			action: 'getcatcontents',
			id: id,
		},
		success: function(response){
			$("#deleteCatId").val(response.c_id);
			$("#deleteCatInput").val(response.c_category);
		}
	});
}
function getContents(id){
	$("#mydContainer").collapse("show");
	$("#searchModal").modal("hide");
	$("#previewModal").modal("hide");
	var catid = 0;
	$.ajax({
		type: 'POST',
		url: '../controller/archiveController/',
		dataType: 'json',
		data: {
			action: 'getcontents',
			id: id,
		},
		success: function(response){
			$("#myd").html(response.s_content);
			$("#likescount").html(response.s_id);
			$("#createTitle").val(response.s_title);
			catid = response.s_catid;
			$("#selectcat").val(catid);
			$("#editorSubmitBtn").attr('onclick','modifyArchive('+id+')');
		}
	});
}


function modifyArchive(id){
	var cont = $("#myd").html();
	var container = document.getElementById('myd');
	var cat = $("#selectcat").val();
	var title = $("#createTitle").val();
	var boldContents = container.getElementsByTagName('b');
	var keywords = "";
	for(var i=0; i<boldContents.length; i++){
		keywords += boldContents[i].innerText+"|";
	}
	if(cat == 0){
		alert("Select a mastery");
		return;
	}
	$.ajax({
		type: 'POST',
		url: '../controller/archiveController/',
		dataType: 'json',
		data: {
			action: 'modifyarchive',
			id: id,
			title: title || '@',
			category: cat,
			content: cont,
			keywords: keywords,
		},
		beforeSend: function(){
			$(".loader").addClass("activeloader");
		},
		success: function(response){
			$("#createTitle").val('');
			reload();
			newsFeed();
			$("#mydContainer").collapse("hide");
		}
	});
}
