let modal = document.querySelector('.background')
let wrong = document.querySelector('#wrong')
let right = document.querySelector('#right')
let personnal = document.querySelector('.personalInfo')

let confirm = function (btn) {
    let confirmed = new FormData()
    confirmed.append('is_confirmed', btn)

    fetch('http://localhost/Projet_Fin_Annee/models/update_user.php', {
        method: 'POST',
        headers: new Headers(),
        //body: JSON.stringify(person)
        body: confirmed
    })
        .then((res) => res.json())
        .then((data) => {
            console.log(localStorage)
            personnal.style.display = 'none'
        })


}

function closeModal() {
        modal.style.display = 'none'
}

if (wrong !== null){
wrong.addEventListener('click', function (e) {
    e.preventDefault()
    closeModal()
})

right.addEventListener('click', function (e) {
    e.preventDefault()
    closeModal()
    confirm(this.value)

})
}
