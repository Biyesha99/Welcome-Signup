
<?php
/*
include('smtp/PHPMailerAutoload.php');


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Users";

// Create connection
$conn = new mysqli_connect($servername, $username, $password, $dbname);

// Check connection errors
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//$sql = "SELECT id, user_id, email FROM welcome_mail WHERE sent = FALSE";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_username = $conn->real_escape_string($_POST['username']);
    $user_email = $conn->real_escape_string($_POST['email']);
    $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql_insert = "INSERT INTO userdata (username, email, password) VALUES ('$user_username', '$user_email', '$user_password')";

    if($conn->query($sql_insert) === TRUE) {
        echo "New record created successfully. Please check your email for a welcome message.";
		// Get the last inserted ID
        $last_id = $conn->insert_id;

        // Prepare welcome email
        $subject = "Welcome!";
        $emailbody = "Welcome to Whispering Willows. <br> The Seven Willows will help you live your life lively and say bye bye to depression.";

        // Send email
        smtp_mailer($user_email, $subject, $emailbody);
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$sql_select = "SELECT id, user_id, email FROM welcome_mail WHERE sent = FALSE";
$result = $conn->query($sql_select);

//$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
  // Loop through results (if multiple rows are expected)
  while($row = $result->fetch_assoc()) {
	  $email = $row["email"];
	  //Prepare email content
    $value = $row["column_name"]; // Access the value from the fetched row
    // Use the $value variable here
  }
} else {
  echo "No results found.";
}

mysqli_close($conn);

//$receiverEmail = $value;

// Use $my_variable elsewhere in your code



$subject="Welcome!";
$emailbody = "Welocome to Whispering Willows. <br> The Seven Willows will hep you to live your life lively and say bye bye to depression.";

echo smtp_mailer($value,$subject,$emailbody);

function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	//$mail->SMTPDebug = 2; 
	$mail->Username = "whispering7willows@gmail.com"; // Sender's Email
	$mail->Password = "qsde rsix blux vjaf "; //Sender's Email App Password
	$mail->SetFrom("whispering7willows@gmail.com"); // Sender's Email
	$mail->Subject = $subject;
	$mail->Body =$msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions=array('ssl'=>array(
		'verify_peer'=>false,
		'verify_peer_name'=>false,
		'allow_self_signed'=>false
	));
	if(!$mail->Send()){
		echo $mail->ErrorInfo;
	}else{
		echo "Mail Sent" . $to;
	}
}
*/



include('smtp/PHPMailerAutoload.php');

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_username = $conn->real_escape_string($_POST['username']);
    $user_email = $conn->real_escape_string($_POST['email']);
    $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if the email already exists
    $check_sql = "SELECT id FROM userdata WHERE email = '$user_email'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Email already exists
        echo "You already signed up.";
    } else {
        // Insert new user
        $insert_sql = "INSERT INTO userdata (username, email, password) VALUES ('$user_username', '$user_email', '$user_password')";

        if ($conn->query($insert_sql) === TRUE) {
            echo "New record created successfully. Please check your email for a welcome message.";

            // Prepare welcome email
            $subject = "Welcome!";
            $emailbody = "Welcome to Whispering Willows. <br> The Seven Willows will help you live your life lively and say bye bye to depression.";

            // Send email
            smtp_mailer($user_email, $subject, $emailbody);
        } else {
            echo "Error: " . $insert_sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();

function smtp_mailer($to, $subject, $msg) {
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tls'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2; 
    $mail->Username = "whispering7willows@gmail.com"; // Sender's Email
    $mail->Password = "qsdersixbluxvjaf"; // Sender's Email App Password
    $mail->SetFrom("whispering7willows@gmail.com"); // Sender's Email
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if (!$mail->Send()) {
        echo $mail->ErrorInfo;
    } else {
        echo "Mail Sent to " . $to;
    }
}




?>