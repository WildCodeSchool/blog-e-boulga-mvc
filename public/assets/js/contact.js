let btn_envoie = document.querySelector("#btn_submit")
let inputs = document.querySelectorAll(".input_form")
let label_mod = document.querySelector(".labelMod")
let contact_form = document.querySelector(".contactUsForm")
let check_form = []

btn_envoie.addEventListener("click", (event) => {

    /**
     * On vide le tableau check_form à chaque fois que l'on clique sur le bouton
     */
    check_form = []

    /**
     * Vérification des inputs du formulaire
     */
    inputs.forEach(element => {

        let valueInput = element.value
        let elementID = element.id

        /**
         * Vérification du type de l'input
         */
        switch (element.type) {
            case "text":
                if (elementID === "prenom") {
                    if (valueInput === "") {
                        error_input(element)
                    } else {
                        element.style.borderBottom = "1px solid black"
                        element.nextElementSibling.style.display = "none"
                    }
                } else if (elementID === "nom") {
                    if (valueInput === "") {
                        error_input(element)
                    } else {
                        element.style.borderBottom = "1px solid black"
                        element.nextElementSibling.style.display = "none"
                    }
                } else if (elementID === "subject") {
                    if (valueInput === "") {
                        error_input(element)
                    } else {
                        element.style.borderBottom = "1px solid black"
                        element.nextElementSibling.style.display = "none"
                    }
                }
                break;
            case "textarea":
                if (valueInput === "") {
                    element.style.border = "2px solid #Ec1d1d"
                    check_form.push("empty")
                    element.nextElementSibling.style.display = "block"
                    element.nextElementSibling.style.marginBottom = "1rem"
                    event.preventDefault();
                } else {
                    element.style.border = "1px solid black"
                    element.nextElementSibling.style.display = "none"
                }
                break;
            case "email":
                /**
                 * Vérification du mail avec la fonction créée plus bas
                 */
                let check_mail = isMail(valueInput)
                if (valueInput === "" || check_mail == null) {
                    error_input(element)
                } else {
                    element.style.borderBottom = "1px solid black"
                    element.nextElementSibling.style.display = "none"
                }
                break;
            case "checkbox":
                if (element.checked === false) {
                    label_mod.style.color = "#Ec1d1d"
                    check_form.push("unchecked")
                } else if (element.checked === true) {
                    label_mod.style.color = "var(--our-black)"
                }
                break;
            default:
                break;
        }
    })

    /**
     * Si le tableau check_form est vide, on envoie le formulaire, sinon on arrête l'envoi
     */
    if (check_form.length === 0) {
        check_box = document.querySelector("#validation")
        check_box.checked = false
        send(event, contact_form)
    } else {
        if(document.querySelector(".msg_sent") !== null){
            document.querySelector(".msg_sent").style.display = "none"
        }
        event.preventDefault();
    }

})

/**
 * Vérification du mail
 * @param {*} email
 * @returns
 */
function isMail(email) {
    let mailRegex = /^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/;
    let regex = new RegExp(mailRegex);
    return email.match(regex);
}

/**
 * Si l'input est vide, on affiche un message d'erreur
 * @param {*} element
 */
function error_input(element) {
    element.style.borderBottom = "2px solid #Ec1d1d"
    check_form.push("empty")
    element.nextElementSibling.style.display = "block"
    element.nextElementSibling.style.marginBottom = "1rem"
}

/**
 * Si le formulaire est envoyé, on vide les inputs et on affiche un message de confirmation
 * @param {*} e
 * @param {*} form
 */
function send(e, form) {
    // code to implement if we decide to use fetch/ajax later on
    /*
    fetch(form.action, {
        method: 'post', body: new FormData(form)
    });
    e.preventDefault();

    inputs.forEach(element => { element.value = "" })
    */
    /**
     * Affichage du message de confirmation
     * On le cache au bout de 10 secondes
     */
    /*
    msg_sent.style.display = "block";
    setTimeout(() => {
        msg_sent.style.display = "none";
    }, 10000);
    */
}
