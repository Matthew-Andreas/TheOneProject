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