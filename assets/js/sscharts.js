!function(t){t.fn.sschart=function(e){var a=t.extend({chartId:"sss",chartType:"column",colors:["#507eab"],bgColor:"",title:"",subtitle:"",xAxisTitle:"",yAxisTitle:"Y Title",tooltipMsg:"Total",dataLabelsEnabled:!0,legend:!0,seriesData:[{name:"SS-1 (UP)",y:5,color:"red"},{name:"SS-2 (UP)",y:9},]},e);let l={enabled:a.dataLabelsEnabled,rotation:-90,color:"#000",align:"center",format:"{point.y:.0f}",y:10,style:{fontSize:"12px",fontFamily:"Verdana, sans-serif"}};"pie"==a.chartType&&(l={enabled:a.dataLabelsEnabled,distance:5,color:"#000",align:"center",style:{fontSize:"12px",fontFamily:"Railway"}}),Highcharts.chart(a.chartId,{colors:a.colors,chart:{backgroundColor:a.bgColor,type:a.chartType},title:{text:a.title},subtitle:{text:a.subtitle},xAxis:{type:"category",labels:{rotation:-45,style:{fontSize:"13px",fontFamily:"Verdana, sans-serif"}},title:{text:a.xAxisTitle}},yAxis:{min:0,title:{text:a.yAxisTitle}},tooltip:{pointFormat:a.tooltipMsg+": <b>{point.y:.0f} </b>"},plotOptions:{pie:{allowPointSelect:!0,cursor:"pointer",showInLegend:!0}},legend:{enabled:a.legend,useHTML:!0,labelFormatter:function(){return'<div style="">'+this.name+"</div>"}},series:[{data:a.seriesData,dataLabels:l}]})}}($);