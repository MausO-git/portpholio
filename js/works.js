let page = 1;
const works = document.querySelector('#works');
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
                    chargerPage(page);
                })
            })

            next.addEventListener("click", () => {
                if(page === tabButton.length) return;
                page++;
                chargerPage(page);
            });
            pre.addEventListener("click", ()=>{
                if(page === 1) return;
                page--;
                chargerPage(page);
            })
        });
}

chargerPage(page);



