<?php

use Joomla\CMS\Factory;

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"),true);

if(!isset($data['name'], $data['email'], $data['message'])){
    echo json_encode(['success'=> false,'message' => 'Invalid input.']);
    exit;
}

$name = htmlspecialchars(strip_tags(trim($data['name'])));
$email = filter_var(trim($data['email']),FILTER_SANITIZE_EMAIL);
$message = htmlspecialchars(strip_tags(trim($data['message'])));

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

try{

    $db = Factory::getDbo();
    /*$query = $db->getQuery(true);

    /*$columns = ['FullName', 'Email', 'UserMessage'];
    $values  = [$db->quote($name), $db->quote($email), $db->quote($message)];

    $query
        ->insert($db->quoteName('ContactUsResponses'))
        ->columns($db->quoteName($columns))
        ->values(implode(',', $values));

    $db->setQuery($query);
    $db->execute();*/

    echo json_encode(['success' => true, 'message' => 'Message received!']);
}catch(Exception $e){
    echo json_encode(['success' => false, 'message' => 'Server error.']);
}

