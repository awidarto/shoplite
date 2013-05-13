// JavaScript Document
/*
Author: Bagga Creatives Australia
Author URI: http://www.bcreatives.com.au/
*/

(function($) {
	$(document).ready(function() {
		
		var inputField = site_data.inputField;
		var inputWidth = 0;
		
		var absPath = "";
		if(site_data.inputField == ""){
			inputField = "s";
		}
		
		$('input#'+inputField).result(function(event, data, formatted) {
			$('#result').html( !data ? "No match!" : "Selected: " + formatted);
		}).blur(function(){		
		});
		
		$(function() {		
		function format(mail) {
			return "<a href='"+mail.permalink+"'><img src='" + mail.image + "' /><span class='title'>" + mail.title +"</span></a>";
		}
		
		function link(mail) {
			return mail.permalink
		}

		function title(mail) {
			return mail.title
		}
		
		if(site_data.autoCompleteWidth == 0) inputWidth = $('input#'+inputField).outerWidth();
		else inputWidth = site_data.autoCompleteWidth;
		
		$.ajaxSetup({ type: "post" });
		$('input#'+inputField).autocomplete("../wp-content/plugins/foxycomplete/getValues.php", {
			extraParams: {verifiedCheck: site_data.autocompleteNounce},
			minChars: 2,
			//you may set your own width here
			width: inputWidth,
			max: site_data.resultLimit,
			scroll: false,
			dataType: "json",
			parse: function(data) {
				return $.map(data, function(row) {
					return {
						data: row,
						value: row.title,
						result: $('input#'+inputField).val()
					}
				});
			},
			formatItem: function(item) {				
				return format(item);
			}
			}).result(function(e, item) {
				$('input#'+inputField).val(title(item));
				location.href = link(item);
			});
		});
				
	});
})(jQuery);