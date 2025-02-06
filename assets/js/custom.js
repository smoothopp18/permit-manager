$(document).ready(function () {
  // Handle nav link clicks for main content using event delegation
  $(document).on('click', '.nav-link', function (e) {
    e.preventDefault();
    let pageUrl = $(this).attr('href');
    $('.main-content').load(pageUrl);
  });

  // Handle clicks on the link with ID viewDocs using event delegation
  $(document).on('click', '#viewDocs', function (e) {
    e.preventDefault();
    let pageUrl = $(this).attr('href');
    $('.main-content').load(pageUrl);
  });

  // Handle clicks on the link with ID forward-to-ceo-link using event delegation
  $(document).ready(function () {
    $('#forward-to-ceo-link').on('click', function (e) {
      e.preventDefault();
      $('#main-content').load('fordward-to-ceo.php');
    });
  });

  // Validate phone number field using event delegation for dynamically added elements
  $(document).on('blur', '#phone-number', function () {
    let phoneNumber = $(this).val();
    let regex = /^[0-9]{10}$/; // Simple regex for 10-digit phone number

    if (!regex.test(phoneNumber)) {
      alert('Please enter a valid 10-digit phone number');
    }
  });
});
