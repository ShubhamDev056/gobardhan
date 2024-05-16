(function($){
  
$.fn.ssmap=function(options){
  var settings=$.extend({
    mapId:'sss',
    name:'Total',
	 height:'500px',
    bgColor:'#eee',
    minColor: '#FCAE91',
    maxColor: '#4032a8',
    showDataLabels:false,
    zoomButton:true,
    exportButton:true,
	  legendWidth:300,
    data:[],
    drilldown:false,
    drilldowndata:[]
  },options);
  let baseUrl='https://gobardhan.indevconsultancy.com/';
  // let baseUrl='http://localhost/gobardhan/';
  Highcharts.getJSON(baseUrl+'assets/indiass.json', function (geojson) {
  Highcharts.mapChart(settings.mapId, {
    chart: {
      backgroundColor:settings.bgColor,
	  height:settings.height,
      map: geojson
    },
    title: {
      text: ''
    },
    accessibility: {
      typeDescription: ''
    },
    mapNavigation: {
      enabled: settings.zoomButton,
      buttonOptions: {
        verticalAlign: 'bottom'
      }
    },
    colorAxis: {
      min: 1,
      minColor: settings.minColor,
      maxColor: settings.maxColor,
    },
    plotOptions:{
        series:{
          point:{
              events:{
                click: function(){
                  var STNAME = this.properties.STNAME;
                  if(settings.drilldown){
                    stateMap(STNAME);
                  }
                }
              }
            }
        }
    },
    tooltip: {
      pointFormatter: function() {
        return '<b>'+this.properties.STNAME+'</b>: '+ this.value;
      }
  },
  exporting:{
        enabled: settings.exportButton,
    },
    legend:{
		symbolWidth:settings.legendWidth,
     enabled:false
	},
    series: [{
      data: settings.data,
      keys: ['State_LGD', 'value'],
      joinBy: 'State_LGD',
      name: settings.name, //'Total Patients',
      states: {
        hover: {
          color: '#a4edba'
        }
      },
      dataLabels: {
        enabled: settings.showDataLabels,
        format: '{point.properties.STNAME}',
        style: {
            fontSize: '6px',
            fontFamily: 'Verdana, sans-serif'
          }
      } 
    }
  ]
  });

});

  function stateMap(stateLGD){
	  let baseUrl='https://gobardhan.indevconsultancy.com/';
	  //let baseUrl='http://localhost/gobardhan/';
      var stateName = stateLGD.replace(/\ /g, '').toLowerCase();
      Highcharts.getJSON(baseUrl+'assets/states/'+stateName+'.json', function (geojson) {
      Highcharts.mapChart(settings.mapId, {
        chart: {
			backgroundColor:settings.bgColor,
            map: geojson,
			height:settings.height
        },
        title: {
          text: ''
        },
        accessibility: {
          typeDescription: ''
        },
        mapNavigation: {
          enabled: settings.zoomButton,
          buttonOptions: {
            verticalAlign: 'bottom'
          }
        },
        colorAxis: {
          min: 1,
          minColor: settings.minColor, //'#edfaef',
          maxColor: settings.maxColor, //'#00450c',
          // stops: [
          //   [0, '#edfaef'],
          //   [0.67, '#1ed14b'],
          //   [1, '#00450c']
          // ]
        },
        plotOptions:{
            series:{
              point:{
                  events:{
                      click: function(){
                          /*var dtname = this.properties.dtname; */
                        }
                    }
                }
            }
        },
        tooltip: {
			pointFormatter: function() {
				return '<b>'+this.properties.dtname+'</b>: '+ this.value;
			}
		},
		exporting:{
            enabled: settings.exportButton,
        },
		legend:{
			symbolWidth:settings.legendWidth,
      enabled:false
		},
        series: [{
          data: settings.drilldowndata,
          keys: ['Dist_LGD', 'value'],
          joinBy: 'Dist_LGD',
          name: settings.name,
          states: {
            hover: {
              color: '#a4edba'
            }
          },
          dataLabels: {
            enabled: settings.showDataLabels,
            format: '{point.properties.dtname}'
          } 
        }
      ]
      });
    });
  }
};

}($));