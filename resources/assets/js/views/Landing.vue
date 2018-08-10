<template>
    <div class="row">
        <div class="col-12 text-center">
            <h2>Отслеживаемые товары</h2>
        </div>
        <div class="col-6">
            <bar-chart :chart-data="electronicGoods" :options="chartOptionsElectro"></bar-chart>
        </div>
        <div class="col-6">
            <bar-chart :chart-data="alkoGoods" :options="chartOptionsAlko"></bar-chart>
        </div> 
    </div>
        
</template>
<script>

  import barchart from '../components/barchart.js';
export default {
    data(){
      return {
        electronicGoods:{
            labels:['Эльдорадо', 'М-Видео', 'ДНС'],
            datasets: [{
                label: ['Электротовары'],
                data: [7800, 6400, 6900],
                backgroundColor: ["Beige","CadetBlue","BlueViolet"],
                borderColor: [],
                borderWidth: 1
            }]
        },
        alkoGoods:{
            labels:['Мавт', 'Красное и белое'],
            datasets: [{
                label: ['Алкоголь'],
                data: [100, 140],
                backgroundColor:  ["Beige","CadetBlue"],
                borderColor: [],
                borderWidth: 1
            }]
        },
        CSS_COLOR_NAMES : ["AliceBlue","AntiqueWhite","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","Blue","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","Darkorange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","FloralWhite","ForestGreen","Fuchsia","Gainsboro","GhostWhite","Gold","GoldenRod","Gray","Grey","Green","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","NavajoWhite","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","Red","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","Yellow","YellowGreen"],
        
		chartOptionsAlko:{
            scales: {
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true
                    },
                    ticks: {
                        min: 80,
                        max: 160
                    }
                }]
            }
        },
        chartOptionsElectro:{
            scales: {
                yAxes: [{
                    display: true,
                    scaleLabel: {
                        display: true
                    },
                    ticks: {
                        min: 6000,
                        max: 8000
                    }
                }]
            }
        }
      }
    },
    components:{
        'bar-chart' : barchart,
    },
    methods:{
    }
}
</script>
