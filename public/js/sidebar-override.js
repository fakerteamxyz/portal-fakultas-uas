// This file extends and overrides the default SB Admin 2 behavior
// to ensure that clicking icons in the sidebar when toggled doesn't expand it

$(document).ready(function() {
    // Completely override SB Admin 2's default behavior
    // Unbind all existing click handlers from nav links in the sidebar
    $(".sidebar .nav-item .nav-link").off();
    
    // Reapply new click handlers that prevent toggling and preserve navigation
    $(".sidebar .nav-item .nav-link").on("click", function(e) {
        // If the sidebar is toggled/collapsed
        if ($(".sidebar").hasClass("toggled")) {
            // For dropdown menus, we need to handle them differently
            if ($(this).attr('data-toggle') === 'collapse') {
                // Prevent the default toggling behavior
                e.preventDefault();
                e.stopPropagation();
                
                // If it has an href and it's not '#', navigate there directly
                if ($(this).attr('href') && $(this).attr('href') !== '#') {
                    window.location.href = $(this).attr('href');
                }
            } else {
                // Regular navigation links - just prevent sidebar expansion
                // but allow the link navigation to proceed
                e.stopPropagation();
            }
        }
    });
    
    // Completely disable all hover effects that might cause toggling
    $(".sidebar").off("mouseenter mouseleave");
    
    // Override the default SB Admin 2 toggle behavior for toggle buttons
    $("#sidebarToggle, #sidebarToggleTop").off("click").on("click", function(e) {
        e.preventDefault();
        let isToggled = $(".sidebar").hasClass("toggled");
        
        // Toggle the classes manually
        if (isToggled) {
            $("body").removeClass("sidebar-toggled");
            $(".sidebar").removeClass("toggled");
            $("#sidebarToggle i, #sidebarToggleTop i").removeClass("fa-angle-right").addClass("fa-bars");
        } else {
            $("body").addClass("sidebar-toggled");
            $(".sidebar").addClass("toggled");
            $("#sidebarToggle i, #sidebarToggleTop i").removeClass("fa-bars").addClass("fa-angle-right");
        }
        
        // Save state to localStorage
        localStorage.setItem('sidebarToggled', !isToggled ? 'true' : 'false');
    });
    
    // Set initial sidebar state based on localStorage
    if (localStorage.getItem('sidebarToggled') === 'true') {
        $("body").addClass("sidebar-toggled");
        $(".sidebar").addClass("toggled");
        $("#sidebarToggle i, #sidebarToggleTop i").removeClass("fa-bars").addClass("fa-angle-right");
    }
});
