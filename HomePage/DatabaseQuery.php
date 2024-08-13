<?php
class DatabaseQuery{
    public $isWhere = false;
    public $oldGroup = "";
    public $isdifferent = false;
    public $whereData = [];
    public $selectData = [];
    public $queryStatement = "Select Name_of_organization, address, description";
    public $checkBoxValues = ["Free" => "FoP","Paid" => "FoP",
                                "Local_North_County" => "Geo", "Local_San_Deigo" => "Geo", "California" => "Geo", "National" => "Geo", "International" => "Geo",
                                "Ideation" => "SoB", "Seeding" => "SoB", "Establishing" => "SoB", "Growing" => "SoB", "Selling_Exiting" => "SoB",
                                "Microenterprise" => "ToB", "Innovation_Tech" => "ToB", "Main_Street" => "ToB", "Medium_Large_Business" => "ToB", "Pop_Ups_Vendors" => "ToB",
                                "Tech_Industry" => "Ind", "NonProfit_Social_Sector" => "Ind", "Agricultural_Sector" => "Ind", "Consumer_Goods_Retail" => "Ind", "Entertainment" => "Ind", "Other_Industry" => "Ind",
                                "Veteran" => "Sec", "Women" => "Sec", "People_With_Disabilities" => "Sec", "Multicultural" => "Sec", "Black" => "Sec", "Asian" => "Sec", "Latin_X" => "Sec", "Immigrants" => "Sec", "Under_Privileged" => "Sec", "LGBTQ" => "Sec", "Veteran_Women" => "Sec", "Student" => "Sec"  
                            ];

    public function __construct($filters,$selected){
        $this->whereData = $filters;
        $this->selectData = $selected;
        $this->addSelect();
        $this->whereSetUp();
    }

    public function getQueryStatement(){
        return $this->queryStatement;
    }

    public function addSelect(){
        foreach($this->selectData as $selected){
            $this->queryStatement .= "," . $selected;
        }
        $this->queryStatement .= " from Resources ";
    }

    public function addWhere($addition){
        if(!($this->isWhere)){
            $this->queryStatement .= "where (";
        }elseif($this->isdifferent){
            $this->queryStatement .= ") AND (";
        }else{
            $this->queryStatement .= " OR ";
        }
        $this->queryStatement .= $addition;
    }

    public function whereSetUp(){
        foreach($this->checkBoxValues as $value => $group){
            if(in_array($value,$this->whereData)){
                if(!($this->isWhere)){
                    $this->oldGroup = $group;
                }elseif($this->oldGroup != $group){
                    $this->isdifferent = true;
                    $this->oldGroup = $group;
                }
                $this->addWhere($value . " = 1");
                $this->isWhere = True;
                $this->isdifferent = false;
            }
        }
        if($this->isWhere){
            $this->queryStatement .= ")";
        }
    }


};
?>