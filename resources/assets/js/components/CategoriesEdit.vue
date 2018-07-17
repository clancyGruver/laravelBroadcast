<template>
 <div>
    <div class="form-group">
       <router-link to="/" class="btn btn-default">Back</router-link>
    </div>
 
     <div class="panel panel-default">
        <div class="panel-heading">Create new category</div>
        <div class="panel-body">
           <form v-on:submit="saveForm()">
             <div class="row">
                <div class="col-xs-12 form-group">
                  <label class="control-label">category name</label>
                  <input type="text" v-model="category.name" class="form-control">
                </div>
              </div>
             <div class="row">
                 <div class="col-xs-12 form-group">
                    <label class="control-label">category date_add</label>
                    <input type="text" v-model="category.date_add" class="form-control">
                  </div>
              </div>
              <div class="row">
                 <div class="col-xs-12 form-group">
                    <button class="btn btn-success">Create</button>
                 </div>
              </div>
           </form>
       </div>
     </div>
 </div>
</template>

<script>
 export default {
    mounted() {
       let app = this;
       let id = app.$route.params.id;
       app.categoryId = id;
       axios.get('/api/v1/categories/' + id)
         .then(function (resp) {
             app.category = resp.data;
          })
         .catch(function () {
             alert("Не удалось загрузить компанию")
          });
    },
    data: function () {
        return {
           categoryId: null,
           category: {
               name: '',
               address: '',
               website: '',
               email: '',
          }
       }
    },
    methods: {
       saveForm() {
          event.preventDefault();
          var app = this;
          var newcategory = app.category;
          axios.patch('/api/v1/categories/' + app.categoryId, newcategory)
              .then(function (resp) {
                   app.$router.replace('/');
              })
              .catch(function (resp) {
                    console.log(resp);
                    alert("Не удалось создать компанию");
               });
        }
     }
 }
</script>