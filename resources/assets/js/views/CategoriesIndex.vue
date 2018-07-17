<template>
    <div class="categories">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <div v-if="error" class="error">
            <p>{{ error }}</p>
				    <p>
				        <button @click.prevent="fetchData">
				            Try Again
				        </button>
				    </p>
        </div>

        <ul v-if="categories">
            <li v-for="{ name, date_add } in categories">
                <strong>Название:</strong> {{ name }},
                <strong>Дата добавления:</strong> {{ date_add }}
            </li>
        </ul>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: false,
            categories: null,
            error: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.categories = null;
            this.loading = true;
            axios
                .get('/api/v1/categories')
                .then(response => {
				            this.loading = false;
				            this.categories = response.data;
                    console.log(response);
                })
                .catch(error => {
				            this.loading = false;
				            this.error = error.response.data.message || error.message;
				        });
        }
    }
}
</script>
