<template>
    <div class="container">
        <section class="wrapper">
            <div class="side">
                <h3>Categories</h3>
                <label @change="filterPro" v-for="(cat, i) in categories" :key="i"><input type="checkbox" :value="cat" v-model="selected_categories">{{cat}}</label>
                {{selected_categories}}
                <hr>
                <h3>Colors</h3>
                <label @change="filterPro" v-for="(color, i) in colors" :key="i"><input type="checkbox" :value="color" v-model="selected_color">{{color}}</label>
                {{selected_color}}
                <hr>
                <h3>Range</h3>
                <label>Max</label><br>
                <input type="range"><br>
                <label>Min</label><br>
                <input type="range">
            </div>
            <div class="content">
                <ProductItem v-for="product in products" :key="product.id" :product="product"/>
            </div>
        </section>
    </div>
</template>

<script>
import ProductItem from '../components/Productitem.vue'
import products from '../../data/products.json'
export default {
    components: {ProductItem},
    data () {
        return {
            products,
            categories: ['Fire Protection', 'Granite Surfaces', 'Structural & Misc Steel Erection', 'RF Shielding', 'Landscaping & Irrigation'],
            colors: ["blue","red","green"],
            selected_categories: [],
            orginal_product: products,
            selected_color: []
        }
    },
    methods: {
        filterPro() {
            this.products = this.orginal_product
            if (this.selected_categories.length > 0) {
                this.products = this.orginal_product.filter(p => this.selected_categories.includes(p.category))
            }
            
            if (this.selected_color.length > 0) {
                if (this.selected_categories.length > 0) {
                    this.products = this.products.filter(p => p.color.some(c => this.selected_color.includes(c)))
                } else {
                    this.products = this.orginal_product.filter(p => p.color.some(c => this.selected_color.includes(c)))
                }
            }

            // if(this.selected_color.length > 0 && this.selected_categories.length > 0) {
            //     this.products = this.orginal_product.filter(p => p.color.some(c => this.selected_colors.includes(c)))
            // }
            
        }
    }
    // watch: {
    //     selected_categories: function() {
    //         if (this.selected_categories.length > 0) {
    //             this.products = this.orginal_product.filter(p => this.selected_categories.includes(p.category))
    //         } else {
    //             this.products = this.orginal_product
    //         }
    //     }
    // }
}
</script>

<style scoped>
.wrapper {
    display: flex;
    margin: 60px 0;
    flex-wrap: wrap;
}
.wrapper .side {
    width: 30%;
    padding: 0 20px;
}
.wrapper .content {
    width: 70%;
    padding: 0 20px;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-start;
}
.side label {
    display: block;
}
</style>