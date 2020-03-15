const cursor = document.createElement('div');
cursor.classList.add('cursor');
document.body.appendChild(cursor);

document.body.addEventListener('mousemove', (e) => {
    var x = e.clientX;
    var y = e.clientY;

    cursor.style.top = y + 3 + 'px';
    cursor.style.left = x - 1 + 'px';
});

window.addEventListener('scroll', (e) => {
    cursor.style.top += window.scrollY + 'px';
    
});