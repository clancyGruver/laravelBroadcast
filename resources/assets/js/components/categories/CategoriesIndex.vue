<template>
 <div>
  <div class="form-group">
   <router-link :to="{name: 'createCategory'}" class="btn btn-success">Новая категория</router-link>
  </div>
 
  <div class="panel panel-default">
   <div class="panel-heading">Список категорий</div>
   <div class="panel-body">
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Название</th>
       <th>Дата добавления</th>
       <th width="100">&nbsp;</th>
      </tr>
     </thead>
     <tbody>
     <tr v-for="category, index in categories">
       <td>{{ category.name }}</td>
       <td>{{ category.date_add }}</td>
     <td>
     <router-link :to="{name: 'editCategory', params: {id: category.id}}" class="btn btn-xs btn-default">
      Edit
    </router-link>
     <a href="#"
       class="btn btn-xs btn-danger"
       v-on:click="deleteEntry(category.id, index)">
       Delete
      </a>
     </td>
     </tr>
    </tbody>
   </table>
 </div>
 </div>
 </div>
</template>
 
<script>
 export default {
 data: function () {
    return {
      categories: []
    }
    },
 mounted() {
    var app = this;
    axios.get('/api/v1/categories')
    .then(function (resp) {
      app.categories = resp.data;
    })
   .catch(function (resp) {
      console.log(resp);
      alert("Не удалось загрузить компании");
   });
 },
 methods: {
   deleteEntry(id, index) {
   if (confirm("Вы действительно хотите удалить категорию?")) {
     var app = this;
     axios.delete('/api/v1/categories/' + id)
     .then(function (resp) {
     app.categories.splice(index, 1);
 })
 .catch(function (resp) {
    alert("Не удалось удалить компанию");
 });
 }
 }
 }
 }
</script>