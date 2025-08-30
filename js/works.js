let page;
if(sessionStorage.getItem('page') === null){
    page = 1;
    sessionStorage.setItem('page', page);
}else{
    page = parseInt(sessionStorage.getItem('page'));
}

const works = document.querySelector('#works');
const contactButton = document.querySelector('.menu .contactButton');
const contactZone = document.querySelector('#contact');
const arrow = document.querySelector('#contact .arrow');
const backTop = document.querySelector('.backTop');

const seeForm = ()=>{
    contactZone.style.right = '0'
};

const unseeForm = ()=>{
    contactZone.style.right = '-100%'
};

const closePres = ()=>{
    const pres = document.querySelector('.groupName .pres');
    console.log(pres);
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

arrow.addEventListener('click', unseeForm);

const chargerPage = (p)=>{
    fetch("siteapi.php?page=" + p)
        .then(res => res.text())
        .then(data => {
            works.innerHTML = data
            const pre = document.querySelector('.pre');
            const next = document.querySelector('.next');
            const pButtons = document.querySelectorAll('.pageButton');
            const tabButton = Array.from(pButtons);
            console.log(tabButton.length)
            pButtons.forEach(pButton =>{
                pButton.addEventListener('click', ()=>{
                    page = parseInt(pButton.textContent);
                    sessionStorage.setItem('page', page);
                    chargerPage(page);
                })
            })

            next.addEventListener("click", () => {
                if(page === tabButton.length) return;
                page++;
                sessionStorage.setItem('page', page);
                chargerPage(page);
            });
            pre.addEventListener("click", ()=>{
                if(page === 1) return;
                page--;
                sessionStorage.setItem('page', page);
                chargerPage(page);
            })
        });
}

chargerPage(page);

backTop.addEventListener('click',()=>{
    window.scrollTo({top:0, behavior:'smooth'})
})

const checkbacktop = ()=>{
    const posScroll = document.body.scrollTop || document.documentElement.scrollTop
    if(posScroll>200){
        backTop.style.bottom = "50px"
    }else{
        backTop.style.bottom = "-100px"
    }
}

window.addEventListener('scroll', checkbacktop)

//gestion menu burger

const burg = document.querySelector('.burg');
const allCub = document.querySelectorAll('.burg .cube');
console.log(allCub)
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







