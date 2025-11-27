document.getElementById('Contact-Form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

    // Get the values of the inputs
    const Name = document.getElementById('Name').value;
    const nameError = document.getElementById('Name-Error');
    const nameBorder = document.getElementById('Name');
    const Email = document.getElementById('Email').value;
    const emailError = document.getElementById('Email-Error');
    const emailBorder = document.getElementById('Email');
    const Resource = document.getElementById('Resource').value;
    const ResourceError = document.getElementById('Resource-Error');
    const ResourceBorder = document.getElementById('Resource');
    const moreInfo = document.getElementById('moreInfo').value;
    const moreInfoError = document.getElementById('More-Info-Error');
    const moreInfoBorder = document.getElementById('moreInfo');
    const checkboxError = document.getElementById('checkbox-Error')

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    var emailCorrect = true;

    if (!(emailRegex.test(Email))) {
        editErrors(emailError, emailBorder, "Invalid email address. Please enter a valid email.", "2px solid #FF0000");
        emailCorrect = false;
    }

    if (Name === '') {
        editErrors(nameError, nameBorder, "Please enter your Name.", "2px solid #FF0000");
    } else {
        editErrors(nameError, nameBorder, "", "0");
    }

    if (Email === '') {
        editErrors(emailError, emailBorder, "Please enter your Email.", "2px solid #FF0000");
    } else if (emailCorrect) {
        editErrors(emailError, emailBorder, "", "0");
    }

    if (Resource === '') {
        editErrors(ResourceError, ResourceBorder, "Please enter your Resource.", "2px solid #FF0000");
    } else {
        editErrors(ResourceError, ResourceBorder, "", "0");

    }

    if (moreInfo === '') {
        editErrors(moreInfoError, moreInfoBorder, "Please enter more info about your error.", "2px solid #FF0000");
    } else {
        editErrors(moreInfoError, moreInfoBorder, "", "0");
    }

    if (areAllCheckboxesEmpty()) {
        checkboxError.innerHTML = "Please select one of the options above.";
    } else {
        checkboxError.innerHTML = "";
    }

    if ((!(Name === '' || Email === '' || Resource === '' || moreInfo === '' || areAllCheckboxesEmpty())) && emailCorrect) {
        const output = `Name: ${Name}<br>
                        Email: ${Email}<br>
                        Resource: ${Resource}`;

        editErrors(nameError, nameBorder, "", "0");
        editErrors(emailError, emailBorder, "", "0");
        editErrors(ResourceError, ResourceBorder, "", "0");
        editErrors(moreInfoError, moreInfoBorder, "", "0");
        checkboxError.innerHTML = "";

        let checkboxErrors = checkboxErrorString();

        document.getElementById("Contact-Form").reset();
        document.getElementById("success").classList.remove("hidden");
        // Display the output in a paragraph
        //document.getElementById('output').innerHTML = output;



        const formData = new FormData();
        formData.append('name', Name);
        formData.append('email', Email);
        formData.append('resourceName', Resource);
        formData.append('checkboxErrors', checkboxErrors);
        formData.append('message', moreInfo);

        fetch("https://onehubsd.org/media/templates/site/cassiopeia/CustomCode/ContactUs/ReportAnErrorPHP.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => console.log(data.message))
            .catch(err => console.error(err));
    }
});

function editErrors(errorName, borderName, errorResource, borderStyle) {
    errorName.innerHTML = errorResource;
    borderName.style.border = borderStyle;
};

function areAllCheckboxesEmpty() {
    // Get all checkboxes in the form
    const checkboxes = document.querySelectorAll('form input[type="checkbox"]');

    // Check if all checkboxes are unchecked
    for (let checkbox of checkboxes) {
        if (checkbox.checked) {
            return false; // At least one checkbox is checked
        }
    }
    return true; // All checkboxes are unchecked
}

function checkboxErrorString() {
    const checkboxes = document.querySelectorAll('form input[type="checkbox"]');
    let first = true;
    let checkboxString = "";
    for (let checkbox of checkboxes) {
        if (checkbox.checked && first) {
            checkboxString = checkbox.value;
            first = false;
        } else if (checkbox.checked) {
            checkboxString += ", " + checkbox.value;
        }
    }

    return checkboxString;
}