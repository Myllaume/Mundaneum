function animLoadPage(fx) {
    const conteneur = document.querySelector('.main-page');
    const rotateLogo = document.querySelector('.logo-site__bg');
    conteneur.classList.add('main-page--hidden');
    rotateLogo.classList.add('rotate-animation');

    setTimeout(function() {
        conteneur.classList.remove('main-page--hidden');
        rotateLogo.classList.remove('rotate-animation');

        fx();
    }, 5000);
}