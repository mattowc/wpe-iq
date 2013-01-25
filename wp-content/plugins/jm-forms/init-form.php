<?php
/**
 * This will help us quickly test how easy or hard it is
 * to write our own custom forms.  
 *
 * @author Jonathon McDonald <jon@onewebcentric.com>
 */

if( isset( $_POST['jam-form-hidden'] ) ) {
	wp_mail( 'jon@onewebcentric.com', $_POST['your_subject'], $_POST['your_email'] );
}
