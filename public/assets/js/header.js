let logoHeader = document.querySelector("#logo_header")
let myHeader = document.querySelector("header")
let myFooter = document.querySelector("footer")
let myMain = document.querySelector("main")
let burgerIcone = document.querySelector("#burger_icon")
let burgerMenue = document.querySelector("#burger_menue")
let root = document.querySelector("body");

window.onload = onload();

function onload() {
    burgerIcone.addEventListener("click", () => {
        // Open or close the burger menue
        showResponsiveMenu()
    })

    mediaQueryChecker() // Check if the window size is changing
}

// Open or close the burger menue, called in onload()
function showResponsiveMenu() {
    if (!burgerIcone.classList.contains('opened')) {
        openingBurger(burgerMenue, root) // Open the burger menue
    } else {
        closingBurger(burgerMenue, root) // Close the burger menue
    }
}

// Open the burger menue, called in showResponsiveMenu()
function openingBurger(burgerMenue, root) {
    burgerMenue.classList.add("opened");
    burgerIcone.classList.add("opened");
    root.style.overflowY = "hidden";

    burgerMenue.classList.add('easeInAnimation')
    burgerMenue.classList.remove('easeOutAnimation')
    burgerMenue.classList.add('isFlexed')
    myMain.classList.add('undisplayed')
    myFooter.classList.add('undisplayed')
}

// Close the burger menue, called in showResponsiveMenu()
function closingBurger(burgerMenue, root) {
    burgerMenue.classList.remove("opened");
    burgerIcone.classList.remove("opened");
    root.style.overflowY = "";
    burgerMenue.classList.remove('easeInAnimation')
    burgerMenue.classList.add('easeOutAnimation')
    myMain.classList.remove('undisplayed')
    myFooter.classList.remove('undisplayed')

    // Wait for the animation to end before removing the flex
    setTimeout(() => {
        burgerMenue.classList.remove('isFlexed')
    }, 500);
}

// Check if the window size is changing, called in onload()
function mediaQueryChecker() {
    let myMedia = window.matchMedia("(min-width: 1090px)")

    myMediaQuerry(myMedia)

    myMedia.addEventListener('change', () => {
        myMediaQuerry(myMedia)
    });
}

// Close the burger menue if the window size going into desktop size
function myMediaQuerry(myMedia) {
    if (myMedia.matches) {
        instanCloseBurger()
    }
}

// Function called if the window size going into desktop size, closes burger menue
function instanCloseBurger() {
    burgerMenue.classList.remove("opened");
    burgerIcone.classList.remove("opened");

    root.style.overflowY = "";

    burgerMenue.classList.remove('easeInAnimation')
    burgerMenue.classList.add('easeOutAnimation')
    burgerMenue.classList.remove('isFlexed')
    myMain.classList.remove('undisplayed')
    myFooter.classList.remove('undisplayed')
}
