<template>
    <div class="container" style="margin-top: 100px">
        <div class="m-3" style="display: flex; justify-content: space-between; align-items: center">
            <h3>Latest products</h3>

            <div>
                <select v-model="selectedSort" @change="sortProducts" class="form-select" id="sortSelect">
                    <option :value="null" disabled selected>Sorting</option>
                    <option value="name">Name</option>
                    <option value="price">Price</option>
                </select>
            </div>

            <div>
                <select v-model="selectedCategoryId" @change="filterProducts" class="form-select" id="filterSelect">
                    <option :value="null" disabled selected>Filter</option>
                    <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}
                    </option>
                </select>
            </div>
        </div>

        <hr class="m-3">

        <h4 v-if="!products" class="my-5 mx-auto">Sorry, No products found!</h4>
        <div v-if="products" class="row mx-auto">
            <div v-for="product in products.data" :key="product.id"
                class="card border-primary mb-3 col-md-4 col-sm-6 col-12 m-3" style="max-width: 20rem;">
                <img :src="product.image" class="card-img-top" alt="Product Image"
                    style="max-height: 200px; object-fit: cover;">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>{{ product.price }} $</span>
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ product.name }}</h4>
                    <p class="card-text">{{ product.description }}</p>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <ul class="pagination">
                <li class="page-item">
                    <button :disabled="isFirstPage" @click="onPageChange(currentPage - 1)"
                        class="page-link">previous</button>
                </li>
                <li v-for="page in pages" :key="page" @click="onPageChange(page)" class="page-item">
                    <button class="page-link">{{ page }}</button>
                </li>
                <li class="page-item">
                    <button :disabled="isLastPage" @click="onPageChange(currentPage + 1)"
                        class="page-link">next</button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Products",
    data() {
        return {
            selectedCategoryId: null,
            selectedSort: null,
            categories: [],
            products: [],
            errorMessage: null,
            currentPage: 1,
            totalElements: 0,
            limit: 0,
            totalPages: 0,
            pages: []
        };
    },
    mounted() {
        this.fetchCategories();
        this.fetchProducts(this.currentPage);
    },
    methods: {
        fetchCategories() {
            axios.get('http://localhost:8000/api/categories')
                .then(response => {
                    this.categories = response.data;
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                });
        },
        fetchProducts(page) {
            axios.get(`http://localhost:8000/api/products?page=${page}`)
                .then(response => {
                    this.products = response.data;
                    this.totalElements = response.data.total;
                    this.limit = response.data.per_page;
                    this.totalPages = Math.ceil(this.totalElements / this.limit);
                    this.pages = [...Array(this.totalPages).keys()].map(el => el + 1);
                })
                .catch(error => {
                    this.errorMessage = 'Error fetching products.';
                    console.error('Error fetching products:', error);
                });
        },
        filterProducts() {
            // Implement filter functionality based on selectedCategoryId
            console.log('Filtering products by category:', this.selectedCategoryId);
            // Example: Modify API call to filter products
            axios.get(`http://localhost:8000/api/products/filter/category/${this.selectedCategoryId}`)
                .then(response => {
                    this.products = response; // Assuming API response updates products
                })
                .catch(error => {
                    console.error('Error filtering products:', error);
                    this.errorMessage = 'Error fetching filtered products.';
                });
        },
        sortProducts() {
            // Implement sort functionality based on selectedSort
            console.log('Sorting products by:', this.selectedSort);
            if (this.selectedSort === 'name') {
                axios.get('http://localhost:8000/api/products/sort/name')
                    .then(response => {
                        this.products = response; // Assuming API response updates products
                    })
                    .catch(error => {
                        console.error('Error sorting products:', error);
                        this.errorMessage = 'Error fetching sorted products.';
                    });
            } else if (this.selectedSort === 'price') {
                axios.get('http://localhost:8000/api/products/sort/price')
                    .then(response => {
                        this.products = response; // Assuming API response updates products
                    })
                    .catch(error => {
                        console.error('Error sorting products:', error);
                        this.errorMessage = 'Error fetching sorted products.';
                    });
            }

        },
        isFirstPage() {
            return this.currentPage === 1;
        },
        isLastPage() {
            return this.currentPage === this.totalPages;
        },
        onPageChange(event) {
            const page = event;
            this.currentPage = page;
            this.fetchProducts(this.currentPage);
            console.log(event)
        }
    }
};
</script>

<style scoped>
/* Add scoped styles here if needed */
</style>