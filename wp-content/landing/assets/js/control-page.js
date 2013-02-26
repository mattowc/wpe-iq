/**
 * Uses namespace jm
 *
 * @author Jonathon McDonald <jon@onewebcentric.com>
 */
var jm = {};
jm.current = "home";

/**
 * Handle form validation
 */
$(document).ready(function() {
	$('#continue').click(function(ev) {
		// Stop submission
		ev.preventDefault();

		// General error boolean, used to block/allow submission
		var isError = false;

		// First check the name
		if ($('#input-name').val().length < 2) {
			$('#name').addClass('error');
			isError = true;
		}

		// Next check the email
		if (!jm.validateEmail($('#input-email').val())) {
			$('#email').addClass('error');
			isError = true;
		}

		// Lastly check the phone
		if (!jm.validatePhone($('#input-phone').val())) {
			$('#phone').addClass('error');
			isError = true;
		}

		// If there are any errors, show them and return
		if (isError) {
			// Any control groups with errors will have them removed on click
			$('.error').click(function() {
				$(this).removeClass('error');
			});

			// Return false
			return false;
		} else {
			// No errors, proceed with submission
			$('#core-form').submit();
		}
	});
});

/**
 * This is for working with the navigation.
 * This simply hides and shows content
 */
$(document).ready(function() {
	// Hides all content
	$('.content:not(#' + jm.current + ')').hide();

	// If a hash tag was supplied, assume and it matches a .content id, use it
	if(window.location.hash !== null && window.location.hash !== "")
	{
		$('.content[id]').each(function() {
			if(this.id === window.location.hash.replace("#", "")) {
				$('#' + jm.current + '.content').hide();
				jm.current = this.id;
			}
		});
	}

	// Ensure the current element is being shown
	$('#' + jm.current + '.content').show();
	$('#' + jm.current).parents().addClass('active');

	// Now if a link is clicked we need to handle it
	$('.nav-links').click(function(ev) {
		// Prevent the default
		ev.preventDefault();
		
		// Hide the current element
		$('#' + jm.current).parents().removeClass('active');
		$('#' + jm.current + '.content').hide();

		// Set jm.current (tracking the current page) to the new page
		jm.current = this.id;

		// Appropriately show the new page
		$('#' + jm.current).parents().addClass('active');
		$('#' + jm.current + '.content').show();

		// Push into google analytics
		_gaq.push(['_trackPageview', jm.current + '.html']); 
	});
});

/**
 * This adds colorbox functionality for a vimeo video
 */
$(document).ready(function() {
	$(".vimeo").colorbox({iframe:true, innerWidth:500, innerHeight:375});
});

/**
 * Validates email via regex.
 *
 * Found and used from:
 * http://stackoverflow.com/questions/46155/validate-email-address-in-javascript
 */
jm.validateEmail = function(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

/**
 * Validates phone, based mostly on length.  
 */
jm.validatePhone = function(phone) {
	if (phone == null || phone.length < 1) {
		return false;
	}

	phone = phone.replace(/[^0-9]/g, '');

	if (phone.length < 10) {
		return false;
	} else {
		return true;
	}
}
