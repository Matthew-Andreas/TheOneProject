{source}

    <?php
    // Check if it's an AJAX request
    

    class myObject
     {
          public $result;
          public $results;
          public $db;
          public $query;
          public $columns;
          public $Space;  

          Public Function OpenDatabase($q)
          {
                $this->db = JFactory::getDbo();
                $this->query = $this->db->getQuery(true);
                $this->Space =  "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
                $this->query = $q;
                $this->db->setQuery($this->query);
                $this->result = $this->db->loadObjectList();
                $this->results = $this->db->loadAssocList();
                $this->columns = array_keys($this->results[0]);
           }


//==================================================================== 
           
            Public Function PrintHeader()
           {
                  
                         echo "<table>";
                         echo "<tr style=\"background-color:Blue;color:White\">";
                         foreach($this->columns as &$columnName)
                                       echo "<th>" . $columnName . $this->Space . $this->Space . $this->Space . "</th>";
                         echo "</tr>";
                         echo "</table>";
           }
//====================================================================            
            Public Function PrintData()
           {   
                    echo "<table>"; 
                      foreach ($this->result as &$row) 
                      {
                            echo "<tr>";
                            foreach($this->columns as &$columnName) 
                                        echo "<td>" . $row->$columnName . $this->Space .  "</td>";
                            echo "</tr>"; // Close out the row.
                      }        
                      echo "</table>"; // Close out the table at the end of the loop.
           }
//============================================================

        public function __construct($q) 
       {
             $this->OpenDatabase($q);
             $this->PrintHeader();
             $this->PrintData();
        }
//============================================================
     } // end of the class

//******************************************************************************************
// Main program starts in here
//******************************************************************************************
     //$T1 = new myObject ("Select Title, email, phoneNum, price, description from Resources ");

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
        if (isset($_POST['filters']) && is_array($_POST['filters'])) {
            
            /*foreach ($_POST['filters'] as $option) {
                echo "<li>" . htmlspecialchars($option) . "</li>";
            }*/
            $data = $_POST['filters'];
            if(in_array('Free',$data)&&in_array('Paid',$data)){
                $T1 = new myObject ("Select Title, email, phoneNum, price, description from Resources ");
            }elseif(in_array('Free',$data)){
                $T1 = new myObject ("Select Title, email, phoneNum, price, description from Resources where free = 1");
            }elseif(in_array('Paid',$data)){
                $T1 = new myObject ("Select Title, email, phoneNum, price, description from Resources where paid = 1");
            }else{
                $T1 = new myObject ("Select Title, email, phoneNum, price, description from Resources ");
            }
        } else {
            echo "<li>No filters selected.</li>";
            //$T1 = new myObject ("Select Title, email, phoneNum, price, description from Resources where free = 1");
        }
        exit();
    }else{
        //$T1 = new myObject ("Select Title, email, phoneNum, price, description from Resources where free = 1 ");
    }
?>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      display: flex;
  }

  .sidebar {
      width: 300px;
      padding: 15px;
      background-color: #f7f7f7;
      border-right: 1px solid #ccc;
      height: auto;
      box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
      position: hidden;
      left: 0;
      top: 303;
      overflow-y: auto;
      overflow-x: hidden;
      transition: 0.3s;
  }

  .sidebar h3 {
      margin-top: 0;
      margin-bottom: 25px;
  }

  .checkbox-container {
      display: block;
      position: relative;
      padding-left: 35px;
      margin-bottom: 12px;
      cursor: pointer;
      font-size: 18px;
      user-select: none;
  }

  .checkbox-container input {
      position: absolute;
      opacity: 0;
      cursor: pointer;
      height: 0;
      width: 0;
  }

  .checkmark {
      position: absolute;
      top: 0;
      left: 0;
      height: 25px;
      width: 25px;
      background-color: #eee;
      border: 1px solid #ccc;
  }

  .checkbox-container:hover input ~ .checkmark {
      background-color: #ccc;
  }

  .checkbox-container input:checked ~ .checkmark {
      background-color: #2196F3;
      border: none;
  }

  .checkmark:after {
      content: "";
      position: absolute;
      display: none;
  }

  .checkbox-container input:checked ~ .checkmark:after {
      display: block;
  }

  .checkbox-container .checkmark:after {
      left: 9px;
      top: 5px;
      width: 5px;
      height: 10px;
      border: solid white;
      border-width: 0 3px 3px 0;
      transform: rotate(45deg);
  }

  body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
  }

  .filter-option {
      margin-bottom: 20px;
  }

  .dropdown {
      margin-left: 20px;
      display: none;
  }

  .dropdown label {
      display: block;
      margin-bottom: 5px;
  }

  .grid-child.container-component{
      height:4500px;
  }

  .dropdown-content {
    overflow: hidden;
    transition: max-height 0.5s ease-out;
    max-height: 0;
  }

  .dropbox{
    transition: max-height 0.5s ease-out, opacity 0.5s ease-out;
  }

  .FilterTitleText{
      cursor: pointer;
      color:#000000;
      background-color: #f7f7f7;
      border: 0px;
      font-size: 22px;
      width: 250px;
      height: 50px;
      text-align: left;
      font-family: 'Montserrat';
      font-weight: bold;
  }
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }

  .sidebar {
    height: auto;
    width: 300px;
    position: absolute;
    top: 200px;
    left: -300px;
    background-color: #f7f7f7;
    overflow-x: hidden;
    transition: 0.6s;
    padding-top: 20px;
  }

  .sidebar a {
    padding: 10px 15px;
    text-decoration: none;
    font-size: 18px;
    color: #818181;
    display: block;
    transition: 0.6s;
    
  }

  .sidebar a:hover {
    color: #f1f1f1;
  }


  .open-sidebar .sidebar {
    left: 0;
  }

  .sidebar-button{
    position: absolute;
    top: 200px;
    left: 20px;
    transform: translateX(-100%);
    width: 20px;
    height: var(--matched-height);
    background-color: #eaeaea;
    /*display: inline-block;*/
    justify-content: center;  /* Center horizontally */
    align-items: center;      /* Center vertically */
    transition: 0.6s;
    border: 0;
    color: #203A72;
  }
  .open-sidebar .sidebar-button{
    left: 300px;
    transform: translateX(0);
  }

  .selected{
    position: absolute;
    top: 200px;
    left: 100px;
    transition: 0.6s;
  }

  .open-sidebar .selected{
    left: 400px;
  }
  </style>
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
                    <input type="checkbox" name="filters[]" value="Local North County" onclick="updateFilters()">
                    <span class="checkmark"></span>
                </label>
                <label class="checkbox-container">Local San Deigo
                    <input type="checkbox" name="filters[]" value="Local San Deigo" onclick="updateFilters()">
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
    <di class="selected">
    <h1>Database:</h1>
        <ul id="selected-filters">
            <!-- Selected filters will be displayed here -->
        </ul>
    </div>
  <script>
    document.getElementById("sidebar-button").onclick = function() {
      document.body.classList.toggle("open-sidebar");
    }
    function toggleDropdown(dropboxNum,dropdownContentNum) {
        var dropdownContent = document.getElementById(dropdownContentNum);
        /*var dropbox = document.getElementById(dropboxNum);*/
        var sidebarButton = document.getElementById('sidebar-button');

        /*if (dropbox.classList.contains("expand")) {*/
        if(dropdownContent.classList.contains("expand")){
            /*dropdownContent.style.display = "none";*/
            /*dropbox.classList.remove("expand");*/
            dropdownContent.classList.remove("expand");
            dropdownContent.style.maxHeight = null;
            sidebarButton.classList.remove("expand");
            document.documentElement.style.setProperty('--matched-height',(sidebarButton.clientHeight-dropdownContent.scrollHeight) + "px");
        } else {
            /*dropdownContent.style.display = "block";*/
            /*dropbox.classList.add("expand");*/
            dropdownContent.classList.add("expand");
            dropdownContent.style.maxHeight = dropdownContent.scrollHeight + "px";
            sidebarButton.classList.add("expand");
            document.documentElement.style.setProperty('--matched-height',(sidebarButton.clientHeight+dropdownContent.scrollHeight) + "px");
        }
       
    }

    document.addEventListener('DOMContentLoaded', () => {
        for (let i = 1; i <= 9; i++) {
            const checkbox = document.getElementById(`main-checkbox${i}`);
            const dropdown = document.getElementById(`dropdown${i}`);
            var dropdownContent = document.getElementById('dropdown-content7');

            checkbox.addEventListener('change', () => {
              dropdown.style.display = checkbox.checked ? 'block' : 'none';
                    if (checkbox.checked) {
                        dropdown.classList.add('expand');
                        dropdown.style.maxHeight = null;
                        dropdownContent.style.maxHeight = (dropdownContent.scrollHeight+ dropdown.scrollHeight)+ "px";
                    } else {
                        dropdown.classList.remove('expand');
                        dropdown.style.maxHeight = 0;
                        dropdownContent.style.maxHeight = (dropdownContent.scrollHeight-dropdown.scrollHeight)+ "px";
                    }
                });
        }
        
    });

    function matchHeights(){
      var sidebar = document.getElementById('mySidebar');
      var sidebarButton = document.getElementById('sidebar-button');
      var maxHeight = sidebar.clientHeight;
      document.documentElement.style.setProperty('--matched-height',maxHeight + 'px')
    }

    function updateFilters() {
        var checkboxes = document.querySelectorAll('input[name="filters[]"]:checked');
        var values = [];
        checkboxes.forEach((checkbox) => {
            values.push(checkbox.value);
        });

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("selected-filters").innerHTML = xhr.responseText;
                
            }
        };
        xhr.send("ajax=1&filters[]=" + values.join("&filters[]="));
    }

    window.onload = matchHeights;
    window.onresize = matchHeights;

  </script>
{/source}