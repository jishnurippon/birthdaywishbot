
<?php
require 'vendor/autoload.php';
require 'db.php';
use PHPMailer\PHPMailer\PHPMailer;

if (!isset($_GET['id'])) {
        echo "<script>
            alert('Something went wrong, please try again');
            window.location.href = 'index.php';
            </script>";
} else {
    $id = $_GET['id'];
    $today = date('m-d');
    $stmt = $pdo->prepare("SELECT * FROM users WHERE DATE_FORMAT(birthdate, '%m-%d') = ? AND (last_sent IS NULL OR DATE(last_sent) != CURDATE())");
    $stmt->execute([$today]);
    $users = $stmt->fetchAll();

    if($users){
        foreach ($users as $user) {
            $mail = new PHPMailer(true);
            $status = 'success';
            $message = 'Email sent';
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = '<email ID>';
                $mail->Password = '<password or passkey>';
                $mail->addBCC('<BCC email id>', 'IT');

                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('<from id>', 'irthday Bot');
                $mail->addReplyTo('<reply to id>', 'Do Not Reply');

                $mail->addAddress($user['email'], $user['name']);
                $mail->Subject = 'Happy Birthday!';

                $mail->addEmbeddedImage('poster.png', 'birthdayimg');
                $mail->isHTML(true);

                $mail->Body = "
                    <div style='text-align: center; font-family: Arial, sans-serif;'>
                        <h3 style='color: #333;'>{$user['name']}</h3>
                        <p style='font-size: 14px;'>
                            Wishing you a truly wonderful birthday! Your dedication, positivity, and hard work make a lasting impact every day, and today we celebrate <strong>you</strong>.
                        </p>
                        <img src='cid:birthdayimg' alt='Happy Birthday' style='max-width: 100%; height: auto; border-radius: 10px;'>
                        <p style='margin-top: 20px;'>– From all of us at <strong>Company Name</strong></p>
                                <hr style='margin: 40px 0; border: none; border-top: 1px solid #ccc; width: 100%;'>
                        <p style='font-size: 10px; color: #888; font-style: italic; text-align: center;'>
                            This is an auto-generated message. Please do not reply to this email.
                        </p>

                    </div>
                    ";
                $mail->send();
                $pdo->prepare("UPDATE users SET last_sent = NOW() WHERE id = ?")->execute([$user['id']]);
            } catch (Exception $e) {
                $status = 'failed';
                $message = $e->getMessage();
            }
            $pdo->prepare("INSERT INTO email_logs (name, sent_at, status, message) VALUES (?, NOW(), ?, ?)")
                ->execute([$user['name'], $status, $message]);
            if($status != 'failed'){
                echo "<script>
                alert('Mail shared successfully');
                window.location.href = 'index.php';
                </script>";
            } else {
                echo "<script>
                alert('Something went wrong, please try again');
                window.location.href = 'index.php';
                </script>";
            }
        }
    } else {
        echo "<script>
        alert('The birthday email has already been shared.!');
        window.location.href = 'index.php';
        </script>";
    }
}
?>