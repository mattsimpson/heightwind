(function ($) {
jQuery(document).ready(function($){

	/**
     * Responsive video embeds with native CSS
     */
	// Modern browsers support aspect-ratio CSS property
	// Fallback handled in CSS with padding-bottom technique


    /**
     * Navigation
     */

    // Add .parent class to appropriate menu items
    jQuery( 'ul.sub-menu' ).parent().addClass( 'parent' );


    // Add the 'show-nav' class to the body when the nav toggle is clicked
    jQuery( '.nav-toggle' ).click(function(e) {

        // Prevent default behaviour
        e.preventDefault();

        // Add the 'show-nav' class
        jQuery( 'body' ).toggleClass( 'show-nav' );

    });


    // Remove the 'show-nav' class from the body when the nav-close anchor is clicked
    jQuery('.nav-close').click(function(e) {

        // Prevent default behaviour
        e.preventDefault();

        // Remove the 'show-nav' class
        jQuery( 'body' ).removeClass( 'show-nav' );
    });


    // Remove the 'show-nav' class from the body when the user clicks (taps) outside #navigation
    const hasParent = function(el, id) {
        if (el) {
            do {
                if (el.id === id) {
                    return true;
                }
                if (el.nodeType === 9) {
                    break;
                }
            }
            while((el = el.parentNode));
        }
        return false;
    };

    // Modern touch/click event handling (IE8 attachEvent removed)
    if (jQuery(window).width() < 767) {
        document.addEventListener('touchstart', function(e) {
            if ( jQuery( 'body' ).hasClass( 'show-nav' ) && !hasParent( e.target, 'navigation' ) ) {
                // Prevent default behaviour
                e.preventDefault();

                // Remove the 'show-nav' class
                jQuery( 'body' ).removeClass( 'show-nav' );
            }
        }, false);
    }


    /**
     * Scroll to top
     */
    jQuery(function () {
        jQuery( '.back-to-top' ).click(function () {
            jQuery( 'body,html' ).animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

    /**
     * Show/hide back-to-top button using Intersection Observer API
     * Modern approach that doesn't use scroll listeners for better performance
     */
    if ('IntersectionObserver' in window) {
        // Create a sentinel element at the top of the page
        const sentinel = document.createElement('div');
        sentinel.style.position = 'absolute';
        sentinel.style.top = '200px';
        sentinel.style.height = '1px';
        sentinel.style.width = '1px';
        sentinel.style.pointerEvents = 'none';
        document.body.insertBefore(sentinel, document.body.firstChild);

        // Create observer to watch the sentinel
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
                // When sentinel is NOT intersecting, we've scrolled past 200px
                if (!entry.isIntersecting) {
                    jQuery('.back-to-top').fadeIn();
                } else {
                    jQuery('.back-to-top').fadeOut();
                }
            });
        }, {
            threshold: 0
        });

        // Start observing
        observer.observe(sentinel);
    } else {
        // Fallback for older browsers (passive scroll listener)
        $(window).on('scroll', function() {
            if ( $(this).scrollTop() > 200 ) {
                $( '.back-to-top' ).fadeIn();
            } else {
                $( '.back-to-top' ).fadeOut();
            }
        });
    }

});
}(jQuery));