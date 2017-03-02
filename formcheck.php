<?php
require_once('PHPMailer-master/class.phpmailer.php');
try {
    // Undefined | Multiple Files | $_FILES Corruption Attack
    // If this request falls under any of them, treat it invalid.
    if (
        !isset($_FILES['upfile']['error']) ||
        is_array($_FILES['upfile']['error'])
    ) {
        echo "1";
        print_r($_POST);
        print_r($_FILES);
        print_r($_FILES['upfile']);
        throw new RuntimeException('Invalid parameters.');
    }

    // Check $_FILES['upfile']['error'] value.
    switch ($_FILES['upfile']['error']) {
        case UPLOAD_ERR_OK:
            break;
        case UPLOAD_ERR_NO_FILE:
            throw new RuntimeException('No file sent.');
        case UPLOAD_ERR_INI_SIZE:
        case UPLOAD_ERR_FORM_SIZE:
            echo "2";
            throw new RuntimeException('Exceeded filesize limit.');
        default:
            echo "3";
            throw new RuntimeException('Unknown errors.');
    }

    // You should also check filesize here.
    if ($_FILES['upfile']['size'] > 1000000) {
        echo "4";
        throw new RuntimeException('Exceeded filesize limit.');
    }

    // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
    // Check MIME Type by yourself.
//    $finfo = new finfo(FILEINFO_MIME_TYPE);
//    if (false === $ext = array_search(
//            $finfo->file($_FILES['upfile']['tmp_name']),
//            array(
//                'pdf' => 'application/pdf',
//            ),
//            true
//        )
//    ) {
//        echo "5";
//        throw new RuntimeException('Invalid file format.');
//    }
//
//    // You should name it uniquely.
//    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
//    // On this example, obtain safe unique name from its binary data.
//    if (!move_uploaded_file(
//        $_FILES['upfile']['tmp_name'],
//        sprintf('./uploads/%s.%s',
//            sha1_file($_FILES['upfile']['tmp_name']),
//            $ext
//        )
//    )
//    )
//    {
//        echo "6";
//        throw new RuntimeException('Failed to move uploaded file.');
//    }

    $input=array();

    foreach($_POST as $key => $value)
        $input[$key] = htmlspecialchars(strip_tags($value));

    if (empty($_POST['submittedtitle']))
        $input['submittedtitle'] = '';
    if (empty($_POST['submittedfio']))
        $input['submittedfio'] = '';
    if (empty($_POST['submittedyear']))
        $input['submittedyear'] = '';
    if (empty($_POST['VKR[]']))
        $input['VKR[]'] = '';
    if (empty($_POST['submittedcurator']))
        $input['submittedcurator'] = '';
    if (empty($_POST['institutes[]']))
        $input['institutes[]'] = '';
    if (empty($_POST['submittedkod']))
        $input['submittedkod'] = '';
    if (empty($_POST['submittedpages']))
        $input['submittedpages'] = '';
    if (empty($_POST['submittedvash_email']))
        $input['submittedvash_email'] = '';

    $message = 'ФИО: ' . $input['submittedfio'] . "\r\n" .
        'email: ' . $input['submittedvash_email'] . "\r\n" .
        'Вопрос: ' . wordwrap($input['submittedvopros'], 70, "\r\n") .
        "\r\n";

    $message = wordwrap($message, 70, "\r\n");
    $message = str_replace("\n.", "\n..", $message);
//
    $email = new PHPMailer();
    $email->From      = 'you@example.com';
    $email->FromName  = 'Your Name';
    $email->Subject   = 'Message Subject';
    $email->Body      = $message;
    $email->AddAddress( 'destinationaddress@example.com' );
    $email->AddAddress( 'destinationaddress@example.com' );

    $file_to_attach = 'PATH_OF_YOUR_FILE_HERE';

    $email->AddAttachment( $file_to_attach , 'NameOfFile.pdf' );

    $email->Send();
//
    $config = require_once('config.php');

    $from = 'From: ' . $config['mailFrom'];
    $mailTo = $config['mailTo'];

    if (mail($mailTo, $input['topic'], $message, $from))
        echo "mail sent";
    else
        echo "mail wasn't sent";

} catch (RuntimeException $e) {

    echo $e->getMessage();

}

?>