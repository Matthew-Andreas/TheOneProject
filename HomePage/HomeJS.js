var allCollumns = false;

document.querySelectorAll(".sidebar-button").forEach(function (button) {
    button.onclick = function () {
        document.body.classList.toggle("open-sidebar");
    };
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

function collectCheckboxValues(name) {
    var checkboxes = document.querySelectorAll('input[name="' + name + '"]:checked');
    var values = [];
    checkboxes.forEach((checkbox) => {
        values.push(checkbox.value);
    });
    return values;
}

function updateFilters() {
    var paginationValue = getSelectedRadio();
    var filterValues = collectCheckboxValues("filters[]");
    //var selectValues = collectCheckboxValues("select[]");
    if (filterValues.length != 0 || paginationValue > 10 || allCollumns) {
        document.getElementById("resetBtn").style.display = "block";
    } else {
        document.getElementById("resetBtn").style.display = "none";
    }
    console.log(paginationValue);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "", true);  // Update the URL as needed
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {  // Request is complete
            if (xhr.status == 200) {  // Request was successful
                document.getElementById("selected-filters").innerHTML = xhr.responseText;
            } else {
                console.error("Request failed. Status: " + xhr.status);
            }
        }
    };
    console.log(allCollumns)
    console.log("updateFilters")
    var data = "ajax=1";
    data += "&itemLimit=" + encodeURIComponent(paginationValue);
    data += "&allColumns=" + encodeURIComponent(allCollumns);
    data += filterValues.map(value => "&filters[]=" + encodeURIComponent(value)).join("");
    //data += selectValues.map(value => "&select[]=" + encodeURIComponent(value)).join("");

    xhr.send(data);
}

// Debounce function
function debounce(func, delay) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}

// Function to handle checkbox changes
function onFilterChange() {
    const page = 1; // Reset to page 1
    loadPage(page); // Trigger the AJAX request to load the first page with the current filters
}

// Attach debounced event listeners to all filter checkboxes
document.querySelectorAll('input[name="filters[]"]').forEach(checkbox => {
    checkbox.addEventListener('change', debounce(onFilterChange, 300)); // 300ms debounce delay
});

document.addEventListener('DOMContentLoaded', function () {
    function loadPage(page) {
        const xhr = new XMLHttpRequest();
        const formData = new FormData();

        document.documentElement.scrollTop = 0;  // For modern browsers
        document.body.scrollTop = 0;  // For older browsers (especially IE)

        formData.append('ajax', 1);
        formData.append('page', page);

        var paginationValue = getSelectedRadio();
        var filters = collectCheckboxValues('filters[]');
        if (filters.length != 0 || paginationValue > 10 || allCollumns) {
            document.getElementById("resetBtn").style.display = "block";
        } else {
            document.getElementById("resetBtn").style.display = "none";
        }
        //var select = collectCheckboxValues('select[]');
        console.log(filters.length != 0)
        console.log(paginationValue > 10)
        console.log(allCollumns)
        console.log("load")
        formData.append('itemLimit', paginationValue)
        formData.append('allColumns', allCollumns)
        filters.forEach(value => formData.append('filters[]', value));
        //select.forEach(value => formData.append('select[]', value));

        xhr.open('POST', '', true);
        xhr.onload = function () {
            if (xhr.readyState == 4 && xhr.status === 200) {
                document.getElementById('selected-filters').innerHTML = xhr.responseText;
            } else {
                console.error("Request failed. Status: " + xhr.status);
                document.getElementById("databaseTable").remove();
                document.getElementById("pagination").remove();
                document.getElementById("selected-filters").textContent = "No data in this section.";
            }
        };
        try {
            xhr.send(formData);
        } catch (error) {
            console.error("An error occurred:", error.message);
        }

    }

    window.loadPage = loadPage; // Expose the function globally
});

//document.querySelectorAll('input[name="filters[]"], input[name="select[]"]').forEach((checkbox) => {
//checkbox.addEventListener('change', updateFilters);
//});


function getSelectedRadio() {
    const selectedValue = document.querySelector('input[name="pagination"]:checked')?.value;
    return selectedValue;
}

function setColumns() {
    const setColumnsBtn = document.getElementById("columnBtn");
    allCollumns = !allCollumns;
    if (allCollumns) {
        setColumnsBtn.textContent = "Show Less Columns";
    } else {
        setColumnsBtn.textContent = "Show All Columns";
    }
    //console.log(allCollumns);
    updateFilters();
}

function resetFilters() {
    location.reload();
}



