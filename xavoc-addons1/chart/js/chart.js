$.each(
{
	this_chart: undefined,
	draw: function(container,json_options){
		var options=new Object();
		options =jQuery.parseJSON( json_options );
		this.this_chart = new Highcharts.Chart(options);
	},

	addSeries: function(options){
		alert('HI');	
		// this.this_chart.addSeries(options);
	}

},$.univ._import);