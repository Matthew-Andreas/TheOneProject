{source}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="paginationChanger">
        <p>Number of Resources per page:</p>
        <input type="radio" id="10" name="pagination" value="10" onclick="loadPage(1)" checked>
        <label for="10">10</label>
        <input type="radio" id="25" name="pagination" value="25" onclick="loadPage(1)">
        <label for="25">25</label>
        <input type="radio" id="50" name="pagination" value="50" onclick="loadPage(1)">
        <label for="50">50</label>
    </div>
    <div id="Database">
    <?php
            include_once JPATH_BASE . '/media/templates/site/cassiopeia/CustomCode/HomePage/DatabaseTable.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajax'])) {
                $itemLimit = isset($_POST['itemLimit']) ? (int)$_POST['itemLimit'] : 10; // Default to 10 items per page

                // Determine the current page for pagination
                $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        
                $T1 = new DatabaseTable("Select FullName, Email, UserMessage From ContactUsResponses", $page, $itemLimit);
                exit();
            }
        ?>
    </div>
    
</body>
<script src="media/templates/site/cassiopeia/CustomCode/SecretMenu/ContactUsDataJS.js"></script>

</html>
{/source}