
$(function(){
	  $.ajax({
	    url: 'http://localhost/DBMS_NEW/DBMS/admin/report_data/cat_likes_data.php',
	    type: 'GET',
	    success : function(data) {
	      chartData = data;
	      var chartProperties = {
	        "caption": "tytyty",
	        "xAxisName": "Player",
	        "yAxisName": "Wickets Taken",
	        "rotatevalues": "1",
	        "theme": "zune"
	      };
	      apiChart = new FusionCharts({
	        type: 'column2d',
	        renderAt: 'chart-container',
	        width: '550',
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