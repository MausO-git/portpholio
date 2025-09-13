const contactButton = document.querySelector('.menu .contactButton');
const contactZone = document.querySelector('#contact');
const arrow = document.querySelector('#contact .arrow');
const card = document.querySelector('.fonc');
const nom = document.querySelector('.nom');
const gnom = document.querySelector('.groupName');
const cta = document.querySelector('.cta');
const mailInput = document.querySelector('form .form-group .mail');

const seeForm = ()=>{
    contactZone.style.right = '0'
};

const unseeForm = ()=>{
    contactZone.style.right = '-100%'
};

const closePres = ()=>{
    const pres = document.querySelector('.groupName .pres');
    if(!pres) return

    pres.style.transform = 'translate(-50%, -35%) scale(0)';
    setTimeout(()=>{
        gnom.removeChild(pres);
    }, 300)

}

contactButton.addEventListener('click',()=>{
    seeForm();
    closePres();
});
cta.addEventListener('click',()=>{
    seeForm();
    closePres();
})

window.addEventListener('resize', ()=>{
    if(window.innerWidth <= 545){
        mailInput.placeholder = 'Votre e-mail'
    }else{
        mailInput.placeholder = 'Votre adresse e-mail'
    }
})

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

nom.addEventListener('click', ()=>{
    if(getComputedStyle(contactZone).right === "0px") return;
    const newDiv = document.createElement('div');
    newDiv.innerHTML = `
        <p>
            \\\\Bonjour, je suis Oscar Maus, jeune développeur web motivé à concevoir des sites clairs, efficaces et sécurisés. Passionné par le code, je m’appuie sur différentes technologies du web et reste toujours curieux d’en apprendre de nouvelles afin d’élargir mes compétences et relever de nouveaux défis.
        </p>
        <div class='cross'>
            <img src='images/pxcross.png' >
        </div>
    `;
    newDiv.classList.add('pres');
    gnom.appendChild(newDiv);
    const pres = document.querySelector('.pres');
    setTimeout(()=>{
        pres.style.transform = 'translate(-50%, -35%) scale(1)'
    }, 300)
    const cross = document.querySelector('.cross')
    cross.addEventListener('click', ()=>{
        pres.style.transform = 'translate(-50%, -35%) scale(0)'
        setTimeout(()=>{
            gnom.removeChild(pres);
        }, 300)
    })
    

})

//gestion menu burger

const burg = document.querySelector('.burg');
const allCub = document.querySelectorAll('.burg .cube');
const bars = document.querySelectorAll('.bar');
const cubs1 = bars[0].querySelectorAll('.cube')
const cubs2 = bars[1].querySelectorAll('.cube')
const cubs3 = bars[2].querySelectorAll('.cube')
const menuB = document.querySelector('.menB');
const contB = document.querySelector('.menuIn .contactButton');

const size = 6

const crosstobar = ()=>{
    allCub.forEach(cub =>{
        cub.style.transform = '';
        cub.style.opacity = '1';
    })
}

burg.addEventListener('click', ()=>{
    closePres();
    menuB.classList.toggle('view')
    if(burg.classList.contains('clicked')){
        crosstobar();
    }else{
        cubs1.forEach((cub, ind)=>{
            if((ind === 1) || (ind === 3)){
                cub.style.transform = `translate(0, ${size}px)`
            }
            if(ind === 2){
                cub.style.opacity = '0'
            }
        })
    
        cubs3.forEach((cub, ind)=>{
            if((ind === 1) || (ind === 3)){
                cub.style.transform = `translate(0, -${size}px)`
            }
            if(ind === 2){
                cub.style.opacity = '0'
            }
        })
    
        cubs2.forEach((cub, ind)=>{
            if(ind !== 2){
                cub.style.opacity = '0'
            }
        })
    }

    burg.classList.toggle('clicked');
})

contB.addEventListener('click',()=>{
    seeForm();
    crosstobar();
    burg.classList.remove('clicked');
    menuB.classList.remove('view')
});



