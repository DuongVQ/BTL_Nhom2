document.addEventListener("DOMContentLoaded", () => {
    const swiper = new Swiper('.banner .swiper-container', {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        speed: 800,
        effect: 'slide',
        fadeEffect: {
            crossFade: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        lazy: true,
    });
});