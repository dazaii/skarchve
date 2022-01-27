<div id="addCatModal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <form id="addCatForm">
    	<div class="modal-content">
		  <div class="modal-body m-0 pb-0">
		    <p>Add mastery</p>
		    <input type="text" class="form-control-sm p-2 w-100" id="addCatName" style="border: solid 2px #f5f5f5;" name="catname">
		  </div>
		  <div class="modal-footer border-top-0">
		    <button type="submit" name="addok" class="btn text-white btn-info btn-sm">Save changes</button>
		  </div>
		</div>
    </form>
  </div>
</div>
<div id="renameCatModal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <form id="renameCatForm">
    	<div class="modal-content">
		  <div class="modal-body m-0 pb-0">
		    <p>Rename mastery</p>
		    <input type="text" class="form-control-sm p-2 w-100" id="renameCatInput" style="border: solid 2px #f5f5f5;" name="renamecatname">
		    <input type="hidden" class="form-control-sm p-2 w-100" id="renameCatId" style="border: solid 2px #f5f5f5;" name="catid">
		  </div>
		  <div class="modal-footer border-top-0">
		    <button type="submit" name="renameok" class="btn text-white btn-info btn-sm">Save changes</button>
		  </div>
		</div>
    </form>
  </div>
</div>
<div id="deleteCatModal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-sm">
    <form id="deleteCatForm">
    	<div class="modal-content">
		  <div class="modal-body m-0 pb-0">
		    <p><strong>Remove mastery</strong> - all of it's contents will be deleted also</p>
		    <input type="text" class="form-control-sm p-2 w-100" id="deleteCatInput" style="border: solid 2px #f5f5f5;" disabled name="deletecatname">
		    <input type="hidden" class="form-control-sm p-2 w-100" id="deleteCatId" style="border: solid 2px #f5f5f5;" name="deletecatid">
		    <input type="password" class="form-control-sm p-2 w-100" id="deleteCatPass" style="border: solid 2px #f5f5f5; margin-top: 4px" name="confirmpass" placeholder="password" required>
		  </div>
		  <div class="modal-footer border-top-0">
		    <button type="submit" name="renameok" class="btn text-white btn-danger btn-sm">Confirm delete</button>
		  </div>
		</div>
    </form>
  </div>
</div>
<div id="searchModal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-scrollable">
    	<div class="modal-content">

	      <div class="modal-header mb-0 pb-0 border-0">
		    <p>Archive search</p>
	        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
		  <div class="modal-body p-0 m-0 pb-0 justify-content-center">
		    <div class="row g-0 justify-content-center">
		    	<input type="text" id="searchIPT" onkeyup="searchArchive(this.value)" style="border: solid 2px #f5f5f5;" class="p-2 col-md-8 col-11">
		    </div>
		  </div>
		  <div class="modal-footer row g-0 fs-14px border-top-0">
		  	<div class="row" id="sResults">
		  		Results
		  	</div>
		  </div>
		</div>    
  </div>
</div>
<div id="chooseModal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-scrollable">
    	<div class="modal-content">

	      <div class="modal-header mb-0 pb-0 border-0">
		    <p>Choose to embed</p>
	        <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
		  <div class="modal-body p-0 m-0 pb-0 justify-content-center">
		    <div class="row g-0 justify-content-center">
		    	<input type="text" id="chooseIPT" onkeyup="searchArchive2(this.value)" style="border: solid 2px #f5f5f5;" class="p-2 col-md-8 col-11">
		    </div>
		  </div>
		  <div class="modal-footer row g-0 fs-14px border-top-0">
		  	<div class="row" id="sResults2">
		  		Results
		  	</div>
		  </div>
		</div>    
  </div>
</div>
<div id="previewModal" class="modal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-scrollable">
    	<div class="modal-content" style="background-color: #FCEFD9;">
		  <div class="modal-footer row g-0 fs-14px border-top-0">
		  	<div class="row" id="singlepostview">
		  		Yukkuri matte
		  	</div>
		  </div>
		</div>    
  </div>
</div>
<div id="preferencesModal" class="modalCont" tabindex="-1">
  <div id="mainModal" class="bg-white rounded p-2">
  	<div class="row p-2 justify-content-between g-0">
    	<div class="p-0 col-auto" style="position: relative;">
    		<span style="top: -1px; position:relative"><?php logouticon(); ?></span> Preferences
    	</div>    
		<button class="col-auto btn btn-sm border-0" onclick="closePreferences()">
			<svg width='24' height='24' fill='currentColor' class='bi bi-x' viewBox='0 0 16 19'>
			  <path d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
			</svg>
		</button>
    </div>
    <div class="row g-0 px-2 mb-2">
    	<a href="#" onclick="darkmode(this)" class="col-12 p-1 hover btn btn-sm text-start">Dark mode</a>
    	<a href="../../sayonara.php" class="col-12 p-1 hover btn btn-sm text-start">Logout</a>
    </div>
  </div>
</div>