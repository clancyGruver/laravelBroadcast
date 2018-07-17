<template>
    <div class="container">
        <div class="row mb-3">
            <div class="col-8">
                <div class="categories">
                    <div class="loading" v-if="loading">
                        Загрузка...
                    </div>

                    <div v-if="error" class="error">
                        <p>{{ error }}</p>
                        <p>
                            <button @click.prevent="fetchData">
                                Повторить запрос
                            </button>
                        </p>
                    </div>

                    <div class="card card-default">
                        <div class="card-header">Категории товаров</div>
                        <div class="card-body">
                            <form class="form-inline" >
                                <div class="form-check mb-2 mr-sm-2" v-for="{ id, name } in categories">
                                    <input class="form-check-input" type="checkbox" v-bind:id="id" v-on:click="addCat( id, name )">
                                    <label class="form-check-label" v-bind:for="id">
                                        {{ name }}
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="container">
                    <pie-chart :chart-data="categoryData" v-if="showChart"></pie-chart>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">Дополнительные параметры лучших продаж</div>

                    <div class="card-body">
                        <form class="form container">
                            <div class="row">
                                <p class="col-4">Период отчета</p>
                                <div class="form-group col-4">
                                    <datepicker placeholder="Начало" :bootstrapStyling="true" :language="language" @selected="datestart_selected" :value="start_date" name="start_date"></datepicker>
                                </div>
                                <div class="form-group col-4">
                                    <datepicker placeholder="Конец" :bootstrapStyling="true" :language="language" @selected="dateend_selected" name="end_date"></datepicker>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="year" >Количество отображаемых товаров (<span id="items_count_text">{{items_count}}</span>)</label>
                                    <input v-on:change="fetchTopGoods" type="range" min="5" max="100" step="1" value="30" class="form-control" name="items_count" id="items_count" v-model="items_count">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row container">
            <div class="card card-default col-12 col-md-6" v-for="good in topGoods">
                <img class="card-img-top" :src="'./images/beletag/' + good.site_id + '.jpg'">
                <div class="card-header">{{good.description}}</div>
                <div class="card-body">
                    <h5 class="card-title">
                        Цена: 
                        <span class="text-danger">{{good.price}}</span> 
                        <span v-if="good.price != good.prev_price" class="text-muted">
                            <i v-if="good.price > good.prev_price" class="fas fa-arrow-up text-success"></i>
                            <i v-if="good.price < good.prev_price" class="fas fa-arrow-down text-danger"></i>
                            {{good.prev_price}}
                        </span>
                    </h5>
                    <p class="card-text">Артикул: {{good.articul}}</p>
                    <p class="card-text">Продаж: {{good.sales*-1}}</p>
                    <p class="card-text"><a :href="'https://shop.beletag.com/catalog/' + good.good_id + '/' + good.site_id + '/'" target="_blank">На сайте</a></p>
                </div>
                <div class="card-footer text-center">
                    <button type="button" class="btn btn-info" @click="modal(good.good_id, good.description)">График</button>
                </div>
            </div>
        </div>

        <modal v-if="showModal.show" @close="modal" :good="good"></modal>
    </div>

    
</template>
<script>
import axios from 'axios';
import CategorySelect from './CategorySelect.vue';
import piechart from '../components/piechart.js';
import Datepicker from 'vuejs-datepicker';
import {ru} from 'vuejs-datepicker/dist/locale'
import Modal from '../components/Modal.vue';

export default {
    data() {
        return {
            showChart:false,
            good:{},
            showModal: {show:false},
            items_count: 30,
            start_date: null,
            end_date: null,
            loading: false,
            categories: null,
            topGoods: null,
            error: null,
            checkedCategories: [],
            categoryData: {
                labels:[],
                datasets: [{
                    data:[],
                    backgroundColor:[],
                    label:'Распределение продаж по категориям'
                }]
            },
            queryData: {
                categories: false,
                goods: false,
                good_params: false,
            },
            labels : [],
            language: ru,
            CSS_COLOR_NAMES : ["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"],
        };
    },
    components:{
        'category-select' : CategorySelect,
        'pie-chart' : piechart,
        Datepicker,
        ru,
        Modal,
    },
    created() {
        this.fetchData();
    },
    methods: {
        modal(id,name){
            this.good.id = id;
            this.good.name = name;
            this.showModal.show = !this.showModal.show;
        },
        datestart_selected(e){
            let sd = new Date(e);
            this.start_date = sd.getFullYear() + '-' + (sd.getMonth() + 1) + '-' + sd.getDate();
            this.fetchTopGoods();
        },
        dateend_selected(e){
            let sd = new Date(e);
            this.end_date = sd.getFullYear() + '-' + (sd.getMonth() + 1) + '-' + sd.getDate();
            this.fetchTopGoods();
        },
        fetchTopGoods(){
            console.log(this.end_date);
            axios
                .get('/api/v1/good_params',{
                    params:{
                        categories: this.checkedCategories,
                        start_date: this.start_date,
                        end_date: this.end_date,
                        items_count: this.items_count,
                    }
                })
                .then(response => {
                    console.log(response.data);
                    this.topGoods = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        fetchData() {
            this.error = this.categories = null;
            this.loading = true;
            axios
            .get('/api/v1/categories')
            .then(response => {
                this.loading = false;
                this.categories = response.data;
            })
            .catch(error => {
                this.loading = false;
                this.error = error.response.data.message || error.message;
            });

            axios
                .get('/api/v1/good_params')
                .then(response => {
                    console.log(response.data);
                    this.topGoods = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        addCat(id, name) {
            this.showChart = false;
        	if(this.checkedCategories.indexOf(id) !== -1){
        		this.checkedCategories.splice(this.checkedCategories.indexOf(id), 1);
                if (this.checkedCategories.length == 0) {
                    this.queryData.categories = false
                }
            }
        	else{
        		this.checkedCategories.push(id);
                this.queryData.categories = true
            }
            axios
            .get('/api/v1/categories_sales_count/' + id)
            .then(response => {
                this.loading = false;
                let counter = this.labels.indexOf(name)
                if(counter !== -1)
                {
                    counter = this.labels.indexOf(name)
                    this.labels.splice(counter, 1);
                    this.categoryData.datasets[0].data.splice(counter, 1);
                    this.categoryData.datasets[0].backgroundColor.splice(counter, 1);
                }                    
                else{
                    this.labels.push(name);
                    this.categoryData.labels = this.labels;
                    this.categoryData.datasets[0].data.push(response.data.sold*(-1));
                    this.start_date = response.data.min_date;
                    let color = Math.floor(Math.random() * (this.CSS_COLOR_NAMES.length - 1) + 1);
                    this.categoryData.datasets[0].backgroundColor.push(
                        this.CSS_COLOR_NAMES[color]
                    );               
                }                
                this.showChart = true;
            })
            .catch(error => {
                this.loading = false;
                console.log(error);
                this.error = error.response.data.message || error.message;
            });
            this.fetchTopGoods();
        }
    }
}
</script>
