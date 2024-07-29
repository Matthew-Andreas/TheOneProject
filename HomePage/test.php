{source}

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajax'])) {
    $filters = isset($_POST['filters']) ? $_POST['filters'] : [];
    $select = isset($_POST['select']) ? $_POST['select'] : [];

    // Process the filters and select values
    /*$response = "<p>Selected Filters: " . implode(", ", $filters) . "</p>";
    $response .= "<p>Selected Selects: " . implode(", ", $select) . "</p>";

    echo $response;*/
    print_r($filters);
    print_r($select);
    exit;
}
?>

<form id="filters-form">
    <!-- First set of checkboxes -->
    <label><input type="checkbox" name="filters[]" value="filter1"> Filter 1</label>
    <label><input type="checkbox" name="filters[]" value="filter2"> Filter 2</label>
    
    <!-- Second set of checkboxes -->
    <label><input type="checkbox" name="select[]" value="select1"> Select 1</label>
    <label><input type="checkbox" name="select[]" value="select2"> Select 2</label>
</form>

<div id="selected-filters"></div>

<script>
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

// Add event listeners to all checkboxes
document.querySelectorAll('input[name="filters[]"], input[name="select[]"]').forEach((checkbox) => {
    checkbox.addEventListener('change', updateFilters);
});
</script>
{/source}