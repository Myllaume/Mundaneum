function animLoadPage() {
    const conteneur = document.querySelector('.main-page');
    const rotateLogo = document.querySelector('.logo-site__bg');
    conteneur.classList.add('main-page--hidden');
    rotateLogo.classList.add('rotate-animation');
    document.body.style.overflow = 'hidden';

    setTimeout(function() {
        conteneur.classList.remove('main-page--hidden');
        rotateLogo.classList.remove('rotate-animation');
        document.body.style.overflow = 'auto';
    }, 5000);
}