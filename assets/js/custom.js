$(document).ready(function() {
    $('.nav-link').on('click', function(e) {
      e.preventDefault();
      let pageUrl = $(this).attr('href');
      
      $('.main-content').load(pageUrl);
    });
  });
  
"use strict";

