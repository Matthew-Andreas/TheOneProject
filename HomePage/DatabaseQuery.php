<?php
class DatabaseQuery{
    public $isWhere = false;
    public $oldGroup = "";
    public $isdifferent = false;
    public $isAny = false; 
    public $isToR = false;
    public $extraParen =false;
    public $whereData = [];
    public $selectData = [];
    public $queryStatement = "Select Name_of_Organization, Website, Description";
    public $checkBoxValues = ["Free" => "Free_or_Paid","Paid" => "Free_or_Paid",
                                "AnyG" => "Geography","Local_North_County" => "Geography", "Local_San_Diego" => "Geography", "California" => "Geography", "National" => "Geography", "International" => "Geography",
                                "AnySt" => "Stage_of_Business", "Ideation" => "Stage_of_Business", "Seeding" => "Stage_of_Business", "Establishing" => "Stage_of_Business", "Growing" => "Stage_of_Business", "Selling_Exiting" => "Stage_of_Business",
                                //"AnyT" => "Type_of_Business", "Microenterprise" => "Type_of_Business", "Innovation_Tech" => "Type_of_Business", "Main_Street" => "Type_of_Business", "Medium_Large_Business" => "Type_of_Business", "Pop_Ups_Vendors" => "Type_of_Business",
                                //"AnyI" => "Industry", "Tech_Industry" => "Industry", "NonProfit_Social_Sector" => "Industry", "Agricultural_Sector" => "Industry", "Consumer_Goods_Retail" => "Industry", "Entertainment" => "Industry", "Other_Industry" => "Industry",
                                "AnySe" => "Sector","Veteran" => "Sector", "Women" => "Sector", "People_With_Disabilities" => "Sector", "Multicultural" => "Sector", "Black" => "Sector", "Asian" => "Sector", "Latin_X" => "Sector", "Immigrants" => "Sector", "Under_Privileged" => "Sector", "LGBTQ" => "Sector", "Veteran_Women" => "Sector", "Student" => "Sector",
                                "AnyTop" => "Topic_of_Resource_Header","Funding" => "Topic_of_Resource_Header", "Funding_Venture_Capital" => "Topic_of_Resource", "Private_Equity_Firms" => "Topic_of_Resource", "Funding_Angel" => "Topic_of_Resource", "Grant" => "Topic_of_Resource", "Loans" => "Topic_of_Resource", "Crowdfunding" => "Topic_of_Resource", "Microcredit/Microloans" => "Topic_of_Resource", "Other_Funding" => "Topic_of_Resource", 
                                "Financial_Information" => "Topic_of_Resource_Header", "Investment_Advisor" => "Topic_of_Resource", "Education_FL_BP_BC" => "Topic_of_Resource", "Wealth_Managment" => "Topic_of_Resource", "Accounting_Assistance" => "Topic_of_Resource", "Banking" => "Topic_of_Resource", 
                                "Network" => "Topic_of_Resource_Header", "Meetups" => "Topic_of_Resource", "Networking" => "Topic_of_Resource", 
                                "Incubator_Accelerator" => "Topic_of_Resource_Header", "Accelerator" => "Topic_of_Resource", "Incubator" => "Topic_of_Resource", 
                                "Mentorship" => "Topic_of_Resource_Header", "Mentoring" => "Topic_of_Resource", "Startup_Advisor" => "Topic_of_Resource", "Business_Counseling" => "Topic_of_Resource", 
                                "Educational_Training" => "Topic_of_Resource_Header", "Training" => "Topic_of_Resource", "Article" => "Topic_of_Resource", "Education" => "Topic_of_Resource", 
                                "Tech_Assistance" => "Topic_of_Resource_Header", "Tech_Help" => "Topic_of_Resource", "Project_Managment_Software" => "Topic_of_Resource", "Website_Assistance" => "Topic_of_Resource", "Software" => "Topic_of_Resource", "Mobile_n_Web_App_Development" => "Topic_of_Resource", "Mobile_Form_Development" => "Topic_of_Resource", "Cyber_Security" => "Topic_of_Resource", "Website_Builder" => "Topic_of_Resource", "Software_Development" => "Topic_of_Resource", 
                                "General_Business_Assistance" => "Topic_of_Resource_Header", "Mental_Health" => "Topic_of_Resource", "Hiring_Assistance" => "Topic_of_Resource", "Work_Space" => "Topic_of_Resource", "CRO" => "Topic_of_Resource", "Insurance" => "Topic_of_Resource", "General_Business_Assistance_Services" => "Topic_of_Resource", "Marketing" => "Topic_of_Resource", "Supply_Chain" => "Topic_of_Resource", "Consulting" => "Topic_of_Resource", "Commercialization_and_Marketplaces" => "Topic_of_Resource", "Certification" => "Topic_of_Resource", 
                                "Legal_Assistance" => "Topic_of_Resource_Header", "General_Legal_Assistance" => "Topic_of_Resource", "Legal_Assistance_IP_TM_P" => "Topic_of_Resource", "Legal_Assistance_Legal_Formation"
                            ];

    public function __construct($filters,$selected, $allColumns){
        $this->whereData = $filters;
        $this->selectData = $selected;
        $this->addSelect($allColumns);
        $this->whereSetUp();
    }

    public function getQueryStatement(){
        return $this->queryStatement;
    }

    public function addSelect($allColumns){
        //foreach($this->selectData as $selected){
        //    $this->queryStatement .= "," . $selected;
        //}
        if($allColumns == "true"){
            $this->queryStatement .= ", Free_or_Paid, Geography, Stage_of_Business, Sector, Topic_of_Resource";//", Address, Geography, Topic_of_Resource, Free_or_Paid, Sector, Stage_of_Business";
        }
        $this->queryStatement .= " from Resources ";
    }

    public function addWhere($addition){
        if(!($this->isWhere)){
            $this->queryStatement .= "where (";
        }elseif($this->isdifferent){
            $this->queryStatement .= ") AND (";
        }elseif($this->isToR){
            $this->queryStatement .= ")) OR (";
        }
        else{
            $this->queryStatement .= " OR ";
        }
        $this->queryStatement .= $addition;

    }

    public function whereSetUp(){
        foreach($this->checkBoxValues as $value => $group){
            if(in_array($value,$this->whereData)){
                if($value == "AnyTop"){
                    break;
                }
                
                $addition = "";
                if(!($this->isWhere)){
                    echo"Here2";
                    if($this->oldGroup != $group){
                        $this->isAny = false;
                    }
                    if($value == "AnyG"||$value == "AnySt"||$value == "AnyI"||$value == "AnySe"||$value == "AnyT"){
                        $this->isAny = True;
                    }
                    $this->oldGroup = $group;
                    if((0==strcasecmp($group, "Sector"))||(0==strcasecmp($group, "Type_of_Business"))||(0==strcasecmp($group, "Industry"))){
                        $addition = $group . " LIKE '%Any%' OR ";
                    }
                }elseif($this->oldGroup != $group){
                    echo"Here3";
                    $this->isAny = false;
                    if($value == "AnyG"||$value == "AnySt"||$value == "AnyI"||$value == "AnySe"||$value == "AnyT"){
                        $this->isAny = True;
                    }
                    $this->isdifferent = true;
                    if(0==strcasecmp($this->oldGroup, "Topic_of_Resource")){
                        $this->isdifferent = false;
                        $this->isToR = true;
                    }elseif((0==strcasecmp($group, "Sector"))||(0==strcasecmp($group, "Type_of_Business"))||(0==strcasecmp($group, "Industry"))){
                        $addition = $group . " LIKE '%Any%' OR ";
                    }
                    //echo "23";
                    $this->oldGroup = $group;
                }elseif(0==strcasecmp($this->oldGroup, "Topic_of_Resource_Header")){
                    $this->isToR = true;
                }

                if(0==strcasecmp($group, "Topic_of_Resource_Header")&&(!(0==strcasecmp($this->oldGroup,"Topic_of_Resource")))){
                    //echo "here";
                    $addition = "(";
                    $this->extraParen = true;
                }

                if(!($this->isAny)){
                    echo"Here1";
                    $this->addWhere($addition . $group . " LIKE '%" . $value . "%'");
                    $this->isWhere = True;
                }

                echo $this->isAny;
                $this->isdifferent = false;
                $this->isToR = false;
            }
        }
        if($this->isWhere){
            $this->queryStatement .= ")";
        }
        if($this->extraParen){
            $this->queryStatement .=")";
        }
        echo $this->queryStatement;
    }


};
?>