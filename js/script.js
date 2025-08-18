const contactButton = document.querySelector('.menu .contactButton');
const contactZone = document.querySelector('#contact');
const arrow = document.querySelector('#contact .arrow');


const seeForm = ()=>{
    contactZone.style.right = '0'
};

const unseeForm = ()=>{
    contactZone.style.right = '-100%'
};

contactButton.addEventListener('click', seeForm);

arrow.addEventListener('click', unseeForm);