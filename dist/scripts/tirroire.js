/**
 * ==============================================
 * Boutons et méthodes d'action du header
 * ==============================================
 */

var headerActions = {
    btn: {
        menu: document.querySelector('#btn-heander-menu'),
        meta: document.querySelector('#btn-heander-meta'),
        search: document.querySelector('#btn-heander-search')
    },

    switch: function(btn) {
        switch (btn) {
            case this.btn.menu:
                genMenu();
                break;
    
            case this.btn.search:
                formSearch.gen();
                break;
    
            case this.btn.meta:
                
                break;
        }
    }
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
        this.this.classList.add('tirroire--visible');
    },

    close: function() {
        this.this.classList.remove('tirroire--visible');
        setTimeout(function() { this.conteneur.innerHTML = ''; }.bind(this), 500);
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

        formSearch.this.classList.add('form-recherche');

        formSearch.field.setAttribute('type', 'text');
        formSearch.field.setAttribute('placeholder', 'Votre recherche');
        formSearch.field.classList.add('form-recherche__field');
        
        formSearch.btn.setAttribute('type', 'submit');
        formSearch.btn.textContent = 'Rechercher';
        formSearch.btn.classList.add('form-recherche__btn');

        formSearch.this.appendChild(formSearch.field);
        formSearch.this.appendChild(formSearch.btn);
        tirroire.conteneur.appendChild(formSearch.this);
    }
};

/**
 * ==============================================
 * Évènements du tirroire
 * ==============================================
 */

Object.values(headerActions.btn).forEach(btn => {
    // tous les boutons du header activent 'tirroire.toggle'
    btn.addEventListener('click', (e) => {
        if (!tirroire.isOpen) {
            tirroire.isOpen = e.target;

            tirroire.open();
            headerActions.switch(e.target);
        } else if (tirroire.isOpen === e.target) {
            tirroire.isOpen = false;
            
            tirroire.close();
        } else {
            tirroire.isOpen = e.target;

            tirroire.close();
            setTimeout(function() {
                tirroire.open();
                headerActions.switch(e.target);
            }.bind(this), 1000);
        }
    });
});

function genMenu() {
    setTimeout(() => {
        $.get( '/Mundaneum/core/controllers/menu.php' , { type: "publications"},
        function( html ) {
            
            tirroire.changeContent(html);
            
        }, 'html' )
        .fail(function (data) {
            console.error(data);
        })
    }, 100);
}