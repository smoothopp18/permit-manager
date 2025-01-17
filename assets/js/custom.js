// to enable automatic updates of the main content area when a nav link is clicked
$(document).ready(function() {
  // Handle nav link clicks for main content
  $('.nav-link').on('click', function(e) {
    e.preventDefault();
    let pageUrl = $(this).attr('href');

    $('.main-content').load(pageUrl);
    $('.table-content').load(pageUrl);
  });

  // Validate phone number field
  $('#phone-number').on('blur', function() {
    let phoneNumber = $(this).val();
    let regex = /^[0-9]{10}$/; // Simple regex for 10-digit phone number

    if (!regex.test(phoneNumber)) {
      alert('Please enter a valid 10-digit phone number');
    }
  });
});

