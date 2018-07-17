<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">

          <div class="modal-header">
            <h3 name="header">
              График продаж {{good.name}}
            </h3>
          </div>

          <div class="modal-body">
            <div name="body">
                <form>
                  <div class="form-check">
                    <input 
                      class="form-check-input" 
                      type="radio" 
                      name="radio" 
                      id="color" 
                      value="color" 
                      v-model="radio" 
                    >
                    <label class="form-check-label" for="color">
                      Цвет
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="radio" id="size" value="size" v-model="radio">
                    <label class="form-check-label" for="size">
                      Размер
                    </label>
                  </div>
                  <div class="form-check disabled">
                    <input class="form-check-input" type="radio" name="radio" id="colorsize" value="colorsize" v-model="radio">
                    <label class="form-check-label" for="colorsize">
                      Размер и цвет
                    </label>
                  </div>
                </form>
                <bar-chart :chart-data="goodsData" v-if="showChart"></bar-chart>
                <div class="spinner" v-else>Loading...</div>
            </div>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <button class="modal-default-button" @click="$emit('close')">
                Закрыть
              </button>
            </slot>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>


<script>
  import barchart from '../components/barchart.js';
  export default {
    props:[
      'good',
    ],
    data(){
      return {
        showChart:false,
        goodsData:{},
        radio: 'size',
        CSS_COLOR_NAMES : ["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","Yellow","YellowGreen"],
      }
    },
    components:{
        'bar-chart' : barchart,
    },
    watch:{
      radio: function(){
        this.fetchData();
      },
    },
    methods:{
      fetchData(){
        this.showChart = false;
        let _t = this;
        console.log(this.radio);
        axios
          .get('/api/v1/good_sales/'+this.good.id,{
              params:{
                  radio: this.radio,
              }
          })
          .then(response => {
              this.goodsData = {
                labels:[],
                datasets: [{
                    label: ['# продаж'],
                    data: [],
                    backgroundColor: [],
                    borderColor: [],
                    borderWidth: 1
                }]
              };
              response.data.forEach(function(item, i) {
                let color = Math.floor(Math.random() * (_t.CSS_COLOR_NAMES.length - 1) + 1);
                let clorName = typeof item.color_name != 'undefined' ? item.color_name : '';
                let size = typeof item.size != 'undefined' ? item.size : '';
                let label =  clorName + ' ' + size;
                _t.goodsData.labels.push(label.trim());
                _t.goodsData.datasets[0].data.push(item.sold * -1);
                _t.goodsData.datasets[0].backgroundColor.push(_t.CSS_COLOR_NAMES[color]);
                _t.goodsData.datasets[0].borderColor.push(_t.CSS_COLOR_NAMES[color]);
              });
              this.showChart = true;
          })
          .catch(error => {
              console.log(error);
          });
      },
    },
    mounted(){
      this.fetchData();
    },
  }
</script>

<style type="text/css">
  .modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 450px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

</style>