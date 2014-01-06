<?php
session_start();

/*-----------------------------------------------------------------------------------*/
/*	 appointment request function to process appointment form submition
/*-----------------------------------------------------------------------------------*/	
	
	if(isset($_POST['apo_email'])){
			if(isset($_POST['apo_email'])):		
					
					if($_POST['captcha'] != $_SESSION['appointment_code']) 
					{
                        echo 'Wrong Code!';
						die;
					}
					
					$name = $_POST['apo_name'];		            
					$phone = $_POST['apo_phone'];
					$email = $_POST['apo_email'];
					$ap_date = $_POST['apo_date'];
		            $message = $_POST['message'];
					$address = $_POST['target'];
					
		            if(get_magic_quotes_gpc()) {
		                    $message = stripslashes($message);
		            }										

					$e_subject = 'You Have Received an Appointment Request From : ' . $name . '.';
										
					
					$e_body = 	"You have Received an Appointment Request From "
								. "\n"
								."Name: ".$name								
								. "\n"
								."Phone: " . $phone								
								. "\n"
								."Email: " . $email								
								. "\n"
								."Desired Date: " . $ap_date								
								. "\n"
								."Their additional message is as follows."
								."\r\n\n";
					
					$e_content = "\" $message \"\r\n\n";
					
					$e_reply = 	"You can contact "
								.$name 
								. " via email "
								.$email
								. " OR via phone "
								.$phone;
					
					$msg = $e_body . $e_content . $e_reply;
					
					if(mail($address, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n","-f $address"))
					{						 
						echo "Appointment Request Sent Successfully!";
					} 
					else 
					{
						echo "Server Error: WordPress mail method failed!";	
					}						
			else:			
					echo "Invalid Request !";						
			endif;
			
	} else {
				
/*-----------------------------------------------------------------------------------*/
/*	 send message function to process contact form submition
/*-----------------------------------------------------------------------------------*/


		if(isset($_POST['email'])):	
					
					if($_POST['captcha'] != $_SESSION['rand_code']) 
					{
                        echo 'Wrong Code!';
						die;
					}
										
					$name = $_POST['author'];
		            $email = $_POST['email'];
					$phone = $_POST['phone'];
					$subject = $_POST['subject'];
		            $message = $_POST['message'];
					$address = $_POST['target'];
					
		            if(get_magic_quotes_gpc()) {
		                    $message = stripslashes($message);
		            }										

					$e_subject = 'You Have Received a Message From ' . $name . '.';
					
					if(!empty($subject))
					{
						$e_subject = $subject . ':' . $name . '.';
					}
					
					$e_body = 	"You have Received a message from: "
								.$name								
								. "\n"
								."Phone: " . $phone								
								. "\n"
								."Their additional message is as follows."
								."\r\n\n";
					
					$e_content = "\" $message \"\r\n\n";
					
					$e_reply = 	"You can contact "
								.$name 
								. " via email, "
								.$email;
					
					$msg = $e_body . $e_content . $e_reply;
					if(mail($address, $e_subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n","-f $address"))
					{						 
						echo "Message Sent Successfully!";
					} 
					else 
					{
						echo "Server Error: WordPress mail method failed!";	
					}						
			else:			
					echo "Invalid Request !";						
			endif;
				
			die;
			
	}
