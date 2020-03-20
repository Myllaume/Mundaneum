function activeElements() {
    transformLinks();
}

/**
 * ==============================================
 * Desactivation des liens
 * ==============================================
 */

function transformLinks() {
    var links = document.querySelectorAll('a');

    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();

            var url = link.href.split("/");
            var articleTitle  = url[url.length-1];

            redirect(articleTitle);
            
        })
    });
}