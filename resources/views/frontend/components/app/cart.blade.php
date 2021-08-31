<!-- Add to cart bar -->
<div id="cart_side" class="add_to_cart right ">
    <a href="javascript:void(0)" class="overlay" onclick="closeCart()"></a>
    <div class="cart-inner">
        <div class="cart_top">
            <h3>my cart</h3>
            <div class="close-cart">
                <a href="javascript:void(0)" onclick="closeCart()">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <div class="cart_media">
            <ul class="cart_product">
                <li>
                    <div class="media">
                        <a href="">
                            <img alt="megastore1" class="me-3" src="assets/imgs/products/7.jpg">
                        </a>
                        <div class="media-body">
                            <a href="">
                                <h4>women fashion shoes</h4>
                            </a>
                            <h6>
                                $80.00 <span>$120.00</span>
                            </h6>
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <button class="qty-minus"></button>
                                        <input class="qty-adj form-control" type="number" value="1" />
                                        <button class="qty-plus"></button>
                                    </div>
                                </div>
                                <div class="pro-add">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-product">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <a href="">
                            <img alt="megastore1" class="me-3" src="assets/imgs/products/8.jpg">
                        </a>
                        <div class="media-body">
                            <a href="">
                                <h4>men analogue watch</h4>
                            </a>
                            <h6>
                                $80.00 <span>$120.00</span>
                            </h6>
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <button class="qty-minus"></button>
                                        <input class="qty-adj form-control" type="number" value="1" />
                                        <button class="qty-plus"></button>
                                    </div>
                                </div>
                                <div class="pro-add">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-product">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="media">
                        <a href="">
                            <img alt="megastore1" class="me-3" src="assets/imgs/products/9.jpg">
                        </a>
                        <div class="media-body">
                            <a href="">
                                <h4>wireless headphones</h4>
                            </a>
                            <h6>
                                $80.00 <span>$120.00</span>
                            </h6>
                            <div class="addit-box">
                                <div class="qty-box">
                                    <div class="input-group">
                                        <button class="qty-minus"></button>
                                        <input class="qty-adj form-control" type="number" value="1" />
                                        <button class="qty-plus"></button>
                                    </div>
                                </div>
                                <div class="pro-add">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#edit-product">
                                        <i data-feather="edit"></i>
                                    </a>
                                    <a href="javascript:void(0)">
                                        <i data-feather="trash-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="cart_total">
                <li>
                    subtotal : <span>$1050.00</span>
                </li>
                <li>
                    shpping <span>free</span>
                </li>
                <li>
                    taxes <span>$0.00</span>
                </li>
                <li>
                    <div class="total">
                        total<span>$1050.00</span>
                    </div>
                </li>
                <li>
                    <div class="buttons">
                        <a href="{{ route('customer.cart') }}" class="btn btn-solid btn-sm">view cart</a>
                        <a href="{{ route('customer.checkout') }}" class="btn btn-solid btn-sm ">checkout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- Add to cart bar end-->
