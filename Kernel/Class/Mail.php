<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 26/04/2018
 * Time: 10:21
 */

//$dirname = DIRNAME;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php'; //changer avec dirname
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Mail
{

    public static function sendMailRegister($email, $firstName, $lastName, $token)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = GUSER;                              // SMTP username
            $mail->Password = GPWD;                               // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('tosle.contact@gmail.com', 'Tosle Contact');
            $mail->addAddress($email);     // Add a recipient
            $mail->addReplyTo('tosle.contact@gmail.com');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Welcome to the CMS TOSLE  '.$firstName.' '.$lastName;
            //$mail->Body = 'Veuillez confirmer votre inscription en cliquant sur le lien ci-dessous </br>http://localhost:88/en/verify-mail-register?token='.$token.'';
            $mail->Body = 'Please confirm your registration by clicking on the link below </br>http://'.$_SERVER["SERVER_NAME"].Access::getSlugsById()['verify'].'?email='.$email.'&amp;token='.$token.'';
            $mail->AltBody = 'Please confirm your registration by clicking on the link below http://'.$_SERVER["SERVER_NAME"].Access::getSlugsById()['verify'].'?email='.$email.'?token='.$token.'';

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
    public static function sendMailPassword($email,$token)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = GUSER;                              // SMTP username
            $mail->Password = GPWD;                               // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom('tosle.contact@gmail.com', 'Tosle Contact');
            $mail->addAddress($email);     // Add a recipient
            $mail->addReplyTo('tosle.contact@gmail.com');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Welcome to the CMS TOSLE ';
            //$mail->Body = 'Veuillez confirmer votre inscription en cliquant sur le lien ci-dessous </br>http://localhost:88/en/verify-mail-register?token='.$token.'';
            $mail->Body = 'Please change your password on the link below</br>http://'.$_SERVER["SERVER_NAME"].Access::getSlugsById()['set-newpassword'].'?email='.$email.'&amp;token='.$token.'';

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        /////////////////////////////////////////////////
        ///
        /// /* /en/verify-mail-register?token=blablablablab

    }
public static function sendMailSignalement($data)
    {
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = GUSER;                              // SMTP username
            $mail->Password = GPWD;                               // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            //Recipients
            $mail->setFrom(GUSER, 'TOSLE CMS');
            $mail->addAddress(GUSER);
            $mail->addReplyTo(GUSER);
             // Add a recipient
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            $bodyMessage = 'A comment has been signaled, here is the information: <br><br>';
            $bodyMessage .= '<strong>Url of commentary : </strong>http://' .$data['url'].'<br>';
            $bodyMessage .= '<strong>Comment content: </strong>' .$data['content'].'<br>';
            $bodyMessage .= '<strong>Author of commentary : </strong>' .$data['user'].'<br>';
            $bodyMessage .= '<strong>Signaled by : </strong>' .$data['sendBy'].'<br>';
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = '[URGENT] - Signalement of a  commentary';
            //$mail->Body = 'Veuillez confirmer votre inscription en cliquant sur le lien ci-dessous </br>http://localhost:88/en/verify-mail-register?token='.$token.'';
            $mail->Body = $bodyMessage;
            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        /////////////////////////////////////////////////
        ///
        /// /* /en/verify-mail-register?token=blablablablab

    }
}