const targets = document.querySelectorAll('.hover-filter');
const popup = document.getElementById('popup');

targets.forEach(target => {
    target.addEventListener('mouseenter', (e) => {
        const rect = target.getBoundingClientRect();
        const text = target.querySelector(".hover-Content").textContent;
        popup.style.left = rect.left + rect.width / 2 + "px";
        popup.style.top = rect.top + window.scrollY - 10 + "px";
        popup.style.display = "block";
        popup.textContent = text;
    });

    target.addEventListener('mouseleave', () => {
        popup.style.display = "none";
    });
});

popup.addEventListener('mouseenter', () => {
    popup.style.display = "none"; // disappear if hovered
});

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
                dropdownContent.style.maxHeight = (dropdownContent.scrollHeight + dropdown.scrollHeight) + "px";
            } else {
                dropdown.querySelectorAll('input[type="checkbox"]').forEach((cb) => {
                    cb.checked = false;
                });

                // Apply changes
                dropdown.classList.remove('expand');
                dropdown.style.maxHeight = 0;
                dropdownContent.style.maxHeight = (dropdownContent.scrollHeight - dropdown.scrollHeight) + "px";
            }

        });
    }
});

function toggleDropdown(filterArrowNum, dropdownContentNum) {
    var dropdownContent = document.getElementById(dropdownContentNum);
    var filterArrow = document.getElementById(filterArrowNum);

    if (dropdownContent.classList.contains("expand")) {
        dropdownContent.classList.remove("expand");
        dropdownContent.style.maxHeight = null;
        filterArrow.classList.toggle('flipped');
        //sidebarButton.classList.remove("expand");
        //document.documentElement.style.setProperty('--matched-height', (sidebarButton.clientHeight - dropdownContent.scrollHeight) + "px");
    } else {
        dropdownContent.classList.add("expand");
        dropdownContent.style.maxHeight = dropdownContent.scrollHeight + "px";
        filterArrow.classList.toggle('flipped');
        //sidebarButton.classList.add("expand");
        //document.documentElement.style.setProperty('--matched-height', (sidebarButton.clientHeight + dropdownContent.scrollHeight) + "px");
    }

}

var filterError = false;

document.getElementById('Contact-Form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission
    filterError = false;
    // Get the values of the inputs
    const NameError = document.getElementById('Name-Error');
    const Name = document.getElementById('Name');
    const EmailError = document.getElementById('Email-Error');
    const Email = document.getElementById('Email');
    const ResourceError = document.getElementById('Resource-Name-Error');
    const Resource = document.getElementById('Resource');
    const ResourceURLError = document.getElementById('Resource-URL-Error');
    const ResourceURL = document.getElementById('Resource-URL');
    const ResourceDescError = document.getElementById('Resource-Desc-Error');
    const ResourceDesc = document.getElementById('Resource-Desc');

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    var emailCorrect = true;

    if (!(emailRegex.test(Email.value.trim()))) {
        editErrors(EmailError, Email, "Invalid email address. Please enter a valid email.", "2px solid #FF0000");
        emailCorrect = false;
    }

    if (Email.value.trim() === '') {
        editErrors(EmailError, Email, "Please enter your Email.", "2px solid #FF0000");
    } else if (emailCorrect) {
        editErrors(EmailError, Email, "", "0");
    }



    handleInputFilled(Name.value.trim() === '', NameError, Name, "Please enter your Name.");
    handleInputFilled(Resource.value.trim() === '', ResourceError, Resource, "Please enter the Resource's Name.");
    handleInputFilled(ResourceURL.value.trim() === '', ResourceURLError, ResourceURL, "Please enter the Resource's Website URL.");
    handleInputFilled(ResourceDesc.value.trim() === '', ResourceDescError, ResourceDesc, "Please enter a Description about the Resource.");

    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    const EdTr = ["Article", "Training", "Education", "Podcast"];
    const FinInfo = ["Accounting_Assistance", "Banking", "Education: Financial Literacy, Business Plans, Business Cards", "Investment_Advisor", "Wealth_Management"];
    const Fund = ["Crowdfunding", "Funding_Angel", "Grant", "Loans", "Funding_Venture_Capital", "Microcredit/Microloans", "Private_Equity_Firms", "Other_Funding"];
    const GenBusinessAssist = ["Certification", "Commercialization_and_Marketplaces", "Consulting", "CRO", "General_Business_Assistance_Services", "Hiring_Assistance", "Insurance", "Marketing", "Mental_Health", "Supply_Chain", "Work_Space"];
    const IncAcc = ["Accelerator", "Incubator"];
    const LegalAssist = ["General_Legal_Assistance", "Legal_Assistance:_Intellectual_Property,_Trademark,_Patents", "Legal_Assistance:_Legal_Formation"];
    const Mentor = ["Business_Counseling", "Mentoring", "Startup_Advisor"];
    const NetWork = ["Meetups", "Networking"];
    const TechAssist = ["Cyber_Security", "Mobile_&_Web_App_Development", "Mobile_Form_Development", "Project_Management_Software", "Software", "Software_Development", "Tech_Help", "Website_Assistance", "Website_Builder"];

    FoP = [];
    Geo = [];
    Ind = [];
    SoB = [];
    EntDem = [];
    ToRH = [];
    ToR = [];
    ToB = [];

    checkboxes.forEach(myCheckbox => {
        if (myCheckbox.checked) {
            if (myCheckbox.id === "FoP") {
                FoP.push(myCheckbox.value);
            } else if (myCheckbox.id === "Geo") {
                Geo.push(myCheckbox.value);
            } else if (myCheckbox.id === "Ind") {
                Ind.push(myCheckbox.value);
            } else if (myCheckbox.id === "SoB") {
                SoB.push(myCheckbox.value);
            } else if (myCheckbox.id === "EntDem") {
                EntDem.push(myCheckbox.value);
            } else if (myCheckbox.id.includes("main-checkbox")) {
                ToRH.push(myCheckbox.value);
            } else if (myCheckbox.id === "ToR") {
                ToR.push(myCheckbox.value);
            } else if (myCheckbox.id === "ToB") {
                ToB.push(myCheckbox.value);
            }
        }
    });

    handlecheckboxErrors(FoP, document.getElementById("Resource-FoP-Error"), document.getElementById("dropbox"), "Please select one of the options above.");
    handlecheckboxErrors(Geo, document.getElementById("Resource-Geo-Error"), document.getElementById("dropbox2"), "Please select one of the options above.");
    handlecheckboxErrors(Ind, document.getElementById("Resource-Ind-Error"), document.getElementById("dropbox5"), "Please select one of the options above.");
    handlecheckboxErrors(SoB, document.getElementById("Resource-SoB-Error"), document.getElementById("dropbox3"), "Please select one of the options above.");
    handlecheckboxErrors(EntDem, document.getElementById("Resource-EnDe-Error"), document.getElementById("dropbox6"), "Please select one of the options above.");
    handlecheckboxErrors(ToR, document.getElementById("Resource-ToR-Error"), document.getElementById("dropbox7"), "Please select one of the options above.");
    handlecheckboxErrors(ToB, document.getElementById("Resource-ToB-Error"), document.getElementById("dropbox4"), "Please select one of the options above.");

    const ToRset = new Set(ToR);
    var ToRError = false;
    ToRH.forEach(topic => {
        switch (topic) {
            case "Educational_Training":
                ToRError = handleToRErrors(EdTr, ToRset, ToRError);
                break;
            case "Financial_Information":
                ToRError = handleToRErrors(FinInfo, ToRset, ToRError);
                break;
            case "Funding":
                ToRError = handleToRErrors(Fund, ToRset, ToRError);
                break;
            case "General_Business_Assistance":
                ToRError = handleToRErrors(GenBusinessAssist, ToRset, ToRError);
                break;
            case "Incubator_Accelerator":
                ToRError = handleToRErrors(IncAcc, ToRset, ToRError);
                break;
            case "Legal_Assistance":
                ToRError = handleToRErrors(LegalAssist, ToRset, ToRError);
                break;
            case "Mentorship":
                ToRError = handleToRErrors(Mentor, ToRset, ToRError);
                break;
            case "Network":
                ToRError = handleToRErrors(NetWork, ToRset, ToRError);
                break;
            case "Tech_Assistance":
                ToRError = handleToRErrors(TechAssist, ToRset, ToRError);
                break;
        }
    })


    if ((!(Name.value.trim() === '' || Email.value.trim() === '' || Resource.value.trim() === '' || ResourceDesc.value.trim() === '' || ResourceURL.value.trim() === '' || ToRError || filterError)) && emailCorrect) {

        allDropdownContent = document.querySelectorAll(".dropdown-content");

        allDropdownContent.forEach(dropdownContent => {
            if (dropdownContent.classList.contains("expand")) {
                dropdownContent.classList.remove("expand");
                dropdownContent.style.maxHeight = null;
            }
        });

        allFilterArrows = document.querySelectorAll(".FilterArrow");

        allFilterArrows.forEach(filterArrow => {
            if (filterArrow.classList.contains("flipped")) {
                filterArrow.classList.toggle('flipped');
            }
        });

        allDropdowns = document.querySelectorAll(".dropdown");

        allDropdowns.forEach(dropdown => {
            if (dropdown.classList.contains("expand")) {
                dropdown.classList.remove("expand");
                dropdown.style.maxHeight = 0;
                dropdown.style.display = "none";
            }
        });

        stringFoP = arrayToString(FoP);
        stringGeo = arrayToString(Geo);
        stringInd = arrayToString(Ind);
        stringSoB = arrayToString(SoB);
        stringEnDe = arrayToString(EntDem);
        stringToRH = arrayToString(ToRH);
        stringToR = arrayToString(ToR);
        stringToB = arrayToString(ToB);

        const formData = new FormData();
        formData.append('name', Name.value.trim());
        formData.append('email', Email.value.trim());
        formData.append('resourceName', Resource.value.trim());
        formData.append('resourceUrl', ResourceURL.value.trim());
        formData.append('resourceDescription', ResourceDesc.value.trim());
        formData.append('FoP', stringFoP);
        formData.append('Geo', stringGeo);
        formData.append('Ind', stringInd);
        formData.append('SoB', stringSoB);
        formData.append('EnDe', stringEnDe);
        formData.append('ToRH', stringToRH);
        formData.append('ToR', stringToR);
        formData.append('ToB', stringToB);

        fetch("https://onehubsd.org/media/templates/site/cassiopeia/CustomCode/ContactUs/AddAResourcePHP.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => console.log(data.message))
            .catch(err => console.error(err));

        document.getElementById("Contact-Form").reset();
        document.getElementById("success").classList.remove("hidden");
    }
});

function arrayToString(filterArray) {
    stringArray = "";
    first = true;
    filterArray.forEach(filter => {
        if (first) {
            first = false;
            stringArray = filter;
        } else {
            stringArray += ", " + filter;
        }
    })
    return stringArray;
}

function handleToRErrors(resourceHeader, ToRset, toRError) {
    if (!(resourceHeader.some(value => ToRset.has(value)))) {
        editErrors(document.getElementById("Resource-ToR-Error"), document.getElementById("dropbox7"), "Please select a sub-category for all topic of resources selected.", "2px solid #FF0000");
        toRError = true;
    } else if (!toRError) {
        editErrors(document.getElementById("Resource-ToR-Error"), document.getElementById("dropbox7"), "", "0");
        document.getElementById("dropbox7").style.borderTop = "1px solid #e4e4e4";
    }
    return toRError;
}

function handleInputFilled(condition, error, border, errorMessage) {
    if (condition) {
        editErrors(error, border, errorMessage, "2px solid #FF0000");
    } else {
        editErrors(error, border, "", "0");
    }
}

function handlecheckboxErrors(filterSelections, error, border, errorMessage) {
    if (filterSelections.length == 0) {
        editErrors(error, border, errorMessage, "2px solid #FF0000");
        filterError = true;
    } else {
        editErrors(error, border, "", "0");
        border.style.borderTop = "1px solid #e4e4e4";
    }
}

function editErrors(errorElement, borderElement, errorMessage, borderStyle) {
    errorElement.innerHTML = errorMessage;
    borderElement.style.border = borderStyle;
};