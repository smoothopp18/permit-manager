$(document).on('click', '.load-content', function(e) {
    e.preventDefault();
    var pageUrl = $(this).attr('href');
    
    // Check if pageUrl is not empty or invalid
    if (pageUrl && pageUrl !== '#') {
        // Update browser history
        history.pushState(null, '', pageUrl);
        
        // Load content via AJAX
        $('#content').load(pageUrl, function(response, status, xhr) {
            if (status == "error") {
                var msg = "Sorry but there was an error: ";
                $("#content").html(msg + xhr.status + " " + xhr.statusText);
            }
        });
    }
});

// Handle back/forward buttons
window.onpopstate = function(event) {
    var pageUrl = location.pathname;
    $('#content').load(pageUrl, function(response, status, xhr) {
        if (status == "error") {
            var msg = "Sorry but there was an error: ";
            $("#content").html(msg + xhr.status + " " + xhr.statusText);
        }
    });
};
