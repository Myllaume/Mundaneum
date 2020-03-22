const ajaxLink = '/Mundaneum/core/controllers/rooter.php';
activeElements();

/**
 * ==============================================
 * Objets et méthodes de la page
 * ==============================================
 */

var page = {
    changeContent: function(html) {
        document.querySelector('#cible').innerHTML = html;
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
    redirect();
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

function redirect(pageName = true) {

    if (pageName === true) {
        pageURLArray = window.location.href.split("/");
        var pageName = pageURLArray[pageURLArray.length-1];
    }

    animLoadPage();

    setTimeout(function() {

        switch (pageName) {
            case 'publications':
                insertPublicationList();
                break;
    
            default:
                insertArticle(pageName);
                break;
        }

    }, 4000);
}

function insertPublicationList() {
    $.get( ajaxLink , { view: "publications" },
    function( html ) {
        
        page.changeContent(html);
    
        history.pushState({}, 'liste des publications', '/Mundaneum/publications');
        
        eval("activeElements();");
        
    }, 'html' )
    .fail(function (data) {
        console.error(data);
    })
}

function insertArticle(articleTitle) {
    $.get( ajaxLink , { view: "publications", title:  articleTitle},
    function( html ) {
        
        page.changeContent(html);
        
        history.pushState({}, 'article ' + articleTitle, '/Mundaneum/publications/' + articleTitle);

        eval("activeElements();");
        
    }, 'html' )
    .fail(function (data) {
        console.error(data);
    })
}