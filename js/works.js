let page = 1;
const works = document.querySelector('#works');

const chargerPage = (p)=>{
    fetch("siteapi.php?page=" + p)
        .then(res => res.text())
        .then(data => {
            works.innerHTML = data
        });
}

chargerPage();