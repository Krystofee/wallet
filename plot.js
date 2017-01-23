
/*
*	Name: 		plot.js
*	Author: 	Krystofee
*	Created: 	6.1.2017
*	Desc: 		Configuration and initialization file for js/flot/flot.js
*/

/*
*	To do list:
*				- Make something like expandable column with details of the category, which 
*				  is clicked on. 
*/

$('#whole-plot').height(($('#whole-plot-row').height() * 1.5));


var data = [],
series = Math.floor(Math.random() * 6) + 3;

for (var i = 0; i < series; i++) {
	data[i] = {
		label: "Series" + (i + 1),
		data: Math.floor(Math.random() * 100) + 1
	}
}


$.plot('#whole-plot', data, {
	series: {
		pie: {
			innerRadius: 0.5,
			show: true
		}
	},
	grid: {
		hoverable: true,
		clickable: true
	}
});

$('#whole-plot').bind("plotclick", function(event, pos, obj) {

	if (!obj) {
		return;
	}

	//percent = parseFloat(obj.series.percent).toFixed(2);
	//alert(""  + obj.series.label + ": " + percent + "%");

	var category_name = (obj.series.label).toLowerCase();

	var postData = {category : category-name};

	postData = JSON.stringify(postData);

	$.ajax({
		method: 'POST',
		datatype: 'json',
		url: 'pie-getter.php',
		data: {myData:postData},
		success: function(out) {
			console.log(out);
		},
		error: function(xhr, ajaxOptions, thrownError){
			console.log(xhr.status);
		},
	});

});