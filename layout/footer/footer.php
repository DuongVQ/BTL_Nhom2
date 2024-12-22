<script src="../../templates/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="../../templates/js/custom.js"></script>
<script>
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

    const swiper = new Swiper('.product-catalog .swiper-container', {
        slidesPerView: 4,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: '.catalog-next',
            prevEl: '.catalog-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });
</script>