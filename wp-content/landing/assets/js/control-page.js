/**
 * This will simply test the progress bar
 * and see what it's worth.... ;)
 */
var jm = {};

jm.i = 0;
jm.step = 0;
jm.percentage = 1;
jm.current = "home";

/**
 * This actually sets up the page
 */
$(document).ready(function() {
	$('.bar').width(jm.percentage + '%');
});

/**
 * This is for giving the form a very dynamic feel
 * and alive feel.  Currently form checking must happen at each step.
 */
$(document).ready(function() {
	$('.control-group').hide();
	$('#' + jm.step).show();
	
	// Handle continue functionality
	// This must check the form first
	$('#continue').click(function() {
		// Prevent default behavior
		event.preventDefault();

		if($('#' + jm.step + ' input').val() == "")
		{
			$('#' + jm.step).addClass('error');
			$('#' + jm.step + ' input').click(function() {
				$('#' + jm.step).removeClass('error');
			});
			return;
		}

		// Hide the current step, and show the next
		$('#' + jm.step).hide();
		jm.step++;
		$('#' + jm.step).show();

		// Next let's increment the progress
		jm.percentage = 25 * jm.step;
		$('.bar').width(jm.percentage + '%');
	});

	// This goes back, but doesn't check the form
	$('#back').click(function() {
		// Prevent default
		event.preventDefault();

		// Hide the current step, and show the previous
		$('#' + jm.step).hide();
		jm.step--;
		$('#' + jm.step).show();

		// Next let's decrement the progress
		jm.percentage = 25 * jm.step;
		jm.i = 25 * jm.step;
		$('.bar').width(jm.percentage + '%');
	});
});

/**
 * This is for working with the navigation.
 * This simply hides and shows content
 */
$(document).ready(function() {
	$('.content:not(#' + jm.current + ')').hide();
	$('#' + jm.current).show();
	$('#' + jm.current).parents().addClass('active');

	$('.nav-links').click(function() {
		$('#' + jm.current).parents().removeClass('active');
		$('#' + jm.current + '.content').hide();
		jm.current = this.id;
		$('#' + jm.current).parents().addClass('active');
		$('#' + jm.current + '.content').show();
	});
});

/**
 * For tabs to be easily used.  This is taken
 * direct from the Bootstrap page
 */




