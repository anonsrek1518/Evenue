<!-- Style block defining CSS rules -->
<style>
  /* Modal dialog for large size */
  .modal-dialog.large {
    width: 80% !important;
    max-width: unset;
  }
  /* Modal dialog for mid-large size */
  .modal-dialog.mid-large {
    width: 50% !important;
    max-width: unset;
  }
</style>

<!-- Script block for JavaScript functionality -->
<script>
  // Function to initialize datepicker
  $('.datepicker').datepicker({
    format: "yyyy-mm-dd" // Date format
  });

  // Function to show loading indicator
  window.start_load = function(){
    $('body').prepend('<di id="preloader2"></di>'); // Add loading indicator to body
  }

  // Function to hide loading indicator
  window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
      $(this).remove(); // Remove loading indicator
    });
  }

  // Function to display modal with dynamic content
  window.uni_modal = function($title = '', $url = '', $size = ''){
    start_load(); // Show loading indicator
    $.ajax({
      url: $url,
      error: err => {
        console.log();
        alert("An error occurred"); // Alert user about error
      },
      success: function(resp){
        if(resp){
          $('#uni_modal .modal-title').html($title); // Set modal title
          $('#uni_modal .modal-body').html(resp); // Set modal content
          if($size != ''){
            $('#uni_modal .modal-dialog').addClass($size); // Set modal size
          } else {
            $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md"); // Default modal size
          }
          $('#uni_modal').modal({
            show: true, // Show modal
            backdrop: 'static', // Disable clicking outside modal to close
            keyboard: false, // Disable keyboard closing
            focus: true // Set focus to modal
          });
          end_load(); // Hide loading indicator
        }
      }
    });
  }

  // Function to display modal on the right side with dynamic content
  window.uni_modal_right = function($title = '', $url = ''){
    start_load(); // Show loading indicator
    $.ajax({
      url: $url,
      error: err => {
        console.log();
        alert("An error occurred"); // Alert user about error
      },
      success: function(resp){
        if(resp){
          $('#uni_modal_right .modal-title').html($title); // Set modal title
          $('#uni_modal_right .modal-body').html(resp); // Set modal content
          $('#uni_modal_right').modal('show'); // Show modal
          end_load(); // Hide loading indicator
        }
      }
    });
  }

  // Function to display image or video in a viewer modal
  window.viewer_modal = function($src = ''){
    start_load(); // Show loading indicator
    var t = $src.split('.'); // Split source to get file extension
    t = t[1]; // Get file extension
    var view; // Initialize variable for image or video
    if(t == 'mp4'){
      view = $("<video src='"+$src+"' controls autoplay></video>"); // Create video element
    } else {
      view = $("<img src='"+$src+"' />"); // Create image element
    }
    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove(); // Remove existing image or video
    $('#viewer_modal .modal-content').append(view); // Append new image or video
    $('#viewer_modal').modal({
      show: true, // Show modal
      focus: true // Set focus to modal
    });
    end_load(); // Hide loading indicator
  }

  // Function to display toast alert
  window.alert_toast = function($msg = 'TEST', $bg = 'success'){
    // Remove existing alert classes
    $('#alert_toast').removeClass('bg-success');
    $('#alert_toast').removeClass('bg-danger');
    $('#alert_toast').removeClass('bg-info');
    $('#alert_toast').removeClass('bg-warning');

    // Add background color class based on parameter
    if($bg == 'success')
      $('#alert_toast').addClass('bg-success');
    if($bg == 'danger')
      $('#alert_toast').addClass('bg-danger');
    if($bg == 'info')
      $('#alert_toast').addClass('bg-info');
    if($bg == 'warning')
      $('#alert_toast').addClass('bg-warning');

    // Set toast message
    $('#alert_toast .toast-body').html($msg);
    // Show toast with delay
    $('#alert_toast').toast({delay: 3000}).toast('show');
  }

  // Function to load cart count
  window.load_cart = function(){
    $.ajax({
      url: 'admin/ajax.php?action=get_cart_count',
      success: function(resp){
        if(resp > -1){
          resp = resp > 0 ? resp : 0;
          $('.item_count').html(resp); // Update cart count display
        }
      }
    });
  }

  // Event listener for login button click
  $('#login_now').click(function(){
    uni_modal("LOGIN", 'login.php'); // Open login modal
  });

  // Document ready function
  $(document).ready(function(){
    load_cart(); // Load cart count
    $('#preloader').fadeOut('fast', function() {
      $(this).remove(); // Remove preloader
    });
  });
</script>
<!-- Bootstrap core JS-->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<!-- Third party plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
