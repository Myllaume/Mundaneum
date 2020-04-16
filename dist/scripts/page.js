const ajaxLink = '/Mundaneum/core/controllers/rooter.php';
activeElements();

/**
 * ==============================================
 * Objets et méthodes de la page
 * ==============================================
 */

var page = {
    changeContent: function(json) {
        document.querySelector('#cible').innerHTML = json.html;
        document.title = json.title;
    },

    getName: function() {
        var pageURL = window.location.href;
        pageURLArray = pageURL.split("/");
        return pageURLArray[pageURLArray.length-1];
    },

    scroll: function(bool) {
        if (bool === true) {
            document.body.style.overflow = 'auto';
        } else {
            document.body.style.overflow = 'hidden';
        }
    },

    goTop: function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
}

window.onpopstate = function(event) {
    console.log(event.state);
    
    redirect(event.state.title, event.state.type);
};

var homePage = {
    conteneur: document.querySelector('.home-content'),
    roll: document.querySelector('.home-roll'),
    btnBack: document.querySelector('#back-to-menu'),

    open: function() {
        this.conteneur.classList.remove('home-content--hide');
        
        page.goTop();
        page.scroll(false);
    },

    close: function() {
        this.conteneur.classList.add('home-content--hide');
        page.scroll(true);
    }
};

/**
 * ==============================================
 * Mouvements de la page
 * ==============================================
 */

homePage.roll.addEventListener('click', () => {
    homePage.close();
    insertPublicationList();
});

homePage.btnBack.addEventListener('click', () => {
    homePage.open();
})

/**
 * ==============================================
 * Chargement des contenus
 * ==============================================
 */

function redirect(pageName, pageType) {

    animLoadPage();

    setTimeout(function() {

        sessionStorage.setItem('title', pageName);
        

        switch (pageType) {
            case 'publications':

                if (pageName == 'publications_list') {
                    insertPublicationList();
                } else {
                    insertArticle(pageName);
                }

                break;
    
            case 'publications_en':

                if (pageName == 'publications_list_english') {
                    insertPublicationListEnglish();
                } else {
                    insertArticleEnglish(pageName);
                }

                break;
        }

    }, 4000);
}

function insertPublicationList() {
    $.get( ajaxLink , { view: "publications" },
    function( json ) {
        
        page.changeContent(json);
    
        history.pushState({
            type: 'publications',
            title: 'publications_list'
        }, 'liste des publications', '/Mundaneum/publications');
        
        eval('activeElements();');
        
    }, 'json' )
    .fail(function (data) {
        console.error(data);
    })
}

function insertPublicationListEnglish() {
    $.get( ajaxLink , { view: "publications_en" },
    function( json ) {
        
        page.changeContent(json);
    
        history.pushState({
            type: 'publications_en',
            title: 'publications_list_english'
        }, 'liste des publications', '/Mundaneum/publications_en');
        
        eval('activeElements();');
        
    }, 'json' )
    .fail(function (data) {
        console.error(data);
    })
}

function insertArticle(articleTitle) {
    $.get( ajaxLink , { view: "publications", title:  articleTitle},
    function( json ) {
        
        page.changeContent(json);
        
        history.pushState({
            type: 'publications',
            title: articleTitle
        }, 'article ' + articleTitle, '/Mundaneum/publications/' + articleTitle);

        eval('activeElements();');
        
    }, 'json' )
    .fail(function (data) {
        console.error(data);
    })
}

function insertArticleEnglish(articleTitle) {
    $.get( ajaxLink , { view: "publications_en", title:  articleTitle},
    function( json ) {
        
        page.changeContent(json);
        
        history.pushState({
            type: 'publications_en',
            title: articleTitle
        }, 'article ' + articleTitle, '/Mundaneum/publications_en/' + articleTitle);

        eval('activeElements();');
        
    }, 'json' )
    .fail(function (data) {
        console.error(data);
    })
}