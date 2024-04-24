<div class="container-fluid">
    <!-- Registration form -->
    <form action="" id="manage-register">
        <!-- Hidden input fields -->
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id :'' ?>">
        <input type="hidden" name="event_id" value="<?php echo isset($_GET['event_id']) ? $_GET['event_id'] :'' ?>">

        <!-- Full Name -->
        <div class="form-group">
            <label for="" class="control-label">Full Name</label>
            <input type="text" class="form-control" name="name" value="<?php echo isset($name) ? $name :'' ?>" required>
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="" class="control-label">Address</label>
            <textarea cols="30" rows="2" required="" name="address" class="form-control"><?php echo isset($address) ? $address :'' ?></textarea>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="" class="control-label">Email</label>
            <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email :'' ?>" required>
        </div>

        <!-- Contact Number -->
        <div class="form-group">
            <label for="" class="control-label">Contact #</label>
            <input type="text" class="form-control" name="contact" value="<?php echo isset($contact) ? $contact :'' ?>" required>
        </div>

        <!-- Data Privacy Policy Consent -->
        <div class="form-group">
            <p>We collect information for event registration purposes. Please review our <a href="https://dict.gov.ph/ra-10173/" target="_blank">Data Privacy Policy</a> for details. By submitting this form, you consent to the collection and use of your data.</p>
            <input type="checkbox" name="data_consent" required> I consent to the data collection.
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit Registration</button>
    </form>
</div>

<script>
    // DateTimePicker initialization
    $('.datetimepicker').datetimepicker({
        format:'Y/m/d H:i',
        startDate: '+3d'
    });

    // Form submission handling
    $('#manage-register').submit(function(e){
        e.preventDefault(); // Prevent default form submission
        start_load(); // Start loading spinner
        $('#msg').html(''); // Clear any previous messages
        $.ajax({
            url:'admin/ajax.php?action=save_register',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success:function(resp){
                if(resp==1){
                    alert_toast("Registration Request Sent.",'success'); // Show success message
                    end_load(); // Stop loading spinner
                    uni_modal("","register_msg.php"); // Open a modal with a registration message
                }
            }
        });
    });
</script>
