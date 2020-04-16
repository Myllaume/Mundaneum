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
    
            case 'donnees':

                if (pageName == 'donnees_list') {
                    // insertPublicationList();
                } else {
                    insertDonnees(pageName);
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

function insertDonnees(donneesTitle) {
    $.get( ajaxLink , { view: "donnees", title:  donneesTitle},
    function( json ) {
        
        page.changeContent(json);
        
        history.pushState({
            type: 'donnees',
            title: donneesTitle
        }, 'article ' + donneesTitle, '/Mundaneum/donnees/' + donneesTitle);

        eval('activeElements();');
        
    }, 'json' )
    .fail(function (data) {
        console.error(data);
    })
}