<?php

function rw_contacts_send_msg(){
	if(isset($_POST['cf_user_name']) ||  wp_verify_nonce( $_POST['nonce'], $_POST['contacts_send_msg'] ) ){
		$user_name   = str_replace('/','',stripslashes(trim(filter_input( INPUT_POST, 'cf_user_name', FILTER_SANITIZE_STRING ))));
		$phone 	= str_replace('/','',stripslashes(trim(filter_input(INPUT_POST, 'cf_user_phone', FILTER_SANITIZE_STRING ))));
		$emailTo = 'viknos.style@gmail.com, andriy.bay@gmail.com';
		//echo $user_name . ' '. $email . ' ' . $subject . ' ' . $msg;
		$subject = 'From '.$user_name;
		$body = "Ім'я: $user_name \nТелефон: $phone";
		$headers = 'From:';
		//$headers = "Від: '.$user_name.'";
		wp_mail($emailTo, $subject, $body, $headers);
		echo json_encode(array('status'=>'success'));
		die;
	}
	else{
		echo 'input value is null';
	}
}
add_action('wp_ajax_contacts_send_msg', 'rw_contacts_send_msg');
add_action('wp_ajax_nopriv_contacts_send_msg', 'rw_contacts_send_msg');
