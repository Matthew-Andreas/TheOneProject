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

/*popup.addEventListener('mouseenter', () => {
    popup.style.display = "none"; // disappear if hovered
});*/

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

                // Defer the updateFilters call
                setTimeout(() => {
                    updateFilters();
                }, 50); // A small delay to allow the DOM to fully update
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

document.getElementById('Contact-Form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission

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

    if (Email === '') {
        editErrors(emailError, emailBorder, "Please enter your Email.", "2px solid #FF0000");
    } else if (emailCorrect) {
        editErrors(emailError, emailBorder, "", "0");
    }

    handleInputFilled(Name.value.trim(), NameError, Name, "Please enter your Name.");
    handleInputFilled(Resource.value.trim(), ResourceError, Resource, "Please enter the Resource's Name.");
    handleInputFilled(ResourceURL.value.trim(), ResourceURLError, ResourceURL, "Please enter the Resource's Website URL.");
    handleInputFilled(ResourceDesc.value.trim(), ResourceDescError, ResourceDesc, "Please enter a Description about the Resource.");
    /*if ((!(Name === '' || Email === '' || Message === '')) && emailCorrect) {
        const output = `Name: ${Name}<br>
                        Email: ${Email}<br>
                        Message: ${Message}`;

        const contactUs = {
            name: Name,
            email: Email,
            message: Message
        };

        editErrors(nameError, nameBorder, "", "0");
        editErrors(emailError, emailBorder, "", "0");
        editErrors(ResourceError, ResourceBorder, "", "0");

        document.getElementById("Contact-Form").reset();
        document.getElementById("success").classList.remove("hidden");

        // Display the output in a paragraph
        //document.getElementById('output').innerHTML = output;

        const formData = new FormData();
        formData.append('name', Name);
        formData.append('email', Email);
        formData.append('message', Message);

        fetch("https://onehubsd.org/media/templates/site/cassiopeia/CustomCode/ContactUs/ContactUsPHP.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.json())
            .then(data => console.log(data.message))
            .catch(err => console.error(err));

    }*/
});

function handleInputFilled(value, error, border, errorMessage) {
    if (value === '') {
        editErrors(error, border, errorMessage, "2px solid #FF0000");
    } else {
        editErrors(error, border, "", "0");
    }
}

function editErrors(errorName, borderName, errorResource, borderStyle) {
    errorName.innerHTML = errorResource;
    borderName.style.border = borderStyle;
};