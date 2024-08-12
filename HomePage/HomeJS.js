document.querySelectorAll(".sidebar-button").forEach(function(button) {
    button.onclick = function() {
        document.body.classList.toggle("open-sidebar");
    };
});

function toggleDropdown(dropboxNum, dropdownContentNum) {
    var dropdownContent = document.getElementById(dropdownContentNum);
    var sidebarButton = document.getElementById('sidebar-button');

    if (dropdownContent.classList.contains("expand")) {
        dropdownContent.classList.remove("expand");
        dropdownContent.style.maxHeight = null;
        sidebarButton.classList.remove("expand");
        document.documentElement.style.setProperty('--matched-height', (sidebarButton.clientHeight - dropdownContent.scrollHeight) + "px");
    } else {
        dropdownContent.classList.add("expand");
        dropdownContent.style.maxHeight = dropdownContent.scrollHeight + "px";
        sidebarButton.classList.add("expand");
        document.documentElement.style.setProperty('--matched-height', (sidebarButton.clientHeight + dropdownContent.scrollHeight) + "px");
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
                dropdown.classList.remove('expand');
                dropdown.style.maxHeight = 0;
                dropdownContent.style.maxHeight = (dropdownContent.scrollHeight - dropdown.scrollHeight) + "px";
            }
        });
    }

});

function matchHeights() {
    var sidebar = document.getElementById('mySidebar');
    var sidebarButton = document.getElementById('sidebar-button');
    var maxHeight = sidebar.clientHeight;
    document.documentElement.style.setProperty('--matched-height', maxHeight + 'px')
}

function collectCheckboxValues(name) {
    var checkboxes = document.querySelectorAll('input[name="' + name + '"]:checked');
    var values = [];
    checkboxes.forEach((checkbox) => {
        values.push(checkbox.value);
    });
    return values;
}

function updateFilters() {
    var filterValues = collectCheckboxValues("filters[]");
    var selectValues = collectCheckboxValues("select[]");

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

    var data = "ajax=1";
    data += filterValues.map(value => "&filters[]=" + encodeURIComponent(value)).join("");
    data += selectValues.map(value => "&select[]=" + encodeURIComponent(value)).join("");

    xhr.send(data);
}

document.querySelectorAll('input[name="filters[]"], input[name="select[]"]').forEach((checkbox) => {
    checkbox.addEventListener('change', updateFilters);
});



window.onload = matchHeights;
window.onresize = matchHeights;
