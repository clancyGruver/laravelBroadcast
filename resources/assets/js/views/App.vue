<template>
    <div class="row">
        <div class="col-3 left-menu">
                <p class="">Ресурс</p>
                <p>
                    <router-link :to="{ name: 'beletag.index' }">Бельетаж</router-link>
                </p>
        </div>
        <div class="col-9">
                <router-view></router-view>
        </div> 
    </div>
        
</template>
<script>

export default {
    components:{
    }
}
</script>
