
$(function(){
	  $.ajax({
	    url: 'http://localhost/DBMS_NEW/DBMS/admin/report_data/cat_likes_data.php',
	    type: 'GET',
	    success : function(data) {
	      chartData = data;
	      var chartProperties = {
	        "caption": "Love for categories",
	        "xAxisName": "Categories",
	        "yAxisName": "No. of likes",
	        "rotatevalues": "1",
	        "theme": "zune"
	      };
	      apiChart = new FusionCharts({
	        type: 'column2d',
	        renderAt: 'catlikes_bargraphs',
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