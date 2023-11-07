<?php
    use PHPMailer\PHPMailer\PHPMailer;

    if (isset($_POST['name']) && isset($_POST['email'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $body = $_POST['body'];

        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();
        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "sandbox.smtp.mailtrap.io";
        $mail->SMTPAuth = true;
        $mail->Username = "999c141601edce"; //enter you email address
        $mail->Password = 'cc90d0e5d03f66'; //enter you email password
        $mail->Port = 2525;

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        $mail->addAddress($email); //enter you email address
        $mail->Subject = ("$email ($subject)");
        $mail->Body = $body;
        $mail->SMTPDebug = 2;

        $response = array();

        if ($mail->send()) {
            $response['status'] = "success";
            $response['message'] = "Email is sent!";
        } else {
            $response['status'] = "error";
            $response['message'] = "Email sending failed: " . $mail->ErrorInfo;
        }
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>
