
$(function(){
	  $.ajax({
	    url: 'http://localhost/DBMS_NEW/DBMS/admin/report_data/reg_timeline.php',
	    type: 'GET',
	    success : function(data) {
	      chartData = data;
	      var chartProperties = {
	        "caption": "Yearwise Pinstagram Registrations",
	        "xAxisName": "Year",
	        "yAxisName": "No. of Pinstagram Users",
	        "rotatevalues": "1",
	        "theme": "zune",
	        "palettecolors": "#09192A"
	      };
	      apiChart = new FusionCharts({
	        type: 'column3d',
	        renderAt: 'reg_timeline',
	        width: '450',
	        height: '350',
	        dataFormat: 'json',
	        dataSource: {
	          "chart": chartProperties,
	          "data": chartData
	        }
	      });
	      apiChart.render();
	    }
	  });
	});