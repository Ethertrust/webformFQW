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

    foreach($_POST as $key => $value) {

        if($key == 'VKR' || $key =='institutes')
        {
            if (empty($_POST[$key]))
                $input[$key] = '';
            else
                $input[$key] = htmlspecialchars(strip_tags($_POST[$key]));
        }
        else
        {
            if (empty($_POST[$key]))
                $input[$key] = '';
            else
                $input[$key] = htmlspecialchars(strip_tags($value));
        }
    }

//    print_r($_POST);
//    print_r($input);
//    print_r($_FILES);
//    print_r($_FILES['upfile']);

    $message = 'Заглавие работы: ' . $input['submittedtitle'] . "\r\n" .
        'ФИО: ' . $input['submittedfio'] . "\r\n" .
        'Год написания: ' . $input['submittedyear'] . "\r\n" .
        'Форма ВКР: ' . $input['VKR']. "\r\n" .
        'Кураторы:' . "\r\n";
    foreach($input as $key => $value)
    {
//      print_r(strpos($key, "submittedcurator"));
        if(strpos($key, "submittedcurator") !== false)
        {
            $message = $message . ' ' . $value . "\r\n";
        }
    }
    $message = $message . 'Институт: ' . $input['institutes'] . "\r\n" .
        'Код направления: ' . $input['submittedkod'] . "\r\n" .
        'Количество страниц: ' . $input['submittedpages'] . "\r\n" .
        'Email: ' . $input['submittedvash_email'] . "\r\n";

//    $message = wordwrap($message, 70, "\r\n");
    $message = str_replace("\n.", "\n..", $message);

    $config = require_once('config.php');
    $mailTo1 = $config['mailTo'];
    $mailTo2 = $input['submittedvash_email'];
//
    $email = new PHPMailer();
    $email->CharSet = 'UTF-8';
    $email->From      = $input['submittedvash_email'];
    $email->FromName  = $input['submittedvash_email'];
    $email->Subject   = 'VKR';
    $email->Body      = $message;
    $email->AddAddress( $mailTo1 );
    $email->AddAddress( $mailTo2 );

    $file_to_attach = $_FILES['upfile']['tmp_name'];

    $email->AddAttachment( $file_to_attach , $_FILES['upfile']['name'] );
//
    if ($email->Send())
        echo "mail sent";
    else
        echo "mail wasn't sent";

} catch (RuntimeException $e) {

    echo $e->getMessage();

}

?>