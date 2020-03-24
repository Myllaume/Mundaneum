/**
 * ==============================================
 * Boutons du header
 * ==============================================
 */

var headerBtns = {
    menu: document.querySelector('#btn-heander-menu'),
    meta: document.querySelector('#btn-heander-meta'),
    search: document.querySelector('#btn-heander-search')
};

/**
 * ==============================================
 * Objets et méthodes du tirroire
 * ==============================================
 */

var tirroire = {
    this: document.querySelector('#tirroire'),
    conteneur: document.querySelector('#tirroire-conteneur'),
    isOpen: false,

    changeContent: function(html) {
        this.conteneur.innerHTML = html;
    },

    open: function() {
        tirroire.this.classList.add('tirroire--visible');
    },

    close: function() {
        tirroire.this.classList.remove('tirroire--visible');
    },

    toggle: function() {
        // ouverture et fermeture alternées du tirroire
        if (this.isOpen) {
            tirroire.close();
            this.isOpen = false;
        } else {
            tirroire.open();
            this.isOpen = true;
        }
    }
};

/**
 * ==============================================
 * Objets et méthodes du formulaire de recherche
 * ==============================================
 */

var formSearch = {
    this: document.createElement('form'),
    field: document.createElement('input'),
    btn: document.createElement('button'),

    gen: function() {
        tirroire.conteneur.innerHTML = '';

        this.this.classList.add('form-recherche');

        this.field.setAttribute('type', 'text');
        this.field.setAttribute('placeholder', 'Votre recherche');
        this.field.classList.add('form-recherche__field');
        
        this.btn.setAttribute('type', 'submit');
        this.btn.textContent = 'Rechercher';
        this.btn.classList.add('form-recherche__btn');

        this.this.appendChild(this.field);
        this.this.appendChild(this.btn);
        tirroire.conteneur.appendChild(this.this);
    }
};

/**
 * ==============================================
 * Évènements du tirroire
 * ==============================================
 */

Object.values(headerBtns).forEach(btn => {
    // tous les boutons du header activent 'tirroire.toggle'
    btn.addEventListener('click', tirroire.toggle);
});

headerBtns.menu.addEventListener('click', () => {
    
    $.get( '/Mundaneum/core/controllers/menu.php' , { type: "publications"},
    function( html ) {
        
        tirroire.changeContent(html);
        
    }, 'html' )
    .fail(function (data) {
        console.error(data);
    })
});

headerBtns.search.addEventListener('click', () => {
    formSearch.gen();
});