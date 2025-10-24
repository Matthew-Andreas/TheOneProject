function getSelectedRadio() {
    const selectedValue = document.querySelector('input[name="pagination"]:checked')?.value;
    return selectedValue;
}

document.addEventListener("DOMContentLoaded", function () {
    function loadPage(page) {
        const xhr = new XMLHttpRequest();
        const formData = new FormData();

        formData.append('ajax', 1);
        formData.append('page', page);

        var paginationValue = getSelectedRadio();

        formData.append('itemLimit', paginationValue)

        xhr.open('POST', '', true);
        xhr.onload = function () {
            if (xhr.readyState == 4 && xhr.status === 200) {
                console.log(xhr.responseText);
                document.getElementById('Database').innerHTML = xhr.responseText;
            } else if (document.querySelector('#pagination')) {
                console.error("Request failed. Status: " + xhr.status);
                //document.getElementById("databaseTable").remove();
                //document.getElementById("pagination").remove();
                //document.getElementById("selected-filters").textContent = "No data in this section.";
            } else {
                console.error("Request failed. Status: " + xhr.status);
                //document.getElementById("databaseTable").remove();
                //document.getElementById("selected-filters").textContent = "No data in this section.";
            }
        };
        try {
            xhr.send(formData);
        } catch (error) {
            console.error("An error occurred:", error.message);
        }

    }
    loadPage(1);
    window.loadPage = loadPage;

});
