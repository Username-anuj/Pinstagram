$(function(){
	  $.ajax({
	    url: 'http://localhost/DBMS_NEW/DBMS/admin/report_data/cat_pins_data.php',
	    type: 'GET',
	    success : function(data) {
	      chartData = data;

	      var chartProperties = {
	       "caption": "Category Pins",
        "bgcolor": "FFFFFF",
        "showvalues": "1",
        "showpercentvalues": "1",
        "showborder": "0",
        "showplotborder": "0",
        "showlegend": "1",
        "legendborder": "0",
        "legendposition": "bottom",
        "enablesmartlabels": "1",
        "use3dlighting": "0",
        "showshadow": "0",
        "legendbgcolor": "#CCCCCC",
        "legendbgalpha": "20",
        "legendborderalpha": "0",
        "legendshadow": "0",
        "legendnumcolumns": "2",
        "palettecolors": "#f8bd19,#e44a00,#008ee4,#33bdda,#6baa01,#583e78"
	      };

	      apiChart = new FusionCharts({
	        type: 'pie2d',
	        renderAt: 'catpins_piechart',
	        width: '350',
	        height: '450',
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
// $(function(){
// 	  $.ajax({
// 	    url: 'http://localhost/DBMS_NEW/DBMS/admin/report_data/cat_pins_data.php',
// 	    type: 'GET',
// 	    success : function(data) {
// 	      chartData = data;
// 	      var chartProperties = {
// 	        "caption": "tytyty",
// 	        "xAxisName": "Player",
// 	        "yAxisName": "Wickets Taken",
// 	        "rotatevalues": "1",
// 	        "theme": "zune"
// 	      };
// 	      apiChart = new FusionCharts({
// 	        type: 'column2d',
// 	        renderAt: 'chart-container',
// 	        width: '550',
// 	        height: '350',
// 	        dataFormat: 'json',
// 	        dataSource: {
// 	          "chart": chartProperties,
// 	          "data": chartData
// 	        }
// 	      });
// 	      apiChart.render();
// 	    }
// 	  });
// 	});