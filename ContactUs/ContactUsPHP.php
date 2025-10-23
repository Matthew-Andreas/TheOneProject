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

header('Content-Type: application/json');

abstract class ContactUs{

    abstract protected function saveData(string $table, array $columns, array $values);

    protected function textSanitization(string $text): string{
        return htmlspecialchars(strip_tags(trim($text)));
    }

    protected function emailValidation(string $email): string{
        $mEmail = filter_var(trim($email),FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
            exit;
        }
        return $mEmail;
    }
}

class ContactUsForm extends ContactUs{
    protected function saveData(string $table, array $columns, array $values){
        try{
            $db = Factory::getDbo();
            $query = $db->getQuery(true);

            $values = array_map([$db, 'quote'], $values);

            $query
                ->insert($db->quoteName($table))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));

            $db->setQuery($query);
            $db->execute();
            
            echo json_encode(['success' => true, 'message' => 'Message received!']);
        }catch(Exception $e){
            echo json_encode(['success' => false, 'message' => 'Server error.']);
        }
    }

    public function __construct(string $table, array $columns, string $name, string $email, string $message){
        $mName = $this->textSanitization($name);
        $mEmail = $this->emailValidation($email);
        $mMessage = $this->textSanitization($message);
        $values = [$mName, $mEmail, $mMessage];
        $this->saveData($table, $columns, $values);
    }
}


try{
    $name = $_POST['name'] ?? '';
    $email = $_POST['email']?? '';
    $message = $_POST['message']?? '';
    if (!$name || !$email || !$message) {
        echo json_encode(['success' => false, 'message' => 'Invalid input.']);
        exit;
    }else{
        $contactForm = new ContactUsForm('ContactUsResponses', ['FullName', 'Email', 'UserMessage'], $name, $email, $message);
    }
}catch(Exception $e){
    echo json_encode(['success'=> false, 'message' => 'Server error: '.$e->getMessage()]);
}


/*$data = json_decode(file_get_contents("php://input"),true);

if($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($data['name'], $data['email'], $data['message'])){
    echo json_encode(['success'=> false,'message' => 'Invalid input.']);
    exit;
}else if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $contactForm = new ContactUsForm('ContactUsResponses', ['FullName', 'Email', 'UserMessage'],$data['name'], $data['email'], $data['message']);
}
*/

