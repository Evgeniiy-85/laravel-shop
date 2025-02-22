@foreach($products as $product)
    <div class="product">
        <div class="product-cover">
            <img src="{{ $product->prod_image_url }}">
        </div>

        <div class="product-center">
            <a class="product-title" href="/products/{{ $product->prod_alias }}">{{ $product->prod_title }}</a>
            <div class="card-bottom">Наличие: в наличии</div>
        </div>

        <div class="product-right">
            <div class="product-price">
                {{ $product->prod_price }} ₽
            </div>

            <div class="product-buttons">
                <div class="product-favorites">
                    <button type="button" class="button button-ui btn_a-grey" data-prod_id="{{ $product->prod_id }}" data-action_type="add"></button>
                </div>

                <div class="product-by">
                    <button type="button" class="button button-ui btn_a-outline-primary" data-prod_id="{{ $product->prod_id }}" data-action_type="append">Купить</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
