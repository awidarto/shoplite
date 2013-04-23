$(document).ready(function(){

	initGantt();
/*
$(".gantt").popover({
	selector: ".bar",
	title: "I'm a popover",
	content: "And I'm the content of said popover."
});
*/
	function initGantt(){
		$(".gantt").gantt({
					source: source_url,
					navigate: "scroll",
					scale: "weeks",
					maxScale: "months",
					minScale: "days",
					itemsPerPage: 10,
					onItemClick: function(data) {
						console.log(data);
						alert("Item clicked - show some details");
					},
					onAddClick: function(dt, rowId) {
						console.log(dt);
						console.log(rowId);
					},
					onRender: function() {
						if (window.console && typeof console.log === "function") {
							console.log("chart rendered");
						}
					}
				});

	}

	$('#refresh').click(function(){
		initGantt();
	});

});