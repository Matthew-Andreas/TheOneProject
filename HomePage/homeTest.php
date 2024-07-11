{source}
<?php
// Check if it's an AJAX request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
    if (isset($_POST['options']) && is_array($_POST['options'])) {
        foreach ($_POST['options'] as $option) {
            echo "<li>" . htmlspecialchars($option) . "</li>";
        }
    } else {
        echo "<li>No options selected.</li>";
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox Example</title>
    <script>
        function updateOptions() {
            var checkboxes = document.querySelectorAll('input[name="options[]"]:checked');
            var values = [];
            checkboxes.forEach((checkbox) => {
                values.push(checkbox.value);
            });

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("selected-options").innerHTML = xhr.responseText;
                }
            };
            xhr.send("ajax=1&options[]=" + values.join("&options[]="));
        }
    </script>
</head>
<body>
    <form method="post">
        <label>
            <input type="checkbox" name="options[]" value="Option 1" onclick="updateOptions()"> Option 1
        </label><br>
        <label>
            <input type="checkbox" name="options[]" value="Option 2" onclick="updateOptions()"> Option 2
        </label><br>
        <label>
            <input type="checkbox" name="options[]" value="Option 3" onclick="updateOptions()"> Option 3
        </label><br>
    </form>
    <h1>Selected Options:</h1>
    <ul id="selected-options">
        <!-- Selected options will be displayed here -->
    </ul>
</body>
</html>
{/source}