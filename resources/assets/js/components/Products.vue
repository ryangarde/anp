<template>
    <div class="col-md-9">
        <div class="card-columns">
            <div class="card title-color text-center product-info" v-for="item in products">
                <div>{{ item.name | capitalize }}</div>

                <img :src="imagePath(item.image)" class="card-img-top product-image" alt="">

                <div class="d-flex justify-content-between mb-2">
                    <div class="d-inline-block product-price">
                        ₱ {{ item.price }}
                    </div>

                    <div class="d-inline-block">
                        <input type="submit" @click="addToCart(item.id)" class="btn btn-sm add-to-cart-button anp-btn" value="add to cart">
                    </div>
                </div>

                <div class="c--anim-btn">
                    <span class="c-anim-btn">
                        {{ item.description }}
                    </span>
                </div>

                <hr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                product: {
                    'id': '',
                },
                products: {}
            }
        },
        mounted() {
            this.getAllProducts();
        },
        methods: {
            getAllProducts() {
                axios.get('/products').then(response => {
                    this.products = response.data.products;
                });
            },

            imagePath(image) {
                return '/storage/images/' + image;
            },

            addToCart(id) {
                let btn = event.target;

                btn.disabled = true;
                btn.value = 'adding..';

                axios.post('/cart/add', {
                    id: id
                }).then(response => {
                    setTimeout(() => {
                        btn.disabled = false;
                        btn.value = 'add to cart';
                    }, 1000);
                }).catch(error => {
                    alert(error);
                    window.location.href = "/login";
                });
            }
        },
        filters: {
            capitalize: function (value) {
                if (!value) return '';

                value = value.toString();

                return value.charAt(0).toUpperCase() + value.slice(1);
            }
        }
    }
</script>

<style scoped>
    .card-columns > .card {
        border: 0;
    }

    .product-image {
        width: 100%;
        height: 230px;
    }

    .product-price {
        font-size: 115%;
    }
</style>