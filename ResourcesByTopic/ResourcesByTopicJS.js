function toggleDropdown(dropdownContentId, sizeOut) {
    var dropdownContent = document.getElementById(dropdownContentId);

    if (dropdownContent.classList.contains("expand")) {
        dropdownContent.style.maxHeight = null;
        dropdownContent.classList.remove("expand");
    } else {
        dropdownContent.style.maxHeight = sizeOut;
        dropdownContent.classList.add("expand");
    }
}

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('dropdownButtonimg')) {
        event.target.classList.toggle('flipped');
    }
});

document.addEventListener('click', function (event) {
    if (event.target.classList.contains('submitButton')) {
        localStorage.setItem('TopicHead', "Legal_Assistance");
        localStorage.setItem('Filter', 'Legal_Assistance:_Intellectual_Property,_Trademark,_Patents');
        localStorage.setItem('FilterLocation', "dropdown-content7");
        localStorage.setItem('TopicFilterLocation', "dropdown9");
        localStorage.setItem('Arrow', "FilterArrow ToR");
        window.location.href = 'https://onehubsd.org/';
    }
})