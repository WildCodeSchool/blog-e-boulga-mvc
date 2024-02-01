let crown = document.querySelectorAll('.mainButton')
let articles = document.querySelector('.articles')
let filterButtons = document.querySelector('.filterButtons')

crown.forEach(function (element) {
    element.addEventListener('click', function () {
        let modalMain = document.querySelector('.modalMain')
        let modalMainButton = document.querySelector('.modalMainButton')
        let modalNoButton = document.querySelector('.modalNoButton')
        let articleTitleP = document.querySelector('.articleTitle')
        let articleTitle = element.dataset.title;
        let mainArticleId = element.dataset.id;

        modalMain.classList.add('displayed')
        articles.classList.add('blurred')
        filterButtons.classList.add('blurred')

        articleTitleP.innerHTML = "'" + articleTitle + "'"

        modalNoButton.addEventListener('click', function () {
            modalMain.classList.remove('displayed');
            articles.classList.remove('blurred')
            filterButtons.classList.remove('blurred')
        })

        modalMainButton.href = '/admin/article/main?id=' + mainArticleId
    })
})


