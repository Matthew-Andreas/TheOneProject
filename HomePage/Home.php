{source}
<!DOCTYPE html>

    <head>
    <jdoc:include type="head" />
    <link rel="stylesheet" href="media/templates/site/cassiopeia/CustomCode/HomePage/HomeCSS.css?v=1.0.10" type="text/css" />
    </head>
    <body>

        <?php
            include_once JPATH_BASE . '/media/templates/site/cassiopeia/CustomCode/HomePage/DatabaseTable.php';
            include_once JPATH_BASE . '/media/templates/site/cassiopeia/CustomCode/HomePage/DatabaseQuery.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
                $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
                $select = isset($_POST['select']) ? $_POST['select'] : [];
                $itemLimit = isset($_POST['itemLimit']) ? (int)$_POST['itemLimit'] : 10; // Default to 10 items per page
                $allColumns = isset($_POST['allColumns']) ? $_POST['allColumns'] : 12; // Default to 10 items per page

                // Create the database query based on the filters and selection
                $Q1 = new DatabaseQuery($filters, $select, $allColumns);

                // Determine the current page for pagination
                $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        
                $T1 = new DatabaseTable($Q1->getQueryStatement(), $page, $itemLimit);
                exit();
            }
        ?>
        <div class="page">
            <div  class="sidebar"  id="mySidebar"> 
                <div style="display: flex;">
                    <p class="filterTitle">All Filters</p>
                </div>
                <div class="dropbox" id="dropbox">
                    <div class="FilterTitleText" style="display: flex;" onclick="toggleDropdown('FilterArrow FoP','dropdown-content')">
                        <p style="margin:0;">Free or Paid</p>
                        <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow FoP"  id="FilterArrow FoP">
                    </div>
                        <form method="post">
                            <div class="dropdown-content" id="dropdown-content">
                                <label class="checkbox-container">
                                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Free" value="Free">
                                    <span class="checkmark"></span>
                                    Free
                                </label>
                                <label class="checkbox-container bottom">
                                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Paid" value="Paid">
                                    <span class="checkmark"></span>
                                    Paid
                                </label>
                            </div>
                        </form>
                </div>
                <div class="dropbox" id="dropbox2">
                    <div class="FilterTitleText" style="display: flex;" onclick="toggleDropdown('FilterArrow Geo','dropdown-content2')" >
                        <p style="margin:0; ">Geography</p>
                        <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow Geo" id="FilterArrow Geo">
                    </div>
                    <form method="post">
                        <div class="dropdown-content" id="dropdown-content2">
                            <!--<label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Local_North_County" value="AnyG">
                                <span class="checkmark"></span>
                                Any
                            </label>-->
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Local_North_County" value="Local: North County">
                                <span class="checkmark"></span>
                                Local North County
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Local_San_Diego" value="Local: San Diego">
                                <span class="checkmark"></span>
                                Local San Deigo
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="California" value="California">
                                <span class="checkmark"></span>
                                California
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="National" value="National">
                                <span class="checkmark"></span>
                                National
                            </label>
                            <label class="checkbox-container bottom">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="International" value="International">
                                <span class="checkmark"></span>
                                International
                            </label>
                        </div>
                    </form>
                </div>
                <div class="dropbox" id="dropbox5">
                    <div class="FilterTitleText" style="display: flex;" onclick="toggleDropdown('FilterArrow Ind','dropdown-content5')">
                        <p style="margin:0; ">Industry</p>
                        <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow Ind" id="FilterArrow Ind" >
                    </div>
                    <form method="post">
                        <div class="dropdown-content" id="dropdown-content5">
                            <!--<label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Local_North_County" value="AnyI">
                                <span class="checkmark"></span>
                                Any
                            </label>-->
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Agricultural_Sector" value="Agricultural">
                                <span class="checkmark"></span>
                                Agricultural Sector
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Consumer_Goods_Retail" value="Consumer_Goods/_Retail">
                                <span class="checkmark"></span>
                                Consumer Goods/Retail
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Entertainment" value="Entertainment">
                                <span class="checkmark"></span>
                                Entertainment
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Government_Sector" value="Government_Sector">
                                <span class="checkmark"></span>
                                Government Sector
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="NonProfit_Social_Sector" value="Non-Profit_Social_Sector">
                                <span class="checkmark"></span>
                                Non-Profit Social Sector
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Tech_Industry" value="Tech_Industry">
                                <span class="checkmark"></span>
                                Tech Industry
                            </label>
                            <label class="checkbox-container bottom">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Other_Industry" value="Other_Industry">
                                <span class="checkmark"></span>
                                Other Industry
                            </label>
                        </div>
                    </form>
                </div>
                <div class="dropbox" id="dropbox3">
                    <div class="FilterTitleText" style="display: flex;" onclick="toggleDropdown('FilterArrow SoB','dropdown-content3')">
                        <p style="margin:0; ">Stage of Business</p>
                        <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow SoB" id="FilterArrow SoB">
                    </div>
                    <form method="post">
                        <div class="dropdown-content" id="dropdown-content3">
                            <!--<label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Local_North_County" value="AnySt">
                                <span class="checkmark"></span>
                                Any
                            </label>-->
                            <label class="checkbox-container hover-filter">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Establishing" value="Establishing">
                                <span class="checkmark"></span>
                                Establishing
                                <div class="hover-Content" >Business started, selling, reached owners expected income - could be income enough for them to sustain themselves or what
                                they were expecting to generate as a side job</div>
                            </label>
                            <label class="checkbox-container hover-filter">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Growing" value="Growing">
                                <span class="checkmark"></span>
                                Growing
                                <div class="hover-Content" >Business is established and generates income for entrepreneur to sustain themselves, entrepreneur is trying to grow their business</div>
                            </label>
                            <label class="checkbox-container hover-filter">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Ideation" value="Ideation">
                                <span class="checkmark"></span>
                                Ideation
                                <div class="hover-Content" >Entrepreneur has an idea, is trying to implement</div>
                            </label>
                            <label class="checkbox-container hover-filter">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Seeding" value="Seeding">
                                <span class="checkmark"></span>
                                Seeding
                                <div class="hover-Content" >Business started, selling a bit, still some trial and error in what to do</div>
                            </label>
                            <label class="checkbox-container bottom hover-filter">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Selling_Exiting" value="Selling_Exiting">
                                <span class="checkmark"></span>
                                Selling/Exiting
                                <div class="hover-Content" >Business owner decided either to close the business or sell</div>
                            </label>
                        </div>
                    </form>
                </div>
                <div class="dropbox" id="dropbox6">
                    <div class="FilterTitleText" style="display: flex;" onclick="toggleDropdown('FilterArrow Sec','dropdown-content6')">
                        <p style="margin:0; ">Entrepreneur Demographics</p>
                        <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow Sec" id="FilterArrow Sec">
                    </div>
                    <form method="post">
                        <div class="dropdown-content" id="dropdown-content6">
                            <!--<label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Local_North_County" value="AnySe">
                                <span class="checkmark"></span>
                                Any
                            </label>-->
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Asian" value="Asian">
                                <span class="checkmark"></span>
                                Asian
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Black" value="Black">
                                <span class="checkmark"></span>
                                Black
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Immigrants" value="Immigrants">
                                <span class="checkmark"></span>
                                Immigrants
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Indigenous_People" value="Indigenous_People">
                                <span class="checkmark"></span>
                                Indigenous People
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Latinx" value="Latinx">
                                <span class="checkmark"></span>
                                Latinx
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="LGBTQ" value="LGBTQ">
                                <span class="checkmark"></span>
                                LGBTQ+
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Low_Income" value="Low_Income">
                                <span class="checkmark"></span>
                                Low Income
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Multicultural" value="Multicultural">
                                <span class="checkmark"></span>
                                Multicultural/BIPOC
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="People_With_Disabilities" value="People_With_Disabilities">
                                <span class="checkmark"></span>
                                People With Disabilities
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Previously_Incarcerated" value="Previously_Incarcerated">
                                <span class="checkmark"></span>
                                Previously Incarcerated
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Student" value="Student">
                                <span class="checkmark"></span>
                                Student
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Undocumented_People" value="Undocumented_People">
                                <span class="checkmark"></span>
                                Undocumented People
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Veteran" value="Veteran">
                                <span class="checkmark"></span>
                                Veteran
                            </label>
                            <label class="checkbox-container">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Woman_Veterans" value="Woman_Veterans">
                                <span class="checkmark"></span>
                                Woman Veterans
                            </label>
                            <label class="checkbox-container bottom">
                                <input type="checkbox" name="filters[]" class="checkbox-item" id="Women" value="Women">
                                <span class="checkmark"></span>
                                Women
                            </label>
                            
                        </div>
                    </form>
                </div>
                <div class="dropbox" id="dropbox7">
                    <div class="FilterTitleText" style="display: flex;" onclick="toggleDropdown('FilterArrow ToR','dropdown-content7')" >
                        <p style="margin:0; ">Topic of Resources</p>
                        <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow ToR" id="FilterArrow ToR">
                    </div>
                    <form method="post">
                        <div class="dropdown-content" id="dropdown-content7">
                            <div class="filter-option">
                                <!--<label class="checkbox-container">
                                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Local_North_County" value="AnyTop">
                                    <span class="checkmark"></span>
                                    Any
                                </label>-->
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" id="main-checkbox6" name="filters[]" class="checkbox-item" id="Educational_Training" value="Educational_Training">
                                    Educational/Training
                                    <span class="checkmark"></span>
                                    <div class="hover-Content" >Resources such as workshops, educational programs, degrees,books, articles, where entrepreneurs can learn more about entrepreneurship</div>
                                </label>
                                <div class="dropdown" id="dropdown6">
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Article" value="Article"> Article
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >An article for people to read</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Education" value="Education"> Education
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that works to provide business education opportunities to entrepreneurs</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Training" value="Training"> Training
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company that provides training in a certain field</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Podcast" value="Podcast"> Podcast
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A Podcast for people to listen to</div>
                                    </label>
                                </div>
                            </div>
                            <div class="filter-option">
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" id="main-checkbox2" name="filters[]" class="checkbox-item" id="Financial_Information" value="Financial_Information">
                                    Financial Information
                                    <span class="checkmark"></span>
                                    <div class="hover-Content" >Resources that provides you with general information about finances and banking organization</div>
                                </label>
                                <div class="dropdown" id="dropdown2">
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Accounting_Assistance" value="Accounting_Assistance"> Accounting Assistance
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that helps startups with accounting</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Banking" value="Banking"> Banking
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A bank that provides banking services for startups</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Education_FL_BP_BC" value="Education: Financial Literacy, Business Plans, Business Cards"> Education: Financial Literacy, Business Plans, Business Cards
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >Education in these specific fields</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Investment_Advisor" value="Investment_Advisor"> Investment Advisor
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A person or company that provides advise about securities to their clients</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Wealth_Managment" value="Wealth_Management"> Wealth Management
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >Wealth management or wealth management advisory is an investment advisory service that provides financial management and wealth advisory services to a wide array of clients ranging from affluent to high-net-worth and ultra-high-net-worth indviduals and families</div>
                                    </label>
                                </div>
                            </div>
                            <div class="filter-option">
                                <label class="checkbox-container hover-filter" >
                                    <input type="checkbox" id="main-checkbox1" name="filters[]" class="checkbox-item" id="Funding" value="Funding">
                                    Funding
                                    <span class="checkmark"></span>
                                    <div class="hover-Content" >Resources regarding where to find funds or grants to your business or organization</div>
                                </label>
                                <div class="dropdown" id="dropdown1">
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Crowfunding" value="Crowdfunding"> Crowdfunding
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >The practice of funding a project or venture by raising many small amounts on money from a large number of people, typically via the internet</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Funding_Angel" value="Funding_Angel"> Funding Angel
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >An investment form someone that seeks equity in return</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Funding_Grants" value="Grant"> Funding Grants
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A grant is an amount of money given to a person that does not need to be paid back</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Funding_Loans" value="Loans"> Funding Loans
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A loan is an amount of money given out that need to be paid back</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Funding_Venture_Capital" value="Funding_Venture_Capital"> Funding Venture Capital
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A sum of money investors commit for investment in early-stage companies</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Microcredit_Microloans" value="Microcredit/Microloans"> Microcredit/Microloans 
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >The lending of small amounts of money at low interest to new businesses</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Private_Equity_Firms" value="Private_Equity_Firms"> Private Equity Firms
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A private equity firm is an investment management company that provides financial backing and makes investments in private
                                        equity of startup or operating companies through a variety of loosly affiliated investment strategies including leveraged buyout, venture capital, and
                                        growth capital</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Other_Funding" value="Other_Funding"> Other Funding
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >Any other type of funding not included in the other categories</div>
                                    </label>
                                </div>
                            </div>
                            <div class="filter-option">
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" id="main-checkbox8" name="filters[]" class="checkbox-item" id="General_Business_Assistance" value="General_Business_Assistance">
                                    General Business Assistance
                                    <span class="checkmark"></span>
                                    <div class="hover-Content" >Resources about different aspects of a business such as marketing, human
                                    resources, and supply chain tools and services; certifications for businesses; places to commercialize your
                                    products/services; insurances; etc</div>
                                </label>
                                <div class="dropdown" id="dropdown8">
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Certification" value="Certification"> Certification
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A credential that an organization/individual can earn to verify legitmacy and competence in a subject</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Commercialization_and_Marketplaces" value="Commercialization_and_Marketplaces"> Commercialization And Marketplaces
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >Spaces or organizations that help entrepreneurs sell products/services (i.e. farmers markets, popup events, online marketplace, etc)</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Consulting" value="Consulting"> Consulting
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A person who advises on how to modify, proceed in, or streamline a given process within a specialized field</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="CRO" value="CRO"> CRO
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A contract research organization is a company that provides support to the pharmaceutical, biotechnology, and medical device industries in the
                                        form of research services outsourced on a contract basis</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="General_Business_Assistance_Services" value="General_Business_Assistance_Services"> General Business Assistance/Services
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company/individual that will help entrepreneurs wwith general business services</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Hiring_Assistance" value="Hiring_Assistance"> Hiring Assistance
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that helps startups hire employees</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Insurance" value="Insurance"> Insurance
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >Insurance programs for startups</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Marketing" value="Marketing"> Marketing
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that provides marketing services</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Mental_Health" value="Mental_Health"> Mental Health
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A resource that helps entrepreneurs with keeping positive mental health</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Supply_Chain" value="Supply_Chain"> Supply Chain
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that helps businesses with figuring out their supply chain</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Work_Space" value="Work_Space"> Work Space
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A space where people can work on their startup</div>
                                    </label>                                
                                </div>
                            </div>
                            <div class="filter-option">
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" id="main-checkbox4" name="filters[]" class="checkbox-item" id="Incubator_Accelerator" value="Incubator_Accelerator">
                                    Incubator/Accelerator
                                    <span class="checkmark"></span>
                                    <div class="hover-Content" >Information about different incubator and acceleerator programs</div>
                                </label>
                                <div class="dropdown" id="dropdown4">
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Accelerator" value="Accelerator"> Accelerator
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A program focused on supporting a business from the early-stages of development and providing resources for them</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Incubator" value="Incubator"> Incubator
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A startup incubator is a collaborative program for start up companies -- usually physically located in one central workspace -- designed to
                                        help startups in their infancy succeed by providing workspace, seed funding, mentoring and training</div>
                                    </label>
                                </div>
                            </div>
                            <div class="filter-option">
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" id="main-checkbox9" name="filters[]" class="checkbox-item" id="Legal_Assistance" value="Legal_Assistance">
                                    Legal Assistance
                                    <span class="checkmark"></span>
                                    <div class="hover-Content" >Any help related with legal matters in a business/nonprofit</div>
                                </label>
                                <div class="dropdown" id="dropdown9">
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="General_Legal_Assistance" value="General_Legal_Assistance"> General Legal Assistance
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >Legal assistance in general areas of business such as labor, taxes, contracts, etc</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Legal_Assistance_IP_TM_P" value="Legal_Assistance_IP_TM_P"> Legal Assistance: Intelectual Property, Trade Marks, Patents
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >Legal assistance regarding the name of the business (snd it is taken or not), trademarking, intellectual property</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Legal_Assistance_Legal_Formation" value="Legal_Assistance_Legal_Formation"> Legal Assistance: Legal Formation
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >Legal assistance regarding how to formalize your business, which type of company you should formalize, etc</div>
                                    </label>
                                </div>
                            </div>
                            <div class="filter-option">
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" id="main-checkbox5" name="filters[]" class="checkbox-item" id="Mentorship" value="Mentorship">
                                    Mentorship
                                    <span class="checkmark"></span>
                                    <div class="hover-Content" >Resources where you can connect with mentors that can help you launch or develop your orgranization</div>
                                </label>
                                <div class="dropdown" id="dropdown5">
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Business_Counseling" value="Business_Counseling"> Business Counseling
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >One-on-one or group counceling services with prospective business owners tohelp guide them towards their goal</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Mentoring" value="Mentoring"> Mentoring
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company that provides a person or group of people to provide guidance to a startup</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Startup_Advisor" value="Startup_Advisor"> Startup Advisor
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A startup advisor is a specialist with training and experience in a certain sector or industry who provides advice, mentoring, and
                                        networking opportunities to startup founders to help startups in their infancy succeed by providing workspace, seed funding, mentoring and training</div>
                                    </label>
                                </div>
                            </div>
                            <div class="filter-option">
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" id="main-checkbox3" name="filters[]" class="checkbox-item" id="Network" value="Network">
                                    Networking
                                    <span class="checkmark"></span>
                                    <div class="hover-Content" >Places and events that allow entrepreneurs to network with other entrepreneurs as well as
                                    funders, universities, clients, etc</div>
                                </label>
                                <div class="dropdown" id="dropdown3">
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Meetups" value="Meetups"> Meetups
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >Gatherings where people can meet others interested in the same field or topic</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Networking" value="Networking"> Networking
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that helps people create connections and build relationships with one another</div>
                                </label>
                                </div>
                            </div>
                            <div class="filter-option">
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" id="main-checkbox7" name="filters[]" class="checkbox-item" id="Tech_Assistance" value="Tech_Assistance">
                                    Technological Assistance
                                    <span class="checkmark"></span>
                                    <div class="hover-Content" >Resources about different companies, softwares, and apps that can be useful for businesses</div>
                                </label>
                                <div class="dropdown" id="dropdown7">
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Cyber_Security" value="Cyber_Security"> Cyber Security
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that works to help digitaly secure a business</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Mobile_n_Web_App_Development" value="Mobile_&_Web_App_Development"> Mobile & Web App Development
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that helps develop mobile or web apps for a startup</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Mobile_Form_Development" value="Mobile_Form_Development"> Mobile Form Development
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that helps develop mobile apps for a startup</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Project_Management_Software" value="Project_Management_Software"> Project Management Software
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >Software that helps a startup with project management</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Software" value="Software"> Software
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A software that is helpful for entrepreneurs</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Software_Development" value="Software_Development"> Software Development
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company that will develop software for your business</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Tech_Assistance" value="Tech_Help"> Technological Help
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that provides general technological assistance to entrepreneurs</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Website_Assistance" value="Website_Assistance"> Website Assistance
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A company or service that helps startups with creating or fixing their website</div>
                                    </label>
                                    <label class="checkbox-container hover-filter">
                                        <input type="checkbox" name="filters[]" class="checkbox-item" id="Website_Builder" value="Website_Builder"> Website Builder
                                        <span class="checkmark"></span>
                                        <div class="hover-Content" >A software where you can build your own website</div>
                                    </label>
                                    
                                </div>
                            </div>
                            
                            
                        </div>
                        
                    </form>
                </div>
                <div class="dropbox" id="dropbox4">
                        <div class="FilterTitleText" style="display: flex;" onclick="toggleDropdown('FilterArrow ToB','dropdown-content4')" >
                            <p style="margin:0; ">Type of Business</p>
                            <img src="images/Filter-bluearrow.png#joomlaImage://local-images/Filter-bluearrow.png?width=75&height=74" class="FilterArrow ToB" id="FilterArrow ToB">
                        </div>
                        <form method="post">
                            <div class="dropdown-content" id="dropdown-content4">
                                <!--<label class="checkbox-container">
                                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Local_North_County" value="AnyT">
                                    <span class="checkmark"></span>
                                    Any
                                </label>-->
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Innovation_Tech" value="Innovation_Tech">
                                    <span class="checkmark"></span>
                                    Innovation/Tech
                                    <div class="hover-Content" >High growth business, focused on innovation and/or tech</div>
                                </label>
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Main_Street" value="Main_Street">
                                    <span class="checkmark"></span>
                                    Main Street
                                    <div class="hover-Content" >Business that have a brick and mortar location and have more than 2 employees that are not family members</div>
                                </label>
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Medium_Large_Business" value="Medium_Large_Business">
                                    <span class="checkmark"></span>
                                    Medium/Large Business
                                    <div class="hover-Content" >Business that are a medium/large size - more than 5 employees</div>
                                </label>
                                <label class="checkbox-container hover-filter">
                                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Microenterprise" value="Microenterprise">
                                    <span class="checkmark"></span>
                                    Microenterprise
                                    <div class="hover-Content" >Small business that has no brick and mortar location, does not have more than 2 employees that are not family members</div>
                                </label>
                                <label class="checkbox-container bottom hover-filter">
                                    <input type="checkbox" name="filters[]" class="checkbox-item" id="Pop_Ups_Venders" value="Pop_Ups_Vendors">
                                    <span class="checkmark"></span>
                                    Pop Ups/Vendors
                                    <div class="hover-Content" >Business does popups (sells their products in framers markets and other places but at specific dates)</div>
                                </label>
                            </div>
                        </form>
                    </div>
            
            </div>
            <div class="TableAndBtn">
                <div class="filtersAndPagination">
                    <button class="column-button" id="columnBtn" onclick="setColumns()">Show More Columns</button>
                    <button class="reset-button" id="resetBtn" onclick="resetFilters()">Reset Filters</button>
                    <!--<div class="filters">
                        <p class="showText">Show in search:</p>
                        <div class="selectCheckboxes">
                            <label class="checkbox-containerSelect">
                                <input type="checkbox" name="select[]" class="checkbox-item" id="Website" value="Address" onclick="updateFilters()"> Address
                                <span class="checkmarkSelect"></span>
                            </label>
                            <label class="checkbox-containerSelect">
                                <input type="checkbox" name="select[]" class="checkbox-item" id="Geography" value="Geography" onclick="updateFilters()"> Geography
                                <span class="checkmarkSelect"></span>
                            </label>
                            <label class="checkbox-containerSelect">
                                <input type="checkbox" name="select[]" class="checkbox-item" id="Topic_of_Resource" value="Topic_of_Resource" onclick="updateFilters()"> Topic of Resource
                                <span class="checkmarkSelect"></span>
                            </label>
                            <label class="checkbox-containerSelect">
                                <input type="checkbox" name="select[]" class="checkbox-item" id="Free_or_Paid" value="Free_or_Paid" onclick="updateFilters()"> Free or Paid
                                <span class="checkmarkSelect"></span>
                            </label>
                            <label class="checkbox-containerSelect">
                                <input type="checkbox" name="select[]" class="checkbox-item" id="Sector" value="Sector" onclick="updateFilters()"> Entrepreneur Demographics
                                <span class="checkmarkSelect"></span>
                            </label>
                            <label class="checkbox-containerSelect">
                                <input type="checkbox" name="select[]" class="checkbox-item" id="Stage_of_Business" value="Stage_of_Business" onclick="updateFilters()"> Stage of Business
                                <span class="checkmarkSelect"></span>
                            </label>
                        </div>
                    </div>-->
                    <div class="paginationChanger">
                        <p>Number of Resources per page:</p>
                        <input type="radio" id="10" name="pagination" value="10" onclick="updateFilters()" checked>
                        <label for="10">10</label>
                        <input type="radio" id="25" name="pagination" value="25" onclick="updateFilters()">
                        <label for="25">25</label>
                        <input type="radio" id="50" name="pagination" value="50" onclick="updateFilters()">
                        <label for="50">50</label>
                    </div>
                </div>

                <div class="Database">
                    <div class="selected">
                        <div class="tableContainer" id="selected-filters">
                            <?php
                                $T1 = new DatabaseTable("Select Name_of_Organization, Description, Website from Resources",1, 10);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="popup" class="popup">Tooltip outside the hover div!</div>
    </body>
    <script src="media/templates/site/cassiopeia/CustomCode/HomePage/HomeJS.js?v=1.0.4" type="text/javascript"></script>
</html>
{/source}