<template>
    <div class="">
        <div class="card card-default">
            <div class="card-header">Дополнительные параметры лучших продаж</div>

            <div class="card-body">
                <form class="form-inine">
                        <label for="start_date" class="">Начало</label>
                            <datepicker name="start_date"></datepicker>

                        <label for="end_date" class="col-sm-4 col-form-label text-md-right">Конец</label>
                            <datepicker name="end_date"></datepicker>

                    <div class="form-group row">
                        <label for="year" class="col-md-4 col-form-label text-md-right">Количество товаров (<span id="items_count_text">{{items_count}}</span>)</label>
                        <div class="col-md-6">
                            <input type="range" min="0" max="100" step="1" value="30" class="form-control" name="items_count" id="items_count" v-model="items_count" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="year" class="col-md-4 col-form-label text-md-right">Price</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <pie-chart :chart-data="categoryData"></pie-chart>
    </div>

</template>

<script>
import axios from 'axios';
import Datepicker from 'vuejs-datepicker';
import piechart from '../components/piechart.js'
export default {
    data(){
        return{
            items_count: 30,
        }
    },
    props:['categoryData'],
    components: {
        Datepicker,
        'pie-chart' : piechart,
    },
    methods: {
        log(){
            console.log(app)    
        }
        
    }

}
</script>