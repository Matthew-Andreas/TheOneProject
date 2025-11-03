//which filters are selected
var filter = [];
//Which Topic of resource headers are selected
var topicHead = [];
//which dropdown content to open
var filterLocation = [];
//which topic of resource dropdown to open
var topicFilterLocation = [];
//FilterLocations arrows to flip
var arrow = [];


function toggleDropdown(dropdownContentId) {
    var dropdownContent = document.getElementById(dropdownContentId);
    var dropdown = document.querySelector(".dropdown")
    if (dropdownContent.classList.contains("expand")) {
        dropdownContent.style.maxHeight = null;
        dropdownContent.classList.remove("expand");
    } else {
        dropdownContent.style.maxHeight = dropdown.scrollHeight + "px";
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
        event.preventDefault();
        const selected = document.querySelector('input[name="Resource"]:checked')
        if (selected) {
            console.log(selected.value)
            selectedResources(selected.value);
            localStorage.setItem('TopicHead', JSON.stringify(topicHead));
            localStorage.setItem('Filter', JSON.stringify(filter));
            localStorage.setItem('FilterLocation', JSON.stringify(filterLocation));
            localStorage.setItem('TopicFilterLocation', JSON.stringify(topicFilterLocation));
            localStorage.setItem('Arrow', JSON.stringify(arrow));
            window.location.href = 'https://onehubsd.org/';
        }

    }
})

function selectedResources(value) {
    let resources = value.split(",");
    resources.forEach(resource => {
        numbers = resource.split(".").map(num => parseInt(num));
        switch (numbers[0]) {
            case 1:
                console.log("1");
                arrow.push("FilterArrow Sec");
                filterLocation.push("dropdown-content6");
                switch (numbers[1]) {
                    case 1:
                        console.log("1");
                        filter.push("Asian");
                        break;
                    case 2:
                        console.log("2");
                        filter.push("Black");
                        break;
                    case 3:
                        console.log("3");
                        filter.push("Immigrants");
                        break;
                    case 4:
                        console.log("4");
                        filter.push("Indigenous_People");
                        break;
                    case 5:
                        console.log("5");
                        filter.push("Latinx");
                        break;
                    case 6:
                        console.log("6");
                        filter.push("LGBTQ");
                        break;
                    case 7:
                        console.log("7");
                        break;
                    case 8:
                        console.log("8");
                        filter.push("Multicultural");
                        break;
                    case 9:
                        console.log("9");
                        filter.push("People_With_Disabilities");
                        break;
                    case 10:
                        console.log("10");
                        break;
                    case 11:
                        console.log("11");
                        break;
                    case 12:
                        console.log("12");
                        break;
                    case 13:
                        console.log("13");
                        break;
                    case 14:
                        console.log("14");
                        filter.push("Woman_Veterans")
                        break;
                    case 15:
                        console.log("15");
                        filter.push("Women")
                        break;
                }
                break;
            case 2:
                console.log("2");
                switch (numbers[1]) {
                    case 1:
                        console.log("1");
                        break;
                    case 2:
                        console.log("2");
                        break;
                }
                break;
            case 3:
                console.log("3");
                switch (numbers[1]) {
                    case 1:
                        console.log("1");
                        break;
                    case 2:
                        console.log("2");
                        break;
                    case 3:
                        console.log("3");
                        break;
                    case 4:
                        console.log("4");
                        break;
                    case 5:
                        console.log("5");
                        break;
                }
                break;
            case 4:
                console.log("4");
                switch (numbers[1]) {
                    case 1:
                        console.log("1");
                        break;
                    case 2:
                        console.log("2");
                        break;
                    case 3:
                        console.log("3");
                        break;
                    case 4:
                        console.log("4");
                        break;
                    case 5:
                        console.log("5");
                        break;
                    case 6:
                        console.log("6");
                        break;
                    case 7:
                        console.log("7");
                        break;
                }
                break;
            case 5:
                console.log("5");
                switch (numbers[1]) {
                    case 1:
                        console.log("1");
                        break;
                    case 2:
                        console.log("2");
                        break;
                    case 3:
                        console.log("3");
                        break;
                    case 4:
                        console.log("4");
                        break;
                    case 5:
                        console.log("5");
                        break;
                }
                break;
            case 6:
                console.log("6")
                console.log(numbers)
                switch (numbers[1]) {
                    case 1:
                        console.log("1");
                        switch (numbers[2]) {
                            case 1:
                                console.log("1");
                                break;
                            case 2:
                                console.log("2");
                                break;
                            case 3:
                                console.log("3");
                                break;
                            case 4:
                                console.log("4");
                                break;
                        }
                        break;
                    case 2:
                        console.log("2");
                        switch (numbers[2]) {
                            case 1:
                                console.log("1");
                                break;
                            case 2:
                                console.log("2");
                                break;
                            case 3:
                                console.log("3");
                                break;
                            case 4:
                                console.log("4");
                                break;
                            case 5:
                                console.log("5");
                                break;
                        }
                        break;
                    case 3:
                        console.log("3");
                        switch (numbers[2]) {
                            case 1:
                                console.log("1");
                                break;
                            case 2:
                                console.log("2");
                                break;
                            case 3:
                                console.log("3");
                                break;
                            case 4:
                                console.log("4");
                                break;
                            case 5:
                                console.log("5");
                                break;
                            case 6:
                                console.log("6");
                                break;
                            case 7:
                                console.log("7");
                                break;
                            case 8:
                                console.log("8");
                                break;
                        }
                        break;
                    case 4:
                        console.log("4");
                        switch (numbers[2]) {
                            case 1:
                                console.log("1");
                                break;
                            case 2:
                                console.log("2");
                                break;
                            case 3:
                                console.log("3");
                                break;
                            case 4:
                                console.log("4");
                                break;
                            case 5:
                                console.log("5");
                                break;
                            case 6:
                                console.log("6");
                                break;
                            case 7:
                                console.log("7");
                                break;
                            case 8:
                                console.log("8");
                                break;
                            case 9:
                                console.log("9");
                                break;
                            case 10:
                                console.log("10");
                                break;
                            case 11:
                                console.log("11");
                        }
                        break;
                    case 5:
                        console.log("5");
                        switch (numbers[2]) {
                            case 1:
                                console.log("1");
                                break;
                            case 2:
                                console.log("2");
                                break;
                        }
                        break;
                    case 6:
                        console.log("6");
                        switch (numbers[2]) {
                            case 1:
                                console.log("1");
                                break;
                            case 2:
                                console.log("2");
                                break;
                            case 3:
                                console.log("3");
                                break;
                        }
                        break;
                    case 7:
                        console.log("7");
                        switch (numbers[2]) {
                            case 1:
                                console.log("1");
                                break;
                            case 2:
                                console.log("2");
                                break;
                            case 3:
                                console.log("3");
                                break;
                        }
                        break;
                    case 8:
                        console.log("8");
                        switch (numbers[2]) {
                            case 1:
                                console.log("1");
                                break;
                            case 2:
                                console.log("2");
                                break;
                        }
                        break;
                    case 9:
                        console.log("9");
                        switch (numbers[2]) {
                            case 1:
                                console.log("1");
                                break;
                            case 2:
                                console.log("2");
                                break;
                            case 3:
                                console.log("3");
                                break;
                            case 4:
                                console.log("4");
                                break;
                            case 5:
                                console.log("5");
                                break;
                            case 6:
                                console.log("6");
                                break;
                            case 7:
                                console.log("7");
                                break;
                            case 8:
                                console.log("8");
                                break;
                            case 9:
                                console.log("9");
                                break;
                        }
                        break;
                }
                break;
            case 7:
                console.log("7");
                switch (numbers[1]) {
                    case 1:
                        console.log("1");
                        break;
                    case 2:
                        console.log("2");
                        break;
                    case 3:
                        console.log("3");
                        break;
                    case 4:
                        console.log("4");
                        break;
                    case 5:
                        console.log("5");
                        break;
                }
                break;
        }
    });

}