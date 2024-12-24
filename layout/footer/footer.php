<!-- FOOTER -->
<footer>
    <div class="list-item-footer">
        <div class="item-footer">
            <h3>Thời trang nam TORANO</h3>
            <span>
                Hệ thống thời trang cho phái mạnh hàng đầu Việt Nam,
                hướng tới phong cách nam tính, lịch lãm và trẻ trung.
            </span>
            <div class="list-icon-contact">
                <a href="#">
                    <div class="wrapper-icon-contact">
                        <box-icon type='logo' name='facebook'></box-icon>
                    </div>
                </a>
                <a href="#">
                    <div class="wrapper-icon-contact">
                        <box-icon name='twitter' type='logo'></box-icon>
                    </div>
                </a>
                <a href="#">
                    <div class="wrapper-icon-contact">
                        <box-icon name='instagram' type='logo'></box-icon>
                    </div>
                </a>
                <a href="#">
                    <div class="wrapper-icon-contact">
                        <box-icon name='tiktok' type='logo'></box-icon>
                    </div>
                </a>
                <a href="#">
                    <div class="wrapper-icon-contact">
                        <box-icon name='youtube' type='logo'></box-icon>
                    </div>
                </a>
            </div>
            <div class="payment-method">
                <p>Phương thức thanh toán</p>
                <div class="list-payment">
                    <img src="../../templates/image/vnpay-logo-inkythuatso-01-13-16-26-42.jpg" alt="">
                    <img src="../../templates/image/16823b123741383.60f52918409cc.jpg" alt="">
                    <img src="../../templates/image/visa.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="item-footer">
            <h3>Thông tin liên hệ</h3>
            <ul class="list-unstyled">
                <li>
                    <span><b>Địa chỉ:</b> Thôn Sơn Bình, xã Văn Quán, huyện Lập Thạch, tỉnh Vĩnh Phúc</span>
                </li>
                <li>
                    <span><b>Điện thoại:</b> 0967083126</span>
                </li>
                <li>
                    <span><b>Fax:</b> 0904636356c</span>
                </li>
                <li>
                    <span><b>Email:</b> duongvq392@gmail.com</span>
                </li>
            </ul>
            <div class="payment-method">
                <p>Phương thức vận chuyển</p>
                <div class="list-payment">
                    <img src="../../templates/image/GHN.jpg" alt="">
                    <img src="../../templates/image/aha.jpg" alt="">
                    <img src="../../templates/image/jtexpress.jpg" alt="">
                </div>
            </div>
        </div>
        <div class="item-footer">
            <h3>Nhóm liên kết</h3>
            <ul class="">
                <li>
                    <span>Tìm kiếm</span>
                </li>
                <li>
                    <span>Giới thiệu</span>
                </li>
                <li>
                    <span>Chính sách đổi trả</span>
                </li>
                <li>
                    <span>Chính sách bảo mật</span>
                </li>
                <li>
                    <span>Tuyển dụng</span>
                </li>
                <li>
                    <span>Liên hệ</span>
                </li>
            </ul>
        </div>
        <div class="item-footer">
            <h3>Đăng ký nhận tin</h3>
            <span>Để cập nhật những sản phẩm mới, nhận thông tin ưu đãi đặc biệt và thông tin giảm giá khác.</span>
            <div class="subscribe d-flex align-items-center bg-white">
                <box-icon name='envelope'></box-icon>
                <input type="text" name="" id="" placeholder="Nhập email của bạn" class="border-0">
                <button type="submit" class="btn btn-primary">Đăng ký</button>
            </div>
            <img class=" ls-is-cached lazyloaded" data-src="//theme.hstatic.net/200000690725/1001078549/14/footer_logobct_img.png?v=614" src="//theme.hstatic.net/200000690725/1001078549/14/footer_logobct_img.png?v=614" alt="Bộ Công Thương">
        </div>
    </div>
    <div class="design-by">
        Copyright © 2024 Torano.
        <a href="https://web.facebook.com/profile.php?id=100052964461410" target="_blank">
            Powered by DuongVQ
        </a>
    </div>
</footer>


<script src="../../templates/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="../../templates/js/custom.js"></script>
<script>
    // Slide banner
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

    // Slide product catalog
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

    // Slide product sale
    const swiper2 = new Swiper('.product-sale .swiper-container', {
        slidesPerView: 5,
        spaceBetween: 30,
        loop: true,
        navigation: {
            nextEl: '.sale-next',
            prevEl: '.sale-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    // Modal
    document.addEventListener("DOMContentLoaded", () => {
        document.querySelectorAll(".addCart, .quick-view").forEach((button) => {
            button.addEventListener("click", (event) => {
                const productElement = event.target.closest(".item-product");

                const productName = productElement.querySelector(".name-product").textContent;
                const productCode = productElement.dataset.productId || "N/A";
                const productPrice = productElement.querySelector(".new").textContent;
                const productOldPrice = productElement.querySelector(".old")?.textContent || "N/A";
                const productDiscount = productElement.querySelector(".sale")?.textContent || "0";
                const productColors = productElement.dataset.colors || "Không có";
                const productSizes = productElement.dataset.sizes || "Không có";
                const productImage = productElement.querySelector(".img-product img").src;

                document.getElementById("productModalTitle").textContent = productName;
                document.getElementById("productModalCode").textContent = productCode;
                document.getElementById("productModalPrice").textContent = productPrice;
                document.getElementById("productModalOldPrice").textContent = productOldPrice;
                document.getElementById("productModalDiscount").textContent = productDiscount;
                document.getElementById("productModalImage").src = productImage;

                document.getElementById("productModalCodeInput").value = productCode;
                document.getElementById("productModalNameInput").value = productName;
                document.getElementById("productModalImageInput").value = productImage;
                document.getElementById("productModalPriceInput").value = productPrice;
                document.getElementById("productModalOldPriceInput").value = productOldPrice;

                const colorButtons = document.getElementById("productModalColorButtons");
                colorButtons.innerHTML = productColors.split(',').map(color => `
                <input type="radio" class="btn-check" name="color" id="color-${color.trim()}" value="${color.trim()}" autocomplete="off">
                <label class="btn btn-outline-primary" for="color-${color.trim()}">${color.trim()}</label>
            `).join('');

                const sizeButtons = document.getElementById("productModalSizeButtons");
                sizeButtons.innerHTML = productSizes.split(',').map(size => `
                <input type="radio" class="btn-check" name="size_product" id="size-${size.trim()}" value="${size.trim()}" autocomplete="off">
                <label class="btn btn-outline-primary" for="size-${size.trim()}">${size.trim()}</label>
            `).join('');

                new bootstrap.Modal(document.getElementById("productModal")).show();
            });
        });

        const quantityInput = document.getElementById("productModalQuantity");
        document.getElementById("quantityIncrease").addEventListener("click", () => {
            quantityInput.value = parseInt(quantityInput.value) + 1;
        });
        document.getElementById("quantityDecrease").addEventListener("click", () => {
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        });
    });
</script>