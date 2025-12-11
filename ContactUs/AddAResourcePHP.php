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
    $resourceName = $_POST['resourceName']??'';
    $resourceUrl = $_POST['resourceUrl']??'';
    $resourceDescription = $_POST['resourceDescription']??'';
    $FoP = $_POST['FoP']?? '';
    $Geo = $_POST['Geo']?? '';
    $Ind = $_POST['Ind']?? '';
    $SoB = $_POST['SoB']?? '';
    $EnDe = $_POST['EnDe']?? '';
    $ToRH = $_POST['ToRH']?? '';
    $ToR = $_POST['ToR']?? '';
    $ToB = $_POST['ToB']?? '';
    if (!$name || !$email || !$resourceName||!$resourceUrl||!$resourceDescription||!$FoP||!$Geo||!$Ind||!$SoB||!$EnDe||!$ToRH||!$ToR||!$ToB) {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        exit;
    }else{
        $contactForm = new AddAResourceForm('UserResources', ['FullName', 'Email', 'Name_of_Organization','Description','Website','Geography', 'Topic_of_Resource_Header','Topic_of_Resource','Free_or_Paid','Entrepreneur_Demographics','Stage_of_Business','Industry','Type_of_Business'], $name, $email, $resourceName, $resourceUrl,$resourceDescription,$FoP, $Geo, $Ind, $SoB, $EnDe, $ToRH, $ToR, $ToB);
        if($contactForm->getStatus()){
            echo json_encode(['success' => true, 'message' => 'Message received!']);
        }else{
            echo json_encode(['success' => false, 'message' => 'Server error.']);
        }
    }
}catch(Exception $e){
    echo json_encode(['success'=> false, 'message' => 'Server error: '.$e->getMessage()]);
}