<?php
class DatabaseQuery{
    public $isWhere = false;
    public $oldGroup = "";
    public $isdifferent = false;
    public $whereData = [];
    public $selectData = [];
    public $queryStatement = "Select Title, email, phoneNum";
    public $checkBoxValues = ["Free" => "FoP","Paid" => "FoP","localNorthCounty" => "Geo", "localSanDeigo" => "Geo", "California" => "Geo", "National" => "Geo", "International" => "Geo"];

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