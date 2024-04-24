<!-- This is a container with fluid width -->
<div class="container-fluid">
	<!-- Form for managing book requests -->
	<form action="" id="manage-book">
		<!-- Hidden input field for book ID -->
		<input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
		<!-- Hidden input field for venue ID obtained from query parameter -->
		<input type="hidden" name="venue_id" value="<?php echo isset($_GET['venue_id']) ? $_GET['venue_id'] :'' ?>">
		<!-- Form group for full name -->
		<div class="form-group">
			<label for="" class="control-label">Full Name</label>
			<!-- Input field for entering full name -->
			<input type="text" class="form-control" name="name"  value="<?php echo isset($name) ? $name :'' ?>" required>
		</div>
		<!-- Form group for address -->
		<div class="form-group">
			<label for="" class="control-label">Address</label>
			<!-- Textarea for entering address -->
			<textarea cols="30" rows="2" required="" name="address" class="form-control"><?php echo isset($address) ? $address :'' ?></textarea>
		</div>
		<!-- Form group for email -->
		<div class="form-group">
			<label for="" class="control-label">Email</label>
			<!-- Input field for entering email -->
			<input type="email" class="form-control" name="email"  value="<?php echo isset($email) ? $email :'' ?>" required>
		</div>
		<!-- Form group for contact number -->
		<div class="form-group">
			<label for="" class="control-label">Contact #</label>
			<!-- Input field for entering contact number -->
			<input type="text" class="form-control" name="contact"  value="<?php echo isset($contact) ? $contact :'' ?>" required>
		</div>
		<!-- Form group for duration -->
		<div class="form-group">
			<label for="" class="control-label">Duration</label>
			<!-- Input field for entering duration -->
			<input type="text" class="form-control" name="duration"  value="<?php echo isset($duration) ? $duration :'' ?>" required>
		</div>
		<!-- Form group for desired event schedule -->
		<div class="form-group">
			<label for="" class="control-label">Desired Event Schedule</label>
			<!-- Input field for entering desired event schedule with datetime picker -->
			<input type="text" class="form-control datetimepicker" name="schedule"  value="<?php echo isset($schedule) ? $schedule :'' ?>" required>
		</div>
	</form>
</div>

<!-- Script for initializing datetimepicker and handling form submission -->
<script>
	// Initialize datetimepicker
	$('.datetimepicker').datetimepicker({
		format: 'Y/m/d H:i',
		startDate: '+3d'
	});

	// Handle form submission
	$('#manage-book').submit(function(e){
		e.preventDefault(); // Prevent default form submission
		start_load(); // Show loading indicator
		$('#msg').html(''); // Clear any existing messages

		// Perform AJAX request to save book data
		$.ajax({
			url: 'admin/ajax.php?action=save_book',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp){
				if(resp == 1){
					// If request is successful, show success message and load book_msg.php in modal
					alert_toast("Book Request Sent.", 'success');
					end_load();
					uni_modal("", "book_msg.php");
				}
			}
		});
	});
</script>
