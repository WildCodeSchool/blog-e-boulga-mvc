let buttonValidate = document.getElementById("validate");
let buttonValidateForm = document.getElementById("validateForm");
let buttonCancel = document.getElementById("cancel");
let buttonCancelForm= document.getElementById("cancelForm");
let modalText = document.getElementById("modalText");

let modal = document.getElementById("modal");

buttonValidate.addEventListener("click", () =>{
    modal.style.display = "block";
    modalText.textContent = "Désirez-vous enregistrer votre article?";
})

buttonCancel.addEventListener("click", () =>{
    modal.style.display = "block";
    modalText.textContent = "Désirez-vous annuler la création ou modification de votre article?";
    buttonValidateForm.addEventListener("click", (event) => {
        event.preventDefault();
        location.href = "/admin/articles";
    })
})

buttonCancelForm.addEventListener("click", () =>{
    modal.style.display = "none";
})

window.addEventListener('click', function (event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
})
