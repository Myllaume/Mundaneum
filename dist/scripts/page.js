var cible = document.querySelector('#cible');
const ajaxLink = '/Mundaneum/core/controllers/rooter.php';

var homePage = {
    conteneur: document.querySelector('.home-content'),
    roll: document.querySelector('.home-roll'),

    open: function() {
        this.conteneur.classList.remove('home-content--hide');
        document.body.style.overflow = 'hidden';
    },

    close: function() {
        this.conteneur.classList.add('home-content--hide');
        document.body.style.overflow = 'auto';
    }
};

homePage.roll.addEventListener('click', () => {
    homePage.close();
    insertPublicationList();
});

function insertPublicationList() {
    $.get( ajaxLink , { view: "publications" },
    function( html ) {
        
        cible.innerHTML = html;
        
        var stateObj = {};
        history.pushState(stateObj, "liste des publications", "publications");
        eval("transformLinks();");
        
    }, 'html' )
    .fail(function (data) {
        console.error(data);
    })
}

function insertArticle(articleTitle) {
    $.get( ajaxLink , { view: "publications", title:  articleTitle},
    function( html ) {
        console.log(html);
        
        cible.innerHTML = html;
        
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

            insertArticle(articleTitle);
            
        })
    });
}