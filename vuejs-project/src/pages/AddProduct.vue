<template>
    <div class="w-50 mx-auto mt-5">
        <form @submit.prevent="onSubmit">
            <div class="d-flex justify-content-between align-items-center my-3">
                <h3>Add New Product</h3>
                <router-link to="/products" class="d-flex align-items-center">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span class="ms-2">Back to products</span>
                </router-link>
            </div>

            <div>
                <label for="name" class="form-label mt-4">Name</label>
                <input v-model="form.name" type="text" class="form-control" id="name" placeholder="Enter Product Name"
                    required>
            </div>

            <div>
                <label for="description" class="form-label mt-4">Description</label>
                <textarea v-model="form.description" placeholder="Product description goes here..." class="form-control"
                    id="description" rows="3" spellcheck="false" required></textarea>
            </div>

            <div>
                <label for="price" class="form-label mt-4">Price</label>
                <input v-model="form.price" type="number" step="0.01" class="form-control" id="price"
                    placeholder="Enter Product Price" required>
            </div>

            <div>
                <label for="image" class="form-label mt-4">Image</label>
                <input type="file" class="form-control" id="image" @change="onFileChange" required>
            </div>

            <div>
                <label for="category_id" class="form-label mt-4">Category</label>
                <select v-model="form.category_id" class="form-select">
                    <!-- <option :value="null" disabled selected>Filter</option> -->
                    <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}
                    </option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Add</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: "AddProduct",
    data() {
        return {
            categories: [],
            form: {
                name: '',
                description: '',
                price: null,
                image: null,
                category_id: null
            }
        };
    },
    mounted() {
        this.fetchCategories();
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
        onFileChange(event) {
            this.form.image = event.target.files[0];
        },
        async onSubmit() {
            const formData = new FormData();
            formData.append('name', this.form.name);
            formData.append('description', this.form.description);
            formData.append('price', this.form.price);
            formData.append('image', this.form.image);
            formData.append('category_id', this.form.category_id);

            try {
                const response = await axios.post('http://localhost:8000/api/products', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                });
                console.log(response.data);
                // Redirect or display success message as needed
                Swal.fire({
                    title: "Good job!",
                    text: "Added with success!",
                    icon: "success",
                    timer: 1500
                });
                setTimeout(() => {
                    this.$router.push("/products");
                }, 2000);
            } catch (error) {
                console.error('Error submitting product:', error);
            }
        }
    }
};
</script>

<style scoped>
/* Add your styles here */
</style>