<?php
$user_id = $_SESSION['login'] ?? null;
?>

<style>
#productModalColorButtons,
#productModalSizeButtons {
    display: flex;
    gap: 10px !important;
    flex-wrap: wrap;
}
#productModalColorButtons label,
#productModalSizeButtons label {
    font-size: 14px !important;
    box-shadow: none !important;
}

.modal-footer button {
    background-color: #fff;
    --color: #ff003c;
    font-family: inherit;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    cursor: pointer;
    padding: 6px 10px;
    margin-right: 5px;
    z-index: 1;
    color: var(--color);
    border: 2px solid var(--color);
    border-radius: 6px;
    position: relative;
    font-size: 14px;
}

.modal-footer button::before {
    position: absolute;
    content: '';
    background: var(--color);
    width: 210px;
    height: 250px;
    z-index: -1;
    border-radius: 50%;
}

.modal-footer button:hover {
    color: white;
}

.modal-footer button:before {
    top: 100%;
    left: 100%;
    transition: 0.3s all;
}

.modal-footer button:hover::before {
    top: -40px;
    left: -30px;
}
</style>

<div id="productModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thông tin sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addToCartForm" method="POST" action="../../modules/cart/add-to-cart.php">
                    <input type="hidden" name="user_id" id="productModalUserIdInput" value="<?= htmlspecialchars($user_id) ?>">
                    <div class="d-flex">
                        <!-- Hình ảnh sản phẩm -->
                        <img id="productModalImage" src="" alt="Sản phẩm" class="me-3 border border-1 mb-3" style="height: 350px; object-fit: cover;">
                        <!-- Thông tin sản phẩm -->
                        <div>
                            <h5 class="mb-2" id="productModalTitle"></h5>
                            <p class="d-none"><strong>Mã hàng:</strong> <span id="productModalCode"></span></p>
                            <input type="hidden" name="product_id" id="productModalCodeInput">
                            <input type="hidden" name="product_name" id="productModalNameInput">
                            <input type="hidden" name="image_url" id="productModalImageInput">
                            <p class="m-0 p-2 d-flex align-items-center" style="background-color: #f5f5f5;">
                                <strong style="font-size: 14px; margin-right: 50px;">Giá:</strong> 
                                <span id="productModalPrice" style="color: red; font-weight: 600; margin-right: 10px"></span> 
                                <span class="text-secondary text-decoration-line-through" id="productModalOldPrice" style="font-size: 14px; margin-right: 10px"></span> 
                                <span id="productModalDiscount" style="background-color: red; color: #fff; padding: 5px; border-radius: 25px; font-size: 10px;"></span>
                            </p>
                            <input type="hidden" name="price" id="productModalPriceInput">
                            <input type="hidden" name="old_price" id="productModalOldPriceInput">
                            <p class="m-0 mt-2">Màu sắc:</p>
                            <div id="productModalColorButtons" class="mb-3">
                                <!-- Các nút màu sắc sẽ được thêm động -->
                            </div>
                            <p class="m-0 mt-2">Kích thước:</p>
                            <div id="productModalSizeButtons" class="mb-3">
                                <!-- Các nút kích thước sẽ được thêm động -->
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                Số lượng:
                                <div class="border border-1 d-flex align-items-center ms-2">
                                    <button id="quantityDecrease" type="button" class="btn border-0 rounded-0" style="box-shadow: none; background: #f5f5f5;">-</button>
                                    <input id="productModalQuantity" name="quantity" type="number" value="1" min="1" class="form-control border-0 text-center" style="width: 50px; box-shadow: none; font-size: 14px;">
                                    <button id="quantityIncrease" type="button" class="btn border-0 rounded-0" style="box-shadow: none; background: #f5f5f5;">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit">Thêm vào giỏ hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>