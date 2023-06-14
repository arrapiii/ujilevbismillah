// ==================
// | PRELOAD IMAGES |
// ==================

function preloadImg(url) {
    new Image().src = url;
}

preloadImg('./img/illustration-features-tab-1.svg');
preloadImg('./img/illustration-features-tab-2.svg');
preloadImg('./img/illustration-features-tab-3.svg');

// =====================
// | MOBILE NAVIGATION |
// =====================

// SELECTORS

const body = document.querySelector('body');
const header = document.querySelector('.header');
const menuBtn = document.querySelector('.menu-btn');

// FUNCTIONS

function toggleMobileNav() {
    header.classList.toggle('mobile-nav--active');
}

function disableScroll() {
    body.classList.toggle('disable-scroll');
}

// EVENT LISTENER(S)

menuBtn.addEventListener('click', () => {
    toggleMobileNav();
    disableScroll();
});

// ========
// | TABS |
// ========

// SELECTORS

const featureSection = document.querySelector('.feature');
const tabs = document.querySelector('.tabs');
const featureHeading = document.querySelector('.feature__heading');
const featureDescription = document.querySelector('.feature__description');
const featureImg = document.querySelector('.feature__img');

// DATA

let features = [
    {
        heading: 'Bu. Kasandra Fitriani N',
        description:
        'Perkenalkan Bu. Kasandra Fitriani Nurjanah, bisa di panggil juga Bu Caca. Bu Caca terkenal sangat lucu dan seru Lho! ketika mengajar di kelas.',
        imgPath: './images/bucaca.png',
        altText: 'dashboard',
    },
    {
        heading: 'Bpk. Ricky Sudrajat',
        description:
            'Perkenalkan Bpk. Ricky Sudrajat, bisa di panggil juga Pak Ricky. Pak Ricky terkenal tegas dan mengajari kami untuk selalu disiplin di lingkungan sekolah.',
        imgPath: './images/pakricky.png',
        altText: 'dashboard with magnifying glass',
    },
    {
        heading: 'Bu. Heni Siswanti',
        description:
            'Perkenalkan Bu. Heni Siswanti, bisa di panggil juga Bu Heni Siswanti. Bu Heni terkenal baik dan ramah di lingkungan sekolah',
        imgPath: './images/buheni.png',
        altText: 'people waving to each other',
    },
];

// FUNCTIONS

function changeTab(index) {
    function changeContent(index) {
        featureHeading.textContent = features[index].heading;
        featureDescription.textContent = features[index].description;
        featureImg.src = features[index].imgPath;
        featureImg.alt = features[index].altText;
    }

    featureSection.classList.add('fade-out');

    setTimeout(() => {
        changeContent(index);
        featureSection.classList.remove('fade-out');
    }, 1000);
}

function changeTabs(e) {
    for (tab of tabs.children) {
        tab.classList.remove('tabs__tab--active');
    }

    e.target.classList.add('tabs__tab--active');

    if (e.target.id === 'tab-1') {
        changeTab(0);
    } else if (e.target.id === 'tab-2') {
        changeTab(1);
    } else if (e.target.id === 'tab-3') {
        changeTab(2);
    }
}

// EVENT LISTENERS

tabs.addEventListener('click', (e) => {
    changeTabs(e);
});

tabs.addEventListener('keypress', (e) => {
    if (e.keyCode === 13) {
        changeTabs(e);
    }
});

// =================
// | RIPPLE EFFECT |
// =================

// SELECTORS

const loginBtn = document.querySelector('.header__nav__link--login');
const btns = document.querySelectorAll('.btn');

// FUNCTION(S)

function addRippleEffect(e) {
    e.addEventListener('click', (e) => {
        let boundingBox = e.target.getBoundingClientRect();
        let x = e.clientX - boundingBox.left;
        let y = e.clientY - boundingBox.top;

        let ripple = document.createElement('span');
        ripple.style.left = `${x}px`;
        ripple.style.top = `${y}px`;
        ripple.classList.add('ripple');

        e.target.appendChild(ripple);

        setTimeout(() => {
            ripple.remove();
        }, 800);
    });
}

// EVENT LISTENERS

addRippleEffect(loginBtn);

btns.forEach((btn) => {
    addRippleEffect(btn);
});

// ===============
// | ATTRIBUTION |
// ===============

const pop = new Audio('./audio/pop.mp3');
const whoosh = new Audio('./audio/whoosh.mp3');

const attribution = document.querySelector('.attribution');
const attributionImg = document.querySelector('.attribution__img');

attributionImg.addEventListener('click', () => {
    if (attribution.classList.contains('attribution-active')) {
        whoosh.play();
    } else {
        pop.play();
    }
    attribution.classList.toggle('attribution-active');
});