<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $from_name = $_POST['name'];
    $from_email = $_POST['email'];
    $from_contact = $_POST['contact'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_type = $_FILES['file']['type'];
    $from_message = $_POST['message'];
    
    $to_email = 'safepowerelectricals9@gmail.com'; // Replace with your email address
    $subject = 'New Resume Submission ' . $from_name;
    $message = 'You have received a file attachment from ' . $from_name . ' (' . $from_email . ').';
    
    $boundary = md5(uniqid(time()));
    
    // Headers
    $headers = "From: $from_name <$from_email>\r\n";
    $headers .= "Reply-To: $from_email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";
    
    // Message Body
    $body = "--$boundary\r\n";
    $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
    $body .= $message . "\r\n";
    
    // Attachment
    if (is_uploaded_file($file_tmp)) {
        $file = fopen($file_tmp, "rb");
        $data = fread($file, filesize($file_tmp));
        fclose($file);
        $data = chunk_split(base64_encode($data));
        
        $body .= "--$boundary\r\n";
        $body .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n\r\n";
        $body .= $data . "\r\n";
    }
    
    $body .= "--$boundary--";
    
    // Send Email
    if (mail($to_email, $subject, $body, $headers)) {
        echo "Email has been sent successfully.";
    } else {
        echo "Failed to send email.";
    }
}
?>
