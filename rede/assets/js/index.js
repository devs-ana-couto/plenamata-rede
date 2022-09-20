const headerLp = document.querySelector('.header__lp');
var boxLink = document.querySelectorAll(".box-link");

var $ = jQuery;


var count = boxLink.length;
var i = 0;
var timer = 10000;
var timerSctipt = setInterval(() => {
    if (count > i) {
        startSlider(`controller-${i}`, false);
        i++;
    } else {
        i = 0;
        startSlider(`controller-${i}`, false);
    }
}, timer);

function startSlider(id, autoplay) {
    setController(id, boxLink);
    if (autoplay) {
        clearInterval(timerSctipt);
    }
}


function setController(id, boxLink) {

    var boxContent = headerLp.querySelector('.box-content');
    var tag = boxContent.querySelector('.content-tag p');
    var title = boxContent.querySelector('.content-title h1');
    var linkCta = boxContent.querySelector('.box-cta a');

    boxLink.forEach((link, index) => {
        var linkId = link.getAttribute("id");
        if (id === linkId) {

            link.classList.add("active");
            var tagLink = link.querySelector('.tag-name');
            tag.textContent = tagLink.textContent;

            var titleLink = link.querySelector('.link-controller p');
            title.textContent = titleLink.textContent;

            var linkSlider = link.querySelector('.link-cta');
            var linkHref = linkSlider.getAttribute('href');

            linkCta.setAttribute("href", linkHref);
            linkCta.textContent = linkSlider.textContent;

            var largura = window.innerWidth
                || document.documentElement.clientWidth
                || document.body.clientWidth;

            if(largura <= 991){
                var linkImage = link.querySelector('img.mobile').getAttribute('src');
                headerBackground = document.querySelector('.header__lp');
                headerBackground.style.backgroundImage = `url('${linkImage}')`;
            }else{
                var linkImage = link.querySelector('img.desk').getAttribute('src');
                headerBackground = document.querySelector('.header__lp');
                headerBackground.style.backgroundImage = `url('${linkImage}')`;
            }
            console.log('linkImage', linkId, largura, linkImage);
        } else {
            link.classList.remove("active");
        }
    });
}

if (headerLp !== "" || headerLp !== null) {
    startSlider("controller-0");
}

function activeShare(id) {
    let idValue = `${id}`;
    console.log(idValue);
    let mediaForm = document.querySelector(idValue);
    let linkCta = mediaForm.querySelector(".compartilhe-cta");
    let midiasAtivas = mediaForm.querySelector(".midas-ativas");
    linkCta.classList.remove("active");
    midiasAtivas.classList.add("active");
}

function defaultShared(id) {
    let idValue = `${id}`;
    let mediaForm = document.querySelector(idValue);
    let linkCta = mediaForm.querySelector(".compartilhe-cta");
    let midiasAtivas = mediaForm.querySelector(".midas-ativas");
    linkCta.classList.add("active");
    midiasAtivas.classList.remove("active")
}

var ctaCompatilhe = document.querySelector('#compartilhe-cta');

ctaCompatilhe.addEventListener("click", (event) => {
    event.preventDefault();
    console.log('teste')
});

function setaAncora(id) {
    var navRight = document.querySelector(".nav-right");
    var navList = navRight.querySelectorAll("li.navList");

    navList.forEach((dado, index) => {
        var link = dado.querySelector("a").getAttribute("href");
        var idTratado = "#" + id;
        if (link === idTratado) {
            dado.classList.add("active");
        } else {
            dado.classList.remove("active")
        }
    });
}

$('#carousel-master-class').owlCarousel({
    loop: false,
    margin: 47,
    //autoWidth: true,
    nav: true,
    responsive: {
        0: {
            items: 2
        },

        1000: {
            items: 3
        }
    }
});

function filtroNews(id) {
    var tools = document.querySelector(".tools");
    var colCards = tools.querySelectorAll(".col-cards");

    var idLinkButtom = tools.querySelectorAll(".list-group-item");

    idLinkButtom.forEach((links, index) => {

        if (links.getAttribute("id") === id) {
            links.classList.add("active");
        } else {
            links.classList.remove("active");
        }
    });


    colCards.forEach((card, index) => {
        var cardInfos = card.querySelector(".card");
        var targetCard = cardInfos.getAttribute("data-bs-target");

        if (targetCard === id) {
            card.classList.remove('d-none');
        } else if (id === "todos") {
            card.classList.remove("d-none");
        } else {
            card.classList.add('d-none');
        }
    });
}

$('#carousel-calendar').owlCarousel({
    loop: false,
    margin: 47,
    //autoWidth: true,
    nav: true,
    responsive: {
        0: {
            items: 1
        },

        1000: {
            items: 2
        }
    }
});
$(document).ready(function () {
        $('#startModal').modal('show');
})

function startCalendary(id, mesNumber, validaOnclick) {
    let boxDate = document.querySelector(".box-dates");
    let dataListId = boxDate.querySelectorAll('.list-group-item');

    let month = Date.now();
    month = new Date(month);
    month = month.getMonth();

    if (validaOnclick) {
        dataListId.forEach((data, index) => {
            let idData = data.getAttribute("id");
            if (id === idData) {
                data.classList.add('active');
            } else {
                data.classList.remove('active');
            }
        });
    }
}
//Constrói a URL depois que o DOM estiver pronto
document.addEventListener("DOMContentLoaded", function() {
    //altera a URL do botão
    document.getElementById("facebook-share-btt").href = "https://www.facebook.com/sharer/sharer.php?u=" + encodeURIComponent(window.location.href);
}, false);
//Constrói a URL depois que o DOM estiver pronto
document.addEventListener("DOMContentLoaded", function() {
    var url = encodeURIComponent(window.location.href);
    var titulo = encodeURIComponent(document.title);
    //var via = encodeURIComponent("usuario-twitter"); //nome de usuário do twitter do seu site
    //altera a URL do botão
    document.getElementById("twitter-share-btt").href = "https://twitter.com/intent/tweet?url="+url+"&text="+titulo;

    //se for usar o atributo via, utilize a seguinte url
    //document.getElementById("twitter-share-btt").href = "https://twitter.com/intent/tweet?url="+url+"&text="+titulo+"&via="+via;
}, false);
linkedin = function (event, s, a){
    event.preventDefault();
    window.open('https://www.linkedin.com/cws/share?url=' +s+ '?name=' +a, 'newwindow', 'width=680, height=450');
};

//Constrói a URL depois que o DOM estiver pronto
document.addEventListener("DOMContentLoaded", function() {
    var url = encodeURIComponent(window.location.href); //url
    var titulo = encodeURIComponent(document.title); //título
    var linkedinLink = "https://www.linkedin.com/shareArticle?mini=true&url="+url+"&title="+titulo;

    //tenta obter o conteúdo da meta tag description
    var summary = document.querySelector("meta[name='description']");
    summary = (!!summary)? summary.getAttribute("content") : null;

    //se a meta tag description estiver ausente...
    if(!summary){
        //...tenta obter o conteúdo da meta tag og:description
        summary = document.querySelector("meta[property='og:description']");
        summary = (!!summary)? summary.getAttribute("content") : null;
    }
    //altera o link do botão
    linkedinLink = (!!summary)? linkedinLink + "&summary=" + encodeURIComponent(summary) : linkedinLink;
    document.getElementById("linkedin-share-btt").href = linkedinLink;
}, false);