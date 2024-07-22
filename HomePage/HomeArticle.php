{source}
<!DOCTYPE html>

<head>
  <jdoc:include type="head" />
  <link rel="stylesheet" href="media/templates/site/cassiopeia/CustomCode/HomePage/HomeCSS.css" type="text/css" />
</head>
<body>
<?php
    include_once JPATH_BASE . '/media/templates/site/cassiopeia/CustomCode/HomePage/HomePHP.php';

    class DatabaseQuery{
        private $isWhere = false;
        private $oldGroup = "";
        private $isdifferent = false;
        private $data = [];
        private $queryStatement = "";
        private $checkBoxValues = ["Free" => "FoP","Paid" => "FoP","localNorthCounty" => "Geo", "localSanDeigo" => "Geo", "California" => "Geo", "National" => "Geo", "International" => "Geo"];

        public function __construct(){
            $this->queryStatement = "Select Title, email, phoneNum, price, description from Resources ";
        }

        public function __construct($mData){
            $this->data = $mData;
            whereSetUp();
        }

        public function getQueryStatement(){
            return $this->queryStatement;
        }

        private function addWhere($addition){
            $queryStatement = $this->queryStatement;
            if(!$this->isWhere){
                $queryStatement .= "where (";
            }elseif($this->isdifferent){
                $queryStatement .= ") AND (";
            }else{
                $queryStatement .= " OR ";
            }
            $queryStatement .= $addition;
            $this->queryStatement = $queryStatement;
        }

        private function whereSetUp(){
            foreach($this->checkBoxValues as $value => $group){
                if(in_array($value,$data)){
                    if(!$this->isWhere){
                        $this->oldGroup = $group;
                    }elseif($this->oldGroup != $group){
                        $this->isdifferent = true;
                        $this->oldGroup = $group;
                    }
                    addWhere(($value . " = 1"));
                    $this->isWhere = True;
                    $this->isdifferent = false;
                }
            }
            if($this->isWhere){
                $this->queryStatement .= ")";
            }
        }


    }


    
    /*$isWhere = false;
    $oldGroup = "";
    $isdifferent = false;
    $data = [];
    $queryStatement = "Select Title, email, phoneNum, price, description from Resources ";

    function addWhere($addition, $queryStatement, $isWhere, $isdifferent){
        if(!$isWhere){
            $queryStatement .= "where (";
        }elseif($isdifferent){
            $queryStatement .= ") AND (";
        }else{
            $queryStatement .= " OR ";
        }
        $queryStatement .= $addition;
        return $queryStatement;
    }


    $checkBoxValues = ["Free" => "FoP","Paid" => "FoP","localNorthCounty" => "Geo", "localSanDeigo" => "Geo", "California" => "Geo", "National" => "Geo", "International" => "Geo"];*/
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
        if (isset($_POST['filters']) && is_array($_POST['filters'])) {
            
            $data = $_POST['filters'];

            /*$hasFilter = false;
            foreach($checkBoxValues as $value => $group){
                if(in_array($value,$data)){
                    if(!$isWhere){
                        $oldGroup = $group;
                    }elseif($oldGroup != $group){
                        $isdifferent = true;
                        $oldGroup = $group;
                    }
                    $queryStatement = addWhere(($value . " = 1"), $queryStatement, $isWhere, $isdifferent);
                    $isWhere = True;
                    $isdifferent = false;
                    $hasFilter = true;
                }
            }
            if($hasFilter){
                $queryStatement .= ")";
            }*/
            $Q1 = new DatabaseQuery($data);

            //$T1 = new DatabaseTable($queryStatement);
            $T1 = new DatabaseTable($Q1->getQueryStatement());

        }
        exit();
    }


?>
 
    <button class="sidebar-button" id="sidebar-button">
    >
  </button>
  <div class="sidebar" id="mySidebar">
 
  <h3>Filter Options</h3>
      <div class="dropbox" id="dropbox">
          <button class="FilterTitleText" onclick="toggleDropdown('dropbox','dropdown-content')" >
              Free or Paid
          </button>
            <form method="post">
                <div class="dropdown-content" id="dropdown-content">
                    <label class="checkbox-container">Free
                        <input type="checkbox" name="filters[]" value="Free" onclick="updateFilters()">
                        <span class="checkmark"></span>
                    </label>
                    <label class="checkbox-container">Paid
                        <input type="checkbox" name="filters[]" value="Paid" onclick="updateFilters()">
                        <span class="checkmark"></span>
                    </label>
                </div>
            </form>
      </div>
      <div class="dropbox" id="dropbox2">
        <button class="FilterTitleText" onclick="toggleDropdown('dropbox2','dropdown-content2')">
            Geography
        </button>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content2">
                <label class="checkbox-container">Local North County
                    <input type="checkbox" name="filters[]" value="localNorthCounty" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Local San Deigo
                    <input type="checkbox" name="filters[]" value="localSanDeigo" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">California
                    <input type="checkbox" name="filters[]" value="California" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">National
                    <input type="checkbox" name="filters[]" value="National" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">International
                    <input type="checkbox" name="filters[]" value="International" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox3">
        <button class="FilterTitleText" onclick="toggleDropdown('dropbox3','dropdown-content3')">Stage of business</button>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content3">
                <label class="checkbox-container">Ideation
                    <input type="checkbox" name="filters[]" value="Ideation" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Seeding
                    <input type="checkbox" name="filters[]" value="Seeding" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Establishing
                    <input type="checkbox" name="filters[]" value="Establishing" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Growing
                    <input type="checkbox" name="filters[]" value="Growing" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Selling/exiting
                    <input type="checkbox" name="filters[]" value="Selling/exiting" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox4">
        <button class="FilterTitleText" onclick="toggleDropdown('dropbox4','dropdown-content4')">Type of business</button>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content4">
                <label class="checkbox-container">Microenterprise
                    <input type="checkbox" name="filters[]" value="Microenterprise" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Innovation/tech
                    <input type="checkbox" name="filters[]" value="Innovation/tech" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Main Street
                    <input type="checkbox" name="filters[]" value="Main Street" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Medium/Large Business
                    <input type="checkbox" name="filters[]" value="Medium/Large Business" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Pop Ups/Venders
                    <input type="checkbox" name="filters[]" value="Pop Ups/Venders" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox5">
        <button class="FilterTitleText" onclick="toggleDropdown('dropbox5','dropdown-content5')">Indusrty</button>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content5">
                <label class="checkbox-container">Tech Industry
                    <input type="checkbox" name="filters[]" value="Tech Industry" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Non-profit social sector
                    <input type="checkbox" name="filters[]" value="Non-profit social sector" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Agricultural sector
                    <input type="checkbox" name="filters[]" value="Agricultural sector" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Consumer goods/retail
                    <input type="checkbox" name="filters[]" value="Consumer goods/retail" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Entertainment
                    <input type="checkbox" name="filters[]" value="Entertainment" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Other Indusrty
                    <input type="checkbox" name="filters[]" value="Other Indusrty" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox6">
        <button class="FilterTitleText" onclick="toggleDropdown('dropbox6','dropdown-content6')">Sector</button>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content6">
                <label class="checkbox-container">Veteran
                    <input type="checkbox" name="filters[]" value="Veteran" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Women
                    <input type="checkbox" name="filters[]" value="Women" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">People with Disabilities
                    <input type="checkbox" name="filters[]" value="People with Disabilities" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Multicultural
                    <input type="checkbox" name="filters[]" value="Multicultural" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Black
                    <input type="checkbox" name="filters[]" value="Black" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Asian
                    <input type="checkbox" name="filters[]" value="Asian" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Latin X
                    <input type="checkbox" name="filters[]" value="Latin X" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Immigrants
                    <input type="checkbox" name="filters[]" value="Immigrants" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Under privileged (low income)
                    <input type="checkbox" name="filters[]" value="Under privileged (low income)" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">LGBTQ+
                    <input type="checkbox" name="filters[]" value="LGBTQ+" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Veteran Women
                    <input type="checkbox" name="filters[]" value="Veteran Women" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Student
                    <input type="checkbox" name="filters[]" value="Student" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox7">
        <button class="FilterTitleText" onclick="toggleDropdown('dropbox7','dropdown-content7')">Type of Resources</button>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content7">
                <div class="filter-option">
                <label class="checkbox-container" >
                    <input type="checkbox" id="main-checkbox1" name="filters[]" value="funding" onclick="updateFilters()">
                    Funding
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown1">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Funding Venture Capital" onclick="updateFilters()"> Funding Venture Capital
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Private Equity Firms" onclick="updateFilters()"> Private Equity Firms
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Funding Angel" onclick="updateFilters()"> Funding Angel
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Funding Grants" onclick="updateFilters()"> Funding Grants
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Funding Loans" onclick="updateFilters()"> Funding Loans
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Crowfunding" onclick="updateFilters()"> Crowfunding
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Microcredit/Mircoloans" onclick="updateFilters()"> Microcredit/Mircoloans 
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Other funding" onclick="updateFilters()"> Other funding
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox2" name="filters[]" value="Financial Information" onclick="updateFilters()">
                    Financial Information
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown2">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Investment Advisor" onclick="updateFilters()"> Investment Advisor
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Education: Financial Literacy, Business Plans, Business Cards" onclick="updateFilters()"> Education: Financial Literacy, Business Plans, Business Cards
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Wealth Managment" onclick="updateFilters()"> Wealth Managment
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Accounting Assitance" onclick="updateFilters()"> Accounting Assitance
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Banking" onclick="updateFilters()"> Banking
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox3" name="filters[]" value="Networking" onclick="updateFilters()">
                    Networking
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown3">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Meetups" onclick="updateFilters()"> Meetups
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Networking" onclick="updateFilters()"> Networking
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox4" name="filters[]" value="Incubator/Accelerator" onclick="updateFilters()">
                    Incubator/Accelerator
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown4">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Accelerator" onclick="updateFilters()"> Accelerator
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Incubator" onclick="updateFilters()"> Incubator
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox5" name="filters[]" value="Mentorship" onclick="updateFilters()">
                    Mentorship
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown5">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Mentoring" onclick="updateFilters()"> Mentoring
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Startup Advisor" onclick="updateFilters()"> Startup Advisor
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Business Counseling" onclick="updateFilters()"> Business Counseling
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox6" name="filters[]" value="Educational/Training" onclick="updateFilters()">
                    Educational/Training
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown6">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Training" onclick="updateFilters()"> Training
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Article" onclick="updateFilters()"> Article
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Education" onclick="updateFilters()"> Education
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox7" name="filters[]" value="Tech Assitance" onclick="updateFilters()">
                    Tech Assitance
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown7">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Tech Help" onclick="updateFilters()"> Tech Help
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Project Management Software" onclick="updateFilters()"> Project Management Software
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Website Assitance" onclick="updateFilters()"> Website Assitance
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Software" onclick="updateFilters()"> Software
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Mobile & Web App Development" onclick="updateFilters()"> Mobile & Web App Development
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Mobile Form Development" onclick="updateFilters()"> Mobile Form Development
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Cyber Security" onclick="updateFilters()"> Cyber Security
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Website Builder" onclick="updateFilters()"> Website Builder
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Software Development" onclick="updateFilters()"> Software Development
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox8" name="filters[]" value="General Business Assitance" onclick="updateFilters()">
                    General Business Assitance
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown8">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Mental Health" onclick="updateFilters()"> Mental Health
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Hiring Assitance" onclick="updateFilters()"> Hiring Assitance
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Work Space" onclick="updateFilters()"> Work Space
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="CRO" onclick="updateFilters()"> CRO
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Insurance" onclick="updateFilters()"> Insurance
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="General Business Assitance/Services" onclick="updateFilters()"> General Business Assitance/Services
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Marketing" onclick="updateFilters()"> Marketing
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Supply Chain" onclick="updateFilters()"> Supply Chain
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Consulting" onclick="updateFilters()"> Consulting
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Commercialization and Marketplaces" onclick="updateFilters()"> Commercialization and Marketplaces
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Certification" onclick="updateFilters()"> Certification
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
                <div class="filter-option">
                <label class="checkbox-container">
                    <input type="checkbox" id="main-checkbox9" name="filters[]" value="Legal Assitance" onclick="updateFilters()">
                    Legal Assitance
                    <span class="checkmark"></span>
                </label>
                <div class="dropdown" id="dropdown9">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="General Legal Assitance" onclick="updateFilters()"> General Legal Assitance
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Legal Assitance: Intelectual property, Trade marks, Patents" onclick="updateFilters()"> Legal Assitance: Intelectual property, Trade marks, Patents
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Legal Assitance: Legal Formation" onclick="updateFilters()"> Legal Assitance: Legal Formation
                    <span class="checkmark"></span>
                </label>
                </div>
                </div>
            </div>
        </form>
    </div>
    
    </div>

    

    <div class="selected">
        <h1>Database Test:</h1>
        <ul id="selected-filters">
            <?php
                
                $T1 = new DatabaseTable($queryStatement);
            ?>
        </ul>
    </div>
</body>
<script src="media/templates/site/cassiopeia/CustomCode/HomePage/HomeJS.js" type="text/javascript"></script>
</html>
{/source}
