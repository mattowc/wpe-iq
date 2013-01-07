var $cs= jQuery.noConflict();
$cs(document).ready(function(){

	//global vars
	var enquiryfrm = $cs("#contact_frm");
	var your_name = $cs("#your-name");
	var your_email = $cs("#your-email");
	var your_subject = $cs("#your-subject");
	var your_message = $cs("#your-message");
	
	var your_name_Info = $cs("#your_name_Info");
	var your_emailInfo = $cs("#your_emailInfo");
	var your_subjectInfo = $cs("#your_subjectInfo");
	var your_messageInfo = $cs("#your_messageInfo");
	
	//On blur
	your_name.blur(validate_your_name);
	your_email.blur(validate_your_email);
	your_subject.blur(validate_your_subject);
	your_message.blur(validate_your_message);

	//On key press
	your_name.keyup(validate_your_name);
	your_email.keyup(validate_your_email);
	your_subject.keyup(validate_your_subject);
	your_message.keyup(validate_your_message);

	//On Submitting
	enquiryfrm.submit(function(){
		if(validate_your_name() & validate_your_email() & validate_your_subject() & validate_your_message())
		{
			return true
		}
		else
		{
			return false;
		}
	});

	//validation functions
	function validate_your_name()
	{
		if($cs("#your-name").val() == '')
		{
			your_name.addClass("error");
			your_name_Info.text("Please Enter Your Name");
			your_name_Info.addClass("message_error2");
			return false;
		}
		else
		{
			your_name.removeClass("error");
			your_name_Info.text("");
			your_name_Info.removeClass("message_error2");
			return true;
		}
	}

	function validate_your_email()
	{
		var isvalidemailflag = 0;
		if($cs("#your-email").val() == '')
		{
			isvalidemailflag = 1;
		}else
		if($cs("#your-email").val() != '')
		{
			var a = $cs("#your-email").val();
			var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
			//if it's valid email
			if(filter.test(a)){
				isvalidemailflag = 0;
			}else{
				isvalidemailflag = 1;	
			}
		}
		
		if(isvalidemailflag)
		{
			your_email.addClass("error");
			your_emailInfo.text("Please Enter valid Email Address");
			your_emailInfo.addClass("message_error2");
			return false;
		}else
		{
			your_email.removeClass("error");
			your_emailInfo.text("");
			your_emailInfo.removeClass("message_error");
			return true;
		}
	}

	

	function validate_your_subject()
	{
		if($cs("#your-subject").val() == '')
		{
			your_subject.addClass("error");
			your_subjectInfo.text("Please Enter Your Subject");
			your_subjectInfo.addClass("message_error2");
			return false;
		}
		else{
			your_subject.removeClass("error");
			your_subjectInfo.text("");
			your_subjectInfo.removeClass("message_error");
			return true;
		}
	}

	function validate_your_message()
	{
		if($cs("#your-message").val() == '')
		{
			your_message.addClass("error");
			your_messageInfo.text("Please Enter Your Message");
			your_messageInfo.addClass("message_error2");
			return false;
		}
		else{
			your_message.removeClass("error");
			your_messageInfo.text("");
			your_messageInfo.removeClass("message_error2");
			return true;
		}
	}

});