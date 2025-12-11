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

abstract class ContactUs{
    //status signifies if the process is successful(true) or failed(false)
    protected bool $status = true;

    public function getStatus(){
        return $this->status;
    }

    protected function saveData(string $table, array $columnNames, array $values){
        try{
            $db = Factory::getDbo();

            $query = $db->getQuery(true);

            //Getting the date and time for the form submission
            date_default_timezone_set("America/Los_Angeles");
            $now = date("Y-m-d H:i:s");

            //Adding the date and time to the query
            $columnNames[] = "CreatedAt";
            $values[] = $now;

            $values = array_map([$db, 'quote'], $values);

            $query
                ->insert($db->quoteName($table))
                ->columns($db->quoteName($columnNames))
                ->values(implode(',', $values));

            $db->setQuery($query);
            $db->execute();
        }catch(Exception $e){
            $this->status = false;
        }
    }

    protected function textSanitization(string $text): string{
        return htmlspecialchars(strip_tags(trim($text)));
    }

    protected function emailValidation(string $email): string{
        $mEmail = filter_var(trim($email),FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->status = false;
            return "";
        }
        return $mEmail;
    }


}

class ContactUsForm extends ContactUs{
    public function __construct(string $table, array $columns, string $name, string $email, string $message){
        $mName = $this->textSanitization($name);
        $mEmail = $this->emailValidation($email);
        $mMessage = $this->textSanitization($message);
        $values = [$mName, $mEmail, $mMessage];
        $this->saveData($table, $columns, $values);
    }
}

class ReportAnErrorForm extends ContactUs{
    public function __construct(string $table, array $columns, string $name, string $email, string $resourceName, string $checkError, string $message){
        $mName = $this->textSanitization($name);
        $mEmail = $this->emailValidation($email);
        $mResourceName = $this->textSanitization($resourceName);
        $mCheckError = $this->textSanitization($checkError);
        $mMessage = $this->textSanitization($message);
        $values = [$mName, $mEmail, $mResourceName, $mCheckError, $mMessage];
        $this->saveData($table, $columns, $values);
    }
}

class AddAResourceForm extends ContactUs{

    private function urlSanitization(string $url): string{
        $newUrl = trim($url);

        if(!filter_var($newUrl,FILTER_VALIDATE_URL)){
            $this->status = false;
            return "https://onehubsd.org/contact-us/add-a-resource-to-database";
        }

        return $newUrl;
    }

    public function __construct(string $table, array $columns, string $name, string $email, string $resourceName, string $resourceUrl, string $resourceDescription, string $FoP, string $Geo, string $Ind, string $SoB, string $EnDe, string $ToRH, string $ToR, string $ToB){
        $mName = $this->textSanitization($name);
        $mEmail = $this->emailValidation($email);
        $mResourceName = $this->textSanitization($resourceName);
        $mResourceUrl = $this->urlSanitization($resourceUrl);
        $mResourceDescription = $this->textSanitization($resourceDescription);
        $mFoP = $this->textSanitization($FoP);
        $mGeo = $this->textSanitization($Geo);
        $mInd = $this->textSanitization($Ind);
        $mSoB = $this->textSanitization($SoB);
        $mEnDe = $this->textSanitization($EnDe);
        $mToRH = $this->textSanitization($ToRH);
        $mToR = $this->textSanitization($ToR);
        $mToB = $this->textSanitization($ToB);
        $values = [$mName, $mEmail, $mResourceName,$mResourceDescription, $mResourceUrl,$mGeo, $mToRH, $mToR, $mFoP,  $mEnDe,  $mSoB, $mInd, $mToB];
        $this->saveData($table, $columns, $values);
    }
}


