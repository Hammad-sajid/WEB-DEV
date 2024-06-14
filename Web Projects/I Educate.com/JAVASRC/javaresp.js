burger = document.querySelector('.burger');
navbar = document.querySelector('.navbar');
left = document.querySelector('.left-nav');
right = document.querySelector('.right-nav');


burger.addEventListener('click', ()=> {
    right.classlist.toggle(".v-resp");
    left.classlist.toggle(".v-resp");
    navbar.classlist.toggle(".h-nav");

});
function click(){
    alert('Form i submitted');
};