let mainMenu = document.querySelector("#menu");
let burgerMenu = document.querySelector("#menu-burger");
let background = document.querySelector("#menuBackground")

let clickedEvent = "click"; // Au clic si "touchstart" n'est pas détecté
/*window.addEventListener('touchstart', function detectTouch() {
    clickedEvent = "touchstart"; // Transforme l'événement en "touchstart"
    window.removeEventListener('touchstart', detectTouch, false);
}, false);*/

// Créé un "toggle class" en Javascrit natif (compatible partout)
burgerMenu.addEventListener(clickedEvent, function(evt) {
    //console.log(clickedEvent);
    // Modification du menu burger
    if(!this.getAttribute("class")) {
        this.setAttribute("class", "clicked");
    } else {
        this.removeAttribute("class");
    }
    // Variante avec x.classList (ou DOMTokenList), pas 100% compatible avant IE 11...
    // burgerMenu.classList.toggle("clicked");

    // Créé l'effet pour le menu slide (compatible partout)
    if(mainMenu.getAttribute("class") != "visible") {
        mainMenu.setAttribute("class", "visible");
        background.style.display = "block";
    } else {
        mainMenu.setAttribute("class", "invisible");
        background.style.display = "none"
    }
}, false);

    background.addEventListener("click", function () {
        mainMenu.setAttribute("class", "invisible");
        burgerMenu.removeAttribute("class");
        background.style.display = "none"
    })

//pour faire avec les mouvement de doigts sur le portable
if(screen.width <= 700) {
    let startX = 0; // Position de départ
    let distance = 100; // 100 px de swipe pour afficher le menu

    // Au premier point de contact
    window.addEventListener("touchstart", function(evt) {
        // Récupère les "touches" effectuées
        let touches = evt.changedTouches[0];
        startX = touches.pageX;
        between = 0;
    }, false);

    // Quand les points de contact sont en mouvement
    window.addEventListener("touchmove", function(evt) {
        // Limite les effets de bord avec le tactile...
        evt.preventDefault();
        evt.stopPropagation();
    }, false);

    // Quand le contact s'arrête
    window.addEventListener("touchend", function(evt) {
        let touches = evt.changedTouches[0];
        let between = touches.pageX - startX;

        // Détection de la direction
        if(between > 0) {
            var orientation = "ltr";
        } else {
            var orientation = "rtl";
        }

        // Modification du menu burger
        if(Math.abs(between) >= distance && orientation == "ltr" && mainMenu.getAttribute("class") != "visible") {
            burgerMenu.setAttribute("class", "clicked");
        }
        if(Math.abs(between) >= distance && orientation == "rtl" && mainMenu.getAttribute("class") != "invisible") {
            burgerMenu.removeAttribute("class");
        }

        // Créé l'effet pour le menu slide (compatible partout)
        if(Math.abs(between) >= distance && orientation == "ltr" && mainMenu.getAttribute("class") != "visible") {
            mainMenu.setAttribute("class", "visible");
            background.style.display = "block";
        }
        if(Math.abs(between) >= distance && orientation == "rtl" && mainMenu.getAttribute("class") != "invisible") {
            mainMenu.setAttribute("class", "invisible");
            background.style.display = "none";
        }
    }, false);
}