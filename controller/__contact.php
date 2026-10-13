<?php
if (!defined('RECAPTCHA_SITE_KEY')) {
    define('RECAPTCHA_SITE_KEY', '6LfBGs4tAAAAABAa8yv-Y4QEm7PR9QJFJUl8zlyn');
}
if (!defined('RECAPTCHA_SECRET_KEY')) {
    define('RECAPTCHA_SECRET_KEY', '6LfBGs4tAAAAAKQuFneYW7UDK1y6XSD2wNrVb2BD');
}

// ===== Verify reCAPTCHA token with Google =====
function verifyRecaptcha($token){
    if(empty($token)){
        return false;
    }
    $postdata = http_build_query([
        'secret'   => RECAPTCHA_SECRET_KEY,
        'response' => $token,
        'remoteip' => $_SERVER['REMOTE_ADDR'] ?? '',
    ]);

    $ch = curl_init('https://www.google.com/recaptcha/api/siteverify');
    curl_setopt_array($ch, [
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $postdata,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 10,
        CURLOPT_SSL_VERIFYPEER => true,
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    if($response === false){
        return false;
    }

    $result = json_decode($response, true);
    return !empty($result['success']);
}

if(isset($_POST['contactfrm'])){

$fullname = trim(mysqli_real_escape_string($con, $_POST['fullname']));
$mobile   = trim(mysqli_real_escape_string($con, $_POST['mobile']));
$email    = trim(mysqli_real_escape_string($con, $_POST['email']));
$message  = trim(mysqli_real_escape_string($con, $_POST['message']));
$recaptcha = $_POST['g-recaptcha-response'] ?? '';

if($fullname=='' || $mobile=='' || $email==''){
    $_SESSION['contact_msg'] = "<div class='alertdiv failed'><p>Please fill all required fields.</p></div>";
}elseif(!verifyRecaptcha($recaptcha)){
    $_SESSION['contact_msg'] = "<div class='alertdiv failed'><p>Please verify that you are not a robot.</p></div>";
}else{
    $sqlins = mysqli_query($con, "INSERT INTO `contact`(`enquiry_type`, `name`, `email`, `state`, `phone`, `message`, `status`) VALUES('Contact Us', '$fullname', '$email', '', '$mobile', '$message', 1)");

    if($sqlins){
        $rwsettings = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM settings LIMIT 1"));
        $toemail    = $rwsettings['email_id'];
        $subject    = "New Contact Enquiry - Website";
        $bodydata   = "Name : $fullname <br>
Email : $email <br>
Mobile No. : $mobile <br>
Message : $message <br>";
        SendEmailer($toemail, $subject, $bodydata, null, $email);
        $_SESSION['contact_msg'] = "<div class='alertdiv success'><p>Thank you! Your message has been sent. We will get back to you soon.</p></div>";
    }else{
        $_SESSION['contact_msg'] = "<div class='alertdiv failed'><p>Something went wrong. Please try again.</p></div>";
    }
}

echo "<script>window.location.href='{$path}contact'</script>";
exit();

} ?>
