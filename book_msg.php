<!-- This is a container with fluid width -->
<div class="container-fluid">
	<!-- Message to inform the user that they will be contacted soon for book request verification -->
	<p>We will contact you soon for the verification of your book request. Thank you</p>
</div>

<!-- Modal footer with a display class -->
<div class="modal-footer display">
	<!-- Row inside the modal footer -->
	<div class="row">
		<!-- Column taking up the full width of the modal -->
		<div class="col-md-12">
			<!-- Button to close the modal -->
			<button class="btn btn-secondary float-right" type="button" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>

<!-- Style block defining CSS rules -->
<style>
	/* Hide the modal footer by default */
	#uni_modal .modal-footer{
		display: none;
	}
	/* Display the modal footer when it has the display class */
	#uni_modal .modal-footer.display{
		display: block;
	}
</style>
