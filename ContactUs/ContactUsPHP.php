<?php

// Only define constants if not already defined
$directCall = false;
if (!defined('_JEXEC')) {
    $directCall = true;
    define('_JEXEC', 1);
    define('JPATH_BASE', dirname(__FILE__, 7)); // adjust if needed
    require_once JPATH_BASE . '/includes/defines.php';
    require_once JPATH_BASE . '/includes/framework.php';
}

use Joomla\CMS\Factory;

include_once JPATH_BASE . '/media/templates/site/cassiopeia/CustomCode/ContactUs/ContactFormPHP.php';

header('Content-Type: application/json');

try{
    $name = $_POST['name'] ?? '';
    $email = $_POST['email']?? '';
    $message = $_POST['message']?? '';
    if (!$name || !$email || !$message) {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        exit;
    }else{
       $contactForm = new ContactUsForm('ContactUsResponses', ['FullName', 'Email', 'UserMessage'], $name, $email, $message);
        if($contactForm->getStatus()){
            echo json_encode(['success' => true, 'message' => 'Message received!']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Server error.']);
        }
    }
}catch(Exception $e){
    echo json_encode(['success'=> false, 'message' => 'Server error: '.$e->getMessage()]);
}