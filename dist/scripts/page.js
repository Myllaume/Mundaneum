const ajaxLink = '/Mundaneum/core/controllers/rooter.php';

var page = {
    conteneur: document.querySelector('#cible'),

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
    switch (page.getName()) {
        case 'publications':
            insertPublicationList();
            break;

        default:
            insertArticle(newPageName);
            break;
    }
};

var homePage = {
    conteneur: document.querySelector('.home-content'),
    roll: document.querySelector('.home-roll'),
    btnBack: document.querySelector('#back-to-menu'),

    open: function() {
        this.conteneur.classList.remove('home-content--hide');
        
        page.goTop();
        page.scroll(false);

        var stateObj = {};
        history.pushState(stateObj, "menu", "./");
    },

    close: function() {
        this.conteneur.classList.add('home-content--hide');
        page.scroll(true);
    }
};

homePage.roll.addEventListener('click', () => {
    homePage.close();
    insertPublicationList();
});

homePage.btnBack.addEventListener('click', () => {
    homePage.open();
})

function insertPublicationList() {
    $.get( ajaxLink , { view: "publications" },
    function( html ) {
        
        page.conteneur.innerHTML = html;
        
        var stateObj = {};
        history.pushState(stateObj, "liste des publications", "./publications");
        eval("transformLinks();");
        
    }, 'html' )
    .fail(function (data) {
        console.error(data);
    })
}

function insertArticle(articleTitle) {
    $.get( ajaxLink , { view: "publications", title:  articleTitle},
    function( html ) {
        page.conteneur.innerHTML = html;
        
        var stateObj = {};
        history.pushState(stateObj, "liste des publications", "publications/" + articleTitle);
        eval("transformLinks();");
        
    }, 'html' )
    .fail(function (data) {
        console.error(data);
    })
}

function transformLinks() {
    var links = document.querySelectorAll('a');

    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();

            var url = link.href.split("/");
            var articleTitle  = url[url.length-1];

            animLoadPage();

            setTimeout(function() {
                insertArticle(articleTitle);
            }, 5000);
            
        })
    });
}

transformLinks();