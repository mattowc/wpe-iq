/**
 * This will simply test the progress bar
 * and see what it's worth.... ;)
 */
var jm = {};

jm.i = 0;
jm.step = 1;
jm.percentage = 33;
jm.current = "home";

/**
 * This actually sets up the progress bar
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
	$('#continue').click(function(ev) {
		// Prevent default behavior
		ev.preventDefault();

		// Select the current form inputs
		var curr = $('#' + jm.step + ' select').val();

		console.log(curr);

		// Prevent errors from progressing...
		if((jm.step == 1 && curr == "Choose Student's Age Range") || (jm.step== 2 && curr == "Choose Learning Disability")) {
			$('#' + jm.step).addClass('error');
			$('#' + jm.step + ' select').click(function() {
				$('#' + jm.step).removeClass('error');
			});
			return;
		}

		var errorInInput = false;

		// If it's the last step, we should do some pretty interesting error checking...
		$('#' + jm.step + ' input').each(function() {
			if($(this).val() == "")
			{
				$('#' + jm.step).addClass('error');
				$('#' + jm.step + ' input').click(function() {
					$('#' + jm.step).removeClass('error');
				});

				errorInInput = true;
				return; // This just returns from the current function :\...
			}
		});

		if(errorInInput)
			return;

		// Hide the current step, and show the next
		$('#' + jm.step).hide();

		// Let google analytics know that this step was completed
		_gaq.push(['_trackEvent', 'Hero Form', 'Step Completed', 'Step #' + jm.step + ' Completed']);

		// Besides the event we want to also track goal completion...
		_gaq.push(['_trackPageview', '/step' + jm.step + '.html']); 

		// Next let's move to the next step
		jm.step++;
		$('#' + jm.step).show();

		// Next let's increment the progress
		jm.percentage = (jm.step == 3) ? 100 : 33 * jm.step;
		$('.bar').width(jm.percentage + '%');

		// If this is the last step, we actually want to remove the click handler
		// and rename this to submit
		if(jm.step == 3) {
			$('form legend').html("The Last Step!");
			$('#continue').html("Submit");
		}
	});

	// This goes back, but doesn't check the form
	$('#back').click(function(ev) {
		// Prevent default
		ev.preventDefault();

		// Don't allow the user to go behind step zero
		if(jm.step == 1)
			return;

		// If we were at step three, we need to do some clean up
		if(jm.step == 3) {
			$('form legend').html("Get your personalized consultation in 3 easy steps");
			$('#continue').html("Next");
		}

		// Hide the current step, and show the previous
		$('#' + jm.step).hide();
		jm.step--;
		$('#' + jm.step).show();

		// Next let's decrement the progress
		jm.percentage = 33 * jm.step;
		jm.i = 33 * jm.step;
		$('.bar').width(jm.percentage + '%');
	});
});

/**
 * This is for working with the navigation.
 * This simply hides and shows content
 */
$(document).ready(function() {
	// Hides all content
	$('.content:not(#' + jm.current + ')').hide();

	// Ensure the current element is being shown
	$('#' + jm.current).show();
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


