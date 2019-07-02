let date = document.querySelector('#date')
let picker = document.querySelector('.middle')
let container = document.querySelector('.articlesContainer')

let getArticle = function (input) {
    let firstSelect = new FormData()
    firstSelect.append('published_at', input)


    fetch('http://localhost/Projet_Fin_Annee/models/event_filter.php', {
        method: 'POST',
        headers: new Headers(),
        //body: JSON.stringify(person)
        body: firstSelect
    })
        .then((res) => res.json())
        .then((data) => {
            if(data.type === 1)
            createArticle(data.content)
            else if (data.type === 2)
                noArticle(data)
        })
}
date.addEventListener('change', function () {
    getArticle(this.value)
})

function createArticle(e) {
    if (container.childElementCount !== 0) {
        while (container.childElementCount !== 0 ) {
            container.removeChild(container.lastChild)
        }
    }
    
    for (let i = 0; i < e.length; i++) {
        let article = document.createElement('div')
        article.classList.add('article')
        let imgContainer = document.createElement('div')
        imgContainer.classList.add('img')
        let img = document.createElement('img')
        let title = document.createElement('h4')
        let resume = document.createElement('p')
        let link = document.createElement('a')
        let btn = document.createElement('button')

        img.setAttribute('src', 'assets/images/'+e[i].image)
        title.innerText = e[i].title
        resume.innerText = e[i].summary
        link.setAttribute('href', 'index.php?page=article&event_id='+e[i].id)
        btn.innerText = 'En savoir plus'
        link.appendChild(btn)
        imgContainer.appendChild(img)
        article.appendChild(imgContainer)
        article.appendChild(title)
        article.appendChild(resume)
        article.appendChild(link)
        container.appendChild(article)
    }

    scrollTo(0,0)
}

function noArticle(e) {
    if (container.childElementCount !== 0) {
        while (container.childElementCount !== 0 ) {
            container.removeChild(container.lastChild)
        }
    }
    let nothing = document.createElement('h3')
    nothing.innerText = e.msg
    container.appendChild(nothing)
}

window.onscroll = function() {scrollPicker()};

function scrollPicker() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        picker.style.background = 'white'
    }
    else picker.style.background = 'unset'
}
scrollPicker()