<template>
  <div class="small">
    <button @click="build()">Построить график</button>
    <pie-chart :chart-data="categoryData"></pie-chart>
  </div>
</template>

<script>
import piechart from '../components/piechart.js'
import axios from 'axios';


const CSS_COLOR_NAMES = ["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","White","WhiteSmoke","Yellow","YellowGreen"];

export default {
   components: {'pie-chart' : piechart},
   props:['categoryData'],
   data() {
    return {
      datacollection: null
    }
   },
   watch: {
    categoryData: function(){
      
    }
   },
   methods:{
    build(){
      let _t = this;
      let uri = '/api/v1/good_params';
      let Dates = new Array();
      let Sizes = new Array();
      let ColorNames = CSS_COLOR_NAMES;
      let Changes = new Array();
      axios
      .get(uri)
      .then((response) => {
        let data = response.data;
        console.log(data)
        if(data) {
          data.forEach(element => {
            Dates.push(element.date);
            Sizes.push(element.size);
            Changes.push(element.change_prev_day * -1);
          });
          _t.datacollection =
            {
              labels: Dates,
              datasets: [{
                label: 'Bitcoin',
                backgroundColor: '#FC2525',
                data: Changes
              }]
            }
            //{responsive: true, maintainAspectRatio: false, type: 'pie'};
          
        }
        else {
          console.log('No data');
        }
      });   
    }
   },
   mounted() {     }
}
</script>