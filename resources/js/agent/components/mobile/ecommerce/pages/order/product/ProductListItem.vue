<template>
        <tr>
                <td >
                    <input type="checkbox" id="checkbox"  v-model="checked" v-on:click="selectThisProduct()">
                </td>
                <td >
                    {{ product.id }}
                </td>
                <td >
                    <img class="product-img-thumbnail" :src="product.feature_img" :alt="product.name.en">
                </td>
                <td >
                    {{ product.name.en.substring(0,40)+'..' }}
                </td>
                <td >
                    {{ product.min_order_quantity }} unit
                </td>
                <td >
                    &#2547; {{ product.sale_price }}
                </td>
        </tr>
</template>
<style scoped>
.product-img-thumbnail{
    max-width: 60px;
    max-height: 60px;
    margin: auto;
}
</style>
<script>
import eventBus from './../../../../../../event-bus'
export default {
    props: [
        'product',
        'tab',
    ],
    data() {
        return {
            checked: false,
        }
    },
    mounted(){
        eventBus.$on('removeSelectedItem',(data)=>{
            if (this.tab == data.tab && this.product.id == data.productId) {
                this.selectThisProduct()
            }
        })
    },
    created() {

    },
    methods: {
        selectThisProduct(){
            this.checked = !this.checked
            if (this.checked) {
                this.$emit('selectProduct',this.product)
            }else{
                this.$emit('removeProduct',this.product)
            }
        }
    },
}
</script>
