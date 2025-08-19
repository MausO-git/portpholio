const contactButton = document.querySelector('.menu .contactButton');
const contactZone = document.querySelector('#contact');
const arrow = document.querySelector('#contact .arrow');
const card = document.querySelector('.fonc');


const seeForm = ()=>{
    contactZone.style.right = '0'
};

const unseeForm = ()=>{
    contactZone.style.right = '-100%'
};

contactButton.addEventListener('click', seeForm);

arrow.addEventListener('click', unseeForm);

document.addEventListener("mousemove", (e) => {
    // récupérer la taille de la fenêtre
    const { innerWidth: width, innerHeight: height } = window;

    // position relative de la souris (-0.5 à +0.5)
    const x = (e.clientX / width) - 0.5;
    const y = (e.clientY / height) - 0.5;

    // multiplier pour donner un effet
    const rotateX = y * 25; // inclinaison haut-bas
    const rotateY = x * 25; // inclinaison gauche-droite

    card.style.transform = `rotateX(${rotateX*1.2}deg) rotateY(${rotateY}deg)`;
    card.style.boxShadow = `${-x*30}px ${y*30}px 50px rgba(0, 255, 0, 0.2)`;
});

// Reset quand la souris sort de la fenêtre
document.addEventListener("mouseleave", () => {
    card.style.transform = "rotateX(0) rotateY(0)";
    card.style.boxShadow = "none";
});