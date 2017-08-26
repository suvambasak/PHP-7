<?php

	function send_android_notification($deviceToken, $message) {


		// FIREBASE_SERVER_KEY_FOR_ANDROID_NOTIFICATION
		$headers = array(
		'Authorization: key=SERVER_KEY'
		);

		//notificaion.
		$fields = array(
		'to' =>$deviceToken,
		'notification'=>array('title'=>'GISBMS','body'=>$message));

		

		// Open connection
		$ch = curl_init();
		// Set the url, number of POST vars, POST data
		curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
		curl_setopt( $ch,CURLOPT_POST, true );
		curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
		// Disabling SSL Certificate support temporarly
		curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode($fields));
		// Execute post
		$result = curl_exec($ch );
		if($result === false){
			die('Curl failed:' .curl_errno($ch));
		}
		// Close connection
		curl_close($ch);
		return $result;
	}

	//send a notifiation
	$android_device_token = 'ANDROID_DEVICE_TOKEN';

	$message = 'This is my first push notification using FCM';

	$result = send_android_notification($android_device_token, $message);

	//dump result
	var_dump($result);

	echo "notification sent!!";
?>
