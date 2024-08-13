{source}
<!DOCTYPE html>

    <head>
    <jdoc:include type="head" />
    <link rel="stylesheet" href="media/templates/site/cassiopeia/CustomCode/HomePage/HomeCSS.css" type="text/css" />
    </head>
    <body>

        <?php
            include_once JPATH_BASE . '/media/templates/site/cassiopeia/CustomCode/HomePage/DatabaseTable.php';
            include_once JPATH_BASE . '/media/templates/site/cassiopeia/CustomCode/HomePage/DatabaseQuery.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
                $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
                $select = isset($_POST['select']) ? $_POST['select'] : [];
        
                $Q1 = new DatabaseQuery($filters, $select);
        
                $T1 = new DatabaseTable($Q1->getQueryStatement());
                exit();
            }
        ?>

        <div class="filters">
        <button class="AllFiltersButton sidebar-button">All Filters</button>
            <p class="showText">Show in search:</p>
            <div class="selectCheckboxes">
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" value="Website" onclick="updateFilters()"> Website
                    <span class="checkmarkSelect"></span>
                </label>
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" value="Geography" onclick="updateFilters()"> Geography
                    <span class="checkmarkSelect"></span>
                </label>
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" value="Topic_of_Resource" onclick="updateFilters()"> Topic of Resource
                    <span class="checkmarkSelect"></span>
                </label>
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" value="Free_or_Paid" onclick="updateFilters()"> Free or Paid
                    <span class="checkmarkSelect"></span>
                </label>
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" value="Sector" onclick="updateFilters()"> Sector
                    <span class="checkmarkSelect"></span>
                </label>
                <label class="checkbox-containerSelect">
                    <input type="checkbox" name="select[]" value="Stage_of_Business" onclick="updateFilters()"> Stage of Business
                    <span class="checkmarkSelect"></span>
                </label>
            </div>
        </div>
        <div>

        </div>
        <div class="Database">
            <div class="selected">
                <h1>Database Test:</h1>
                <div id="selected-filters">
                    <?php
                        $T1 = new DatabaseTable("Select Name_of_Organization, Address, Description from Resources");
                    ?>
                </div>
            </div>
        </div>

        <div class="overlay"></div>


    <div class="sidebar" id="mySidebar">
    <div style="display: flex;">
        <p class="filterTitle">All Filters</p>
        <img src="images/Exit-X.png#joomlaImage://local-images/Exit-X.png?width=75&height=74"  class="sidebar-button Exit">
    </div>
    
    <div class="dropbox" id="dropbox">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Free or Paid</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow FoP" onclick="toggleDropdown('dropbox','dropdown-content')" >
        </div>
            <form method="post">
                <div class="dropdown-content" id="dropdown-content">
                    <label class="checkbox-container">
                        <input type="checkbox" name="filters[]" value="Free" onclick="updateFilters()">
                        <span class="checkmark"></span>
                        Free
                    </label>
                    <label class="checkbox-container bottom">
                        <input type="checkbox" name="filters[]" value="Paid" onclick="updateFilters()">
                        <span class="checkmark"></span>
                        Paid
                    </label>
                </div>
            </form>
      </div>
    <div class="dropbox" id="dropbox2">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Geography</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow Geo" onclick="toggleDropdown('dropbox2','dropdown-content2')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content2">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Local_North_County" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Local North County
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Local_San_Deigo" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Local San Deigo
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="California" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    California
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="National" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    National
                </label>
                <label class="checkbox-container bottom">
                    <input type="checkbox" name="filters[]" value="International" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    International
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox3">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Stage of Business</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow SoB" onclick="toggleDropdown('dropbox3','dropdown-content3')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content3">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Ideation" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Ideation
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Seeding" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Seeding
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Establishing" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Establishing
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Growing" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Growing
                </label>
                <label class="checkbox-container bottom">
                    <input type="checkbox" name="filters[]" value="Selling_Exiting" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Selling/Exiting
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox4">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Type of Business</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow ToB" onclick="toggleDropdown('dropbox4','dropdown-content4')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content4">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Microenterprise" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Microenterprise
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Innovation_Tech" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Innovation/tech
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Main_Street" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Main Street
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Medium_Large_Business" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Medium/Large Business
                </label>
                <label class="checkbox-container bottom">
                    <input type="checkbox" name="filters[]" value="Pop_Ups_Venders" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Pop Ups/Venders
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox5">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Industry</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow Ind" onclick="toggleDropdown('dropbox5','dropdown-content5')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content5">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Tech_Industry" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Tech Industry
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="NonProfit_Social_Sector" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Non-profit social sector
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Agricultural_Sector" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Agricultural sector
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Consumer_Goods_Retail" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Consumer goods/retail
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Entertainment" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Entertainment
                </label>
                <label class="checkbox-container bottom">
                    <input type="checkbox" name="filters[]" value="Other_Indusrty" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Other Indusrty
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox6">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Sector</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow Sec" onclick="toggleDropdown('dropbox6','dropdown-content6')" >
        </div>
        <form method="post">
            <div class="dropdown-content" id="dropdown-content6">
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Veteran" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Veteran
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Women" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Women
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="People_With_Disabilities" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    People with Disabilities
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Multicultural" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Multicultural
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Black" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Black
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Asian" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Asian
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Latin_X" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Latin X
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Immigrants" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Immigrants
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Under_Privileged" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Under privileged (low income)
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="LGBTQ" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    LGBTQ+
                </label>
                <label class="checkbox-container">
                    <input type="checkbox" name="filters[]" value="Veteran_Women" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Veteran Women
                </label>
                <label class="checkbox-container bottom">
                    <input type="checkbox" name="filters[]" value="Student" onclick="updateFilters()">
                    <span class="checkmark"></span>
                    Student
                </label>
            </div>
        </form>
    </div>
    <div class="dropbox" id="dropbox7">
        <div class="FilterTitleText" style="display: flex;">
            <p style="margin:0; white-space:nowrap;">Type of Resources</p>
            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow ToR" onclick="toggleDropdown('dropbox7','dropdown-content7')" >
        </div>
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

    </body>
    <script src="media/templates/site/cassiopeia/CustomCode/HomePage/HomeJS.js" type="text/javascript"></script>
</html>
{/source}