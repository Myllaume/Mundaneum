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
            var url = link.href.split("/");            

            if (url[url.length-3] != 'Mundaneum') {
                return;
            }
            
            e.preventDefault();
            var pageName = url[url.length-1];
            var pageType = url[url.length-2];


            redirect(pageName, pageType);
            
        })
    });
}