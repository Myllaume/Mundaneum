/**
 * ==============================================
 * Animation de chargement de la page
 * ==============================================
 */

function animLoadPage() {
    const conteneur = document.querySelector('.main-page');
    const rotateLogo = document.querySelector('.logo-site__bg');
    conteneur.classList.add('main-page--hidden');
    rotateLogo.classList.add('rotate-animation');
    page.scroll(false);

    setTimeout(function() {
        conteneur.classList.remove('main-page--hidden');
        rotateLogo.classList.remove('rotate-animation');
        page.scroll(true);
    }, 5000);
}