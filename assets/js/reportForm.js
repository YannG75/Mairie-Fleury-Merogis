let registerForm = document.querySelector('#reportForm')
let firstSending = document.querySelector('#first')
let createForm = function (select) {
    let firstSelect = new FormData()
    firstSelect.append('first', select)


    fetch('http://localhost/Projet_Fin_Annee/models/ajax_creating_form.php', {
        method: 'POST',
        headers: new Headers(),
        //body: JSON.stringify(person)
        body: firstSelect
    })
        .then((res) => res.json())
        .then((data) => {

            if (data.content.length !== 0) {
                cratedSelect(createSelect(data.content, data.content.length))
                createEndForm()
            } else {
                createTxtArea()
                createEndForm()
            }
        })
}

firstSending.addEventListener('change', function (e) {
    e.preventDefault()
    createForm(this.value)

})

function createSelect(e) {

    let select = document.createElement('select')
    select.setAttribute('id', 'second')
    select.setAttribute('name', 'second')
    for (let i = 0; i < e.length; i++) {
        let option = document.createElement('option')
        option.value = e[i].id
        option.innerText = e[i].motif_option
        select.appendChild(option)
    }
    return select
}

function cratedSelect(select, e) {
    if (registerForm.childElementCount > 2) {
        while (registerForm.childElementCount > 2) {
            registerForm.removeChild(registerForm.lastChild)
        }
    }


    registerForm.appendChild(select)
    createTxtArea(e)
}

function createTxtArea(e) {

    if (e === 0) {
        registerForm.removeChild(registerForm.lastChild)
    }
    if (registerForm.childElementCount >= 4) {
        while (registerForm.childElementCount > 2) {
            registerForm.removeChild(registerForm.lastChild)
        }
    }
    let area = document.createElement('textarea')
    area.setAttribute('placeholder', 'Décrivez votre problème ici')
    area.setAttribute('id', 'precision')
    area.setAttribute('name', 'precision')
    registerForm.appendChild(area)
}

function createEndForm() {
    let mail = document.createElement('input')
    let label = document.createElement('label')
    let submit = document.createElement('button')
    let span = document.createElement('span')

    span.setAttribute('id', 'sendingState')
    span.style.paddingTop = '10px'
    span.style.textAlign = 'center'



    label.setAttribute('for', 'email')
    label.innerText = '*Votre E-mail :'

    mail.setAttribute('type', 'email')
    mail.setAttribute('name', 'email')
    mail.setAttribute('id', 'email')
    mail.setAttribute('placeholder', 'email')

    submit.setAttribute('type', 'submit')
    submit.setAttribute('id', 'send')
    submit.innerText = 'Valider le signalement'


    registerForm.appendChild(label)
    registerForm.appendChild(mail)
    registerForm.appendChild(submit)
    registerForm.appendChild(span)

    submit.addEventListener('click', function (e) {
        e.preventDefault()
        register()
    })

    
}

let register = function () {
    fetch('http://localhost/Projet_Fin_Annee/models/ajax_send.php', {
        method: 'POST',
        headers: new Headers(),
        //body: JSON.stringify(person)
        body: new FormData(registerForm)
    })
        .then((res) => res.json())
        .then((data) => {
                let msgState = document.querySelector('#sendingState')
                if (data.type === 0) {
                   msgState.style.color = 'red'
                    msgState.innerText = data.msg
                }
                else {
                    msgState.style.color = 'green'
                    msgState.innerText = data.msg
                }
        })
}