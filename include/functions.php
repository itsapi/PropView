<?
	//Set path variables and include credentials file
	set_include_path('/var/www/PropView');
	include 'include/config.php';

	$mailDir = '/var/www/phpmailer/class.phpmailer.php';
	$domain = 'http://dvbris.no-ip.org/PropView';
	$gmail = false;

	//Set up MySQL database connection
	if (mysqli_connect_errno($mysqli)){
		printf("Connect failed: %s\n", mysqli_connect_error());
	}

	//Runs MySQL query on the database from a query parameter and returns the result
	function query_DB($query){
		$result = mysqli_query($GLOBALS['mysqli'], $query);
		if (!$result) {
			echo 'MySQLi query failed: (' . mysqli_errno($GLOBALS['mysqli']) . ') ' . mysqli_error($GLOBALS['mysqli']);
			return False;
		} else {
			return $result;
		}
	}

	//Obtain user data for cookie
	if (isset($_COOKIE['user'])){
		$userData = getUserData('username', $_COOKIE['user']);
	}

	//Returns an array with user data from database using a given column name and value
	function getUserData($name, $value){
		return mysqli_fetch_assoc(query_DB("SELECT * FROM users WHERE {$name}='{$value}'"));
	}

	//Builds and sends an email using either Gmail SMTP or the standard PHP mail()
	function email($to, $from, $subject, $message) {
		if ($gmail) {

			require_once($GLOBALS['mailDir']);
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->Host       = $GLOBALS['smtpHost'];
			$mail->SMTPDebug  = 1;
			$mail->SMTPAuth   = true;
			$mail->SMTPSecure = $GLOBALS['mailSecurity'];
			$mail->Host       = $GLOBALS['smtpHost'];
			$mail->Port       = $GLOBALS['mailPort'];
			$mail->Username   = $GLOBALS['mailUser']['email'];
			$mail->Password   = $GLOBALS['mailPass'];
			$mail->SetFrom($from['email'], "{$from['name']}");
			$mail->AddReplyTo($from['email'], "{$from['name']}");
			$mail->Subject    = $subject;
			$mail->AltBody    = $GLOBALS['noHTML'];
			$mail->MsgHTML($message);
			$mail->AddAddress($to['email'], "{$to['name']}");

			return $mail->Send();

		} else {

			$to = $to['email'];
			$from = $from['email'];

			$headers   = array();
			$headers[] = "MIME-Version: 1.0";
			$headers[] = "Content-type: text/plain; charset=iso-8859-1";
			$headers[] = "To: {$to['name']} <{$to['email']}>";
			$headers[] = "From: {$from['name']} <{$from['email']}>";
			$headers[] = "Reply-To: {$from['name']} <{$from['email']}>";
			$headers[] = "Subject: {$subject}";
			$headers[] = "X-Mailer: PHP/".phpversion();

			mail($to, $subject, $email, implode("\r\n", $headers));

		}
	}