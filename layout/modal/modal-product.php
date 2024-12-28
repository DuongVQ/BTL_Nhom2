<?php
session_start();
$user_id = $_SESSION['login'] ?? null;
?>


<div id="productModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addToCartForm" method="POST" action="../../modules/cart/add-to-cart.php">
                    <input type="hidden" name="user_id" id="productModalUserIdInput" value="<?= htmlspecialchars($user_id) ?>">
                    <div class="d-flex">
                        <!-- Hình ảnh sản phẩm -->
                        <img id="productModalImage" src="" alt="Sản phẩm" class="me-3" style="width: 200px; height: 200px; object-fit: cover;">
                        <!-- Thông tin sản phẩm -->
                        <div>
                            <p><strong>Mã hàng:</strong> <span id="productModalCode"></span></p>
                            <input type="hidden" name="product_id" id="productModalCodeInput">
                            <input type="hidden" name="product_name" id="productModalNameInput">
                            <input type="hidden" name="image_url" id="productModalImageInput">
                            <p><strong>Giá:</strong> <span id="productModalPrice"></span></p>
                            <input type="hidden" name="price" id="productModalPriceInput">
                            <p><strong>Giá cũ:</strong> <span id="productModalOldPrice"></span></p>
                            <input type="hidden" name="old_price" id="productModalOldPriceInput">
                            <p><strong>Giảm giá:</strong> <span id="productModalDiscount"></span></p>
                            <p><strong>Màu sắc:</strong></p>
                            <div id="productModalColorButtons" class="mb-3">
                                <!-- Các nút màu sắc sẽ được thêm động -->
                            </div>
                            <p><strong>Kích thước:</strong></p>
                            <div id="productModalSizeButtons" class="mb-3">
                                <!-- Các nút kích thước sẽ được thêm động -->
                            </div>
                            <div class="d-flex align-items-center">
                                <strong>Số lượng:</strong>
                                <button id="quantityDecrease" type="button" class="btn btn-outline-secondary ms-3">-</button>
                                <input id="productModalQuantity" name="quantity" type="number" value="1" min="1" class="form-control mx-2" style="width: 70px;">
                                <button id="quantityIncrease" type="button" class="btn btn-outline-secondary">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Thêm vào giỏ hàng</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>