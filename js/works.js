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

contactButton.addEventListener('click', seeForm);
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



