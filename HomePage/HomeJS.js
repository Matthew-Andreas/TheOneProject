document.getElementById("sidebar-button").onclick = function () {
    document.body.classList.toggle("open-sidebar");
}
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
