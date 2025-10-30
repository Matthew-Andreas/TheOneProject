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
        event.preventDefault();
        const selected = document.querySelector('input[name="Resource"]:checked')
        if (selected) {
            console.log(selected.value)
            selectedResources(selected.value);
            console.log(selected.value)
        } else {
            localStorage.setItem('TopicHead', "Legal_Assistance");
            localStorage.setItem('Filter', 'Legal_Assistance:_Intellectual_Property,_Trademark,_Patents');
            localStorage.setItem('FilterLocation', "dropdown-content7");
            localStorage.setItem('TopicFilterLocation', "dropdown9");
            localStorage.setItem('Arrow', "FilterArrow ToR");
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
                        break;
                    case 12:
                        console.log("12");
                        break;
                    case 13:
                        console.log("13");
                        break;
                    case 14:
                        console.log("14");
                        break;
                    case 15:
                        console.log("15");
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