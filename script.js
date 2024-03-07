
// INDEX SCRIPT
window.addEventListener("scroll", function() {
    var header = document.querySelector("header");
    header.classList.toggle('sticky', window.scrollY > 0);
});

var menu = document.querySelector('.menu');
var menubtn = document.querySelector('.menu-btn');
var closebtn = document.querySelector('.close-btn');

menubtn.addEventListener("click", () => {
    menu.classList.add('active');
});

closebtn.addEventListener("click", () => {
    menu.classList.remove('active');
});


// 