const btnHeaderMenu = document.querySelector('#btn-heander-menu');
const tirroire = document.querySelector('#tirroire');

console.log('lalla');
btnHeaderMenu.addEventListener('click', () => {
    
    $.get( '/Mundaneum/core/controllers/menu.php' , { type: "publications"},
    function( html ) {
        
        tirroire.innerHTML = html;
        
    }, 'html' )
    .fail(function (data) {
        console.error(data);
    })
});