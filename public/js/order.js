// UTILITY FUNCTIONS 

function IsNumeric(n) {
    return !isNaN(n);
} 

function CleanNumber(value) {

    // Assumes string input, removes all commas, dollar signs, and spaces      
    newValue = value.replace(",","");
    newValue = newValue.replace("$","");
    newValue = newValue.replace(/ /g,'');
    return newValue;
    
}

function CommaFormatted(amount) {
    
	var delimiter = ","; 
	var i = parseInt(amount);
	
	if(isNaN(i)) { return ''; }
	
	i = Math.abs(i);
	
	var minus = '';
	if (i < 0) { minus = '-'; }
	
	var n = new String(i);
	var a = [];
	
	while(n.length > 3)
	{
		var nn = n.substr(n.length-3);
		a.unshift(nn);
		n = n.substr(0,n.length-3);
	}
	
	if (n.length > 0) { a.unshift(n); }
	
	n = a.join(delimiter);
	
	amount = minus + n;
	
	return amount;
	
}


// ORDER FORM UTILITY FUNCTIONS

function applyName(klass, numPallets) {

    var toAdd = $("td." + klass).text();
    
    var actualClass = $("td." + klass).attr("rel");
    
    $("input." + actualClass).attr("value", numPallets + " pallets");
    
}

function removeName(klass) {
    
    var actualClass = $("td." + klass).attr("rel");
    
    $("input." + actualClass).attr("value", "");
    
}

function calcTotalPallets() {

    var totalPallets = 0;

    $(".num-pallets-input").each(function() {
    
        var thisValue = parseInt($(this).val());
    
        if ( (IsNumeric(thisValue)) &&  (thisValue != '') ) {
            totalPallets += parseInt(thisValue);
        };
    
    });
    
    $("#total-pallets-input").val(totalPallets);

}

function calcProdSubTotal() {
    
    var prodSubTotal = 0;

    $(".row-total-input").each(function() {
    
        var valString = $(this).val() || 0;
        
        prodSubTotal += parseInt(valString);
        
    });
    var instalationFee = $('#operationalfeeelectric').val();

    if(prodSubTotal!=0){
        prodSubTotal = prodSubTotal+parseInt(instalationFee);    
    }else{
        prodSubTotal = prodSubTotal;
    }

    
    $("#product-subtotal").text(CommaFormatted(prodSubTotal));
    $("#electricsubtotal").val(prodSubTotal);

}

function calcTax() {

    var totaltax = 0;

    var productSubtotal = $("#product-subtotal").text() || 0;

    var totaltax = (10 * parseInt(CleanNumber(productSubtotal)))/100;    
    
    $("#product-tax").text(CommaFormatted(totaltax));
    $("#electrictax").val(totaltax);

}




function calcShippingTotal() {

    var totalPallets = $("#total-pallets-input").val() || 0;
    var shippingRate = $("#shipping-rate").text() || 0;
    var shippingTotal = totalPallets * shippingRate;
    
    $("#shipping-subtotal").val(CommaFormatted(shippingTotal));

}

function calcOrderTotal() {

    var orderTotal = 0;

    var productSubtotal = $("#product-subtotal").text() || 0;
    //var taxTotal = $("#product-tax").text() || 0;
    var taxTotal = '0';
        
    var orderTotal = parseInt(CleanNumber(productSubtotal)) + parseInt(CleanNumber(taxTotal));    
        
    $("#order-total").text(CommaFormatted(orderTotal));
    
    $("#electricgrandtotal").val(orderTotal);
    
}



// DOM READY
$(function() {

    var inc = 1;

    $(".product-title").each(function() {
        
        $(this).addClass("prod-" + inc).attr("rel", "prod-" + inc);
    
        var prodTitle = $(this).text();
                
        $("#foxycart-order-form").append("<input type='hidden' name='" + prodTitle + "' value='' class='prod-" + inc + "' />");
        
        inc++;
    
    });
    
    // Reset form on page load, optional
    $("#order-table input[type=text]:not('#product-subtotal')").val("");
    $("#product-subtotal").val("0");
    //$("#shipping-subtotal").val("$0");
    //$("#fc-price").val("$0");
    //$("#order-total").val("$0");
    //$("#total-pallets-input").val("0");
    
    // "The Math" is performed pretty much whenever anything happens in the quanity inputs
    $('.num-pallets-input').bind("focus blur change keyup", function(){
    
        // Caching the selector for efficiency 
        var $el = $(this);
    
        // Grab the new quantity the user entered
        var numPallets = CleanNumber($el.val());
                
        // Find the pricing
        var multiplier = $el
            .parent().parent()
            .find("td.price-per-pallet span")
            .text();
        
        // If the quantity is empty, reset everything back to empty
        if ( (numPallets == '') || (numPallets == 0) ) {
        
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
        
        // If the quantity is valid, calculate the row total
        } else if ( (IsNumeric(numPallets)) && (numPallets != '') ) {
            
            var rowTotal = numPallets * multiplier;
            
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val(rowTotal);
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
                    
            applyName(titleClass, numPallets);
        
        // If the quantity is invalid, let the user know with UI change                                    
        } else {
        
            $el
                .addClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
            
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
                                          
        };
        
        // Calcuate the overal totals
        calcProdSubTotal();
        calcTax();
        //calcTotalPallets();
        //calcShippingTotal();
        calcOrderTotal();
    
    });

    $('.num-pallets-input-phone').bind("focus blur change keyup", function(){
    
        // Caching the selector for efficiency 
        var $el = $(this);
    
        // Grab the new quantity the user entered
        var numPallets = CleanNumber($el.val());
                
        // Find the pricing
        var multiplier = $el
            .parent().parent()
            .find("td.price-per-pallet span")
            .text();
        
        // If the quantity is empty, reset everything back to empty
        if ( (numPallets == '') || (numPallets == 0) ) {
        
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
        
        // If the quantity is valid, calculate the row total
        } else if ( (IsNumeric(numPallets)) && (numPallets != '') ) {
            
            var rowTotal = numPallets * multiplier;
            
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val(rowTotal);
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
                    
            applyName(titleClass, numPallets);
                                       
        } else {
        
            $el
                .addClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
            
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
                                          
        };
        
        
        calcProdSubTotalPhone();
        calcTaxPhone();
        calcOrderTotalPhone();
    
    });

    function calcOrderTotalPhone() {

        var orderTotal = 0;

        var productSubtotal = $("#subTotalPhone").text() || 0;
        //var taxTotal = $("#faxTotalPhone").text() || 0;
        var taxTotal = "0";
            
        var orderTotal = parseInt(CleanNumber(productSubtotal)) + parseInt(CleanNumber(taxTotal));    
            
        $("#grandTotalPhone").text(CommaFormatted(orderTotal));
        
        $("#phonegrandtotal").val(orderTotal);
        
        
    }

    function calcProdSubTotalPhone() {
    
        var prodSubTotal = 0;

        $(".row-total-input-phone").each(function() {
        
            var valString = $(this).val() || 0;
            
            prodSubTotal += parseInt(valString);

            
        });
        
        $("#subTotalPhone").text(CommaFormatted(prodSubTotal));
        $("#phonesubtotal").val(prodSubTotal);

    }

    function calcTaxPhone() {

        var totaltax = 0;

        var productSubtotal = $("#subTotalPhone").text() || 0;

        var totaltax = (10 * parseInt(CleanNumber(productSubtotal)))/100;    
        
        $("#faxTotalPhone").text(CommaFormatted(totaltax));
        $("#phonetax").val(totaltax);

    }

    //calculate furniture

    $('.num-pallets-input-furniture').bind("focus blur change keyup", function(){
    
        // Caching the selector for efficiency 
        var $el = $(this);
    
        // Grab the new quantity the user entered
        var numPallets = CleanNumber($el.val());
                
        // Find the pricing
        var multiplier = $el
            .parent()
            .attr('price');
            
        
        // If the quantity is empty, reset everything back to empty
        if ( (numPallets == '') || (numPallets == 0) ) {
        
            $el
                .removeClass("warning")
                .parent()
                .find(".row-total-input-furniture")
                .val("");
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
        
        // If the quantity is valid, calculate the row total
        } else if ( (IsNumeric(numPallets)) && (numPallets != '') ) {
            
            var rowTotal = numPallets * multiplier;
            
            $el
                .removeClass("warning")
                .parent()
                .find(".row-total-input-furniture")
                .val(rowTotal);
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
                    
            applyName(titleClass, numPallets);
                                       
        } else {
        
            $el
                .addClass("warning")
                .parent()
                .find(".row-total-input-furniture")
                .val("");
            
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
                                          
        };
        
        
        calcProdSubTotalFurniture();
        calcTaxFurniture();
        calcOrderTotalFurniture();
    
    });

    function calcProdSubTotalFurniture() {
        
        var prodSubTotal = 0;

        $(".row-total-input-furniture").each(function() {
        
            var valString = $(this).val() || 0;
            
            prodSubTotal += parseInt(valString);

            
        });
        
        $("#subTotalFurniture").text(CommaFormatted(prodSubTotal));
        $("#furnituresubtotal").val(prodSubTotal);

    }
    function calcTaxFurniture() {

        var totaltax = 0;

        var productSubtotal = $("#subTotalFurniture").text() || 0;

        var totaltax = (10 * parseInt(CleanNumber(productSubtotal)))/100;    
        
        $("#faxTotalFurniture").text(CommaFormatted(totaltax));
        $("#furnituretax").val(totaltax);

    }

    function calcOrderTotalFurniture() {

        var orderTotal = 0;

        var productSubtotal = $("#subTotalFurniture").text() || 0;
        //var taxTotal = $("#faxTotalFurniture").text() || 0;
        var taxTotal = '0';
            
        var orderTotal = parseInt(CleanNumber(productSubtotal)) + parseInt(CleanNumber(taxTotal));    
            
        $("#grandTotalFurniture").text(CommaFormatted(orderTotal));
        $("#furnituregrandtotal").val(orderTotal);
        
    }


    //calculate internet

    $('.num-pallets-input-internet').bind("focus blur change keyup", function(){
    
        // Caching the selector for efficiency 
        var $el = $(this);
    
        // Grab the new quantity the user entered
        var numPallets = CleanNumber($el.val());
                
        // Find the pricing
        var multiplier = $el
            .parent().parent()
            .find("td.price-per-pallet span")
            .text();

        

            
        
        // If the quantity is empty, reset everything back to empty
        if ( (numPallets == '') || (numPallets == 0) ) {
        
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
        
        // If the quantity is valid, calculate the row total
        } else if ( (IsNumeric(numPallets)) && (numPallets != '') ) {
            
            var rowTotal = numPallets * multiplier;
            
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val(rowTotal);
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
                    
            applyName(titleClass, numPallets);
                                       
        } else {
        
            $el
                .addClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
            
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
                                          
        };
        
        countInternetFee();
        calcProdSubTotalInternet();

        calcTaxInternet();
        calcOrderTotalInternet();
    
    });

    function countInternetFee(){
        var internetinstallqty = 0;
        var internetinstallfee = 0;
        var feeperqty = $('#internetinstallfeeperqty').text();

        $(".num-pallets-input-internet").each(function() {
        
            var valString = $(this).val() || 0;
            
            internetinstallqty += parseInt(valString);
            
        });

        
        $(".internetinstallqty").val(internetinstallqty);
        internetinstallfee = feeperqty*internetinstallqty;
        $(".row-total-input-internetfee").val(internetinstallfee);
        
        
        
    }

    function calcProdSubTotalInternet() {
        
        var prodSubTotal = 0;
        
        $(".row-total-input-internet").each(function() {
        
            var valString = $(this).val() || 0;
            
            prodSubTotal += parseInt(valString);

            
        });
        var internetinstallfee = $('#internetinstallfee').val() || 0;
        var totalAll = prodSubTotal+parseInt(internetinstallfee);
        $("#subTotalInternet").text(CommaFormatted(totalAll));
        $("#internetsubtotal").val(totalAll);

    }


    function calcTaxInternet() {

        var totaltax = 0;

        var productSubtotal = $("#subTotalInternet").text() || 0;

        //var totaltax = (10 * parseInt(CleanNumber(productSubtotal)))/100;    
        var taxTotal = '0';
        
        $("#faxTotalInternet").text(CommaFormatted(totaltax));
        $("#internettax").val(totaltax);

    }

    function calcOrderTotalInternet() {

        var orderTotal = 0;

        var productSubtotal = $("#subTotalInternet").text() || 0;
        var taxTotal = $("#faxTotalInternet").text() || 0;
            
        var orderTotal = parseInt(CleanNumber(productSubtotal)) + parseInt(CleanNumber(taxTotal));    
            
        $("#grandTotalInternet").text(CommaFormatted(orderTotal));
        
        $("#internetgrandtotal").val(orderTotal);
        
    }

    //calculate kiosk

    $('.num-pallets-input-kiosk').bind("focus blur change keyup", function(){
    
        // Caching the selector for efficiency 
        var $el = $(this);
    
        // Grab the new quantity the user entered
        var numPallets = CleanNumber($('#numpalletskiosk1').val());
        var numPallets2 = CleanNumber($('#numpalletskiosk2').val());
        var palletskiosk = CleanNumber($('.num-pallets-input-kiosk').val());

        // Find the pricing
        var multiplier = $el
            .parent().parent()
            .find("td.price-per-pallet span")
            .text();
        
        // If the quantity is empty, reset everything back to empty
        if(numPallets != '' ) { var numPalletsNum = parseInt(numPallets);};
        if(numPallets2 != '' ) { var numPalletsNum2 = parseInt(numPallets2);};
        
        if( (numPallets != '' || numPallets != 0) && (numPallets2 != '' || numPallets2 != 0) ){
            var rowTotal = (numPalletsNum+numPalletsNum2) * multiplier;
        }
        else if( (numPallets != '' || numPallets != 0) && (numPallets2 == '' || numPallets2 == 0) ){
            var rowTotal = numPalletsNum * multiplier;
        }
        else if( (numPallets == '' || numPallets == 0) && (numPallets2 != '' || numPallets2 != 0) ){
            var rowTotal = numPalletsNum2 * multiplier;
        }
            
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val(rowTotal);
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
                    
            applyName(titleClass, numPallets);
        
        
        calcProdSubTotalKiosk();
        calcTaxKiosk();
        calcOrderTotalKiosk();
    
    });

    function calcProdSubTotalKiosk() {
        
        var prodSubTotal = 0;

        $(".row-total-input-kiosk").each(function() {
        
            var valString = $(this).val() || 0;
            
            prodSubTotal += parseInt(valString);

            
        });
        
        $("#subTotalKiosk").text(CommaFormatted(prodSubTotal));
        $("#kiosksubtotal").val(prodSubTotal);

    }
    function calcTaxKiosk() {

        var totaltax = 0;

        var productSubtotal = $("#subTotalKiosk").text() || 0;

        var totaltax = (10 * parseInt(CleanNumber(productSubtotal)))/100;    
        
        $("#faxTotalKiosk").text(CommaFormatted(totaltax));
        $("#kiosktax").val(totaltax);

    }

    function calcOrderTotalKiosk() {

        var orderTotal = 0;

        var productSubtotal = $("#subTotalKiosk").text() || 0;
        //var taxTotal = $("#faxTotalKiosk").text() || 0;
        var taxTotal = '0';
            
        var orderTotal = parseInt(CleanNumber(productSubtotal)) + parseInt(CleanNumber(taxTotal));    
            
        $("#grandTotalKiosk").text(CommaFormatted(orderTotal));
        $("#kioskgrandtotal").val(orderTotal);
        //$("#fc-price").attr("value", orderTotal);
        
    }


    $('#totaladdboothinput').bind("focus blur change keyup", function(){
    
        // Caching the selector for efficiency 
        var $el = $(this);
    
        // Grab the new quantity the user entered
        var numPallets = CleanNumber($el.val());
                
        
        
        // If the quantity is empty, reset everything back to empty
        if ( (numPallets == '') || (numPallets == 0) ) {
        
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
        
        // If the quantity is valid, calculate the row total
        } else if ( (IsNumeric(numPallets)) && (numPallets != '') ) {
            
            //var rowTotal = numPallets * multiplier;
            
            /*$el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val(rowTotal);*/
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
                    
            applyName(titleClass, numPallets);
                                       
        } else {
        
            $el
                .addClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
            
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
                                          
        };
        
        
        displayinputadditionalboot();
        calcProdSubTotalAddbooth();
        calcTaxAddbooth();
        calcOrderTotalAddbooth();
        
    
    });

    function displayinputadditionalboot(){
        var totalfields = 0;
        totalfields = $("#totaladdboothinput").val()|| 0;
        totalfieldsNum = parseFloat(totalfields);
        $('.stepContainer').css("height",'659px');

        $('.addboothrow').remove();
        //alert(totalfields);
        if(totalfieldsNum!=0){
            for(var i=1; i<=totalfieldsNum; i++){
                var appendStr = '<tr class="addboothrow">';
                appendStr += '<td>'+i+'. </td>';
                appendStr += '<td><input name="addboothname'+i+'" type="text" class="passholderbooth" id="" placeholder="Type name here"></input></td>';
                appendStr +=  '</tr>';
                //var appendStr = '<div class="form-label"><label for="newfield'+index+'">New field no '+index+'</label></div>'
                //appendStr += '<div class="form-field"><input id="newfield'+index+'" name="newfield'+index+'" size="20" class="exit-detect"></div>'
                var stepContainerHeight = $('.stepContainer').height();
                $('#listaddbooth').append(appendStr);
                $('.stepContainer').css("height",stepContainerHeight+60);
            }
        }
        
    }

    function calcProdSubTotalAddbooth() {
        
        var prodSubTotal = 0;

        $(".row-total-input-addBooth").each(function() {
        
            var valString = $(this).val() || 0;
            
            prodSubTotal += parseInt(valString);

            
        });
        
        $("#subTotalAddbooth").text(CommaFormatted(prodSubTotal));
        $("#addboothsubtotal").val(prodSubTotal);

    }
    function calcTaxAddbooth() {

        var totaltax = 0;

        var productSubtotal = $("#subTotalAddbooth").text() || 0;

        //var totaltax = (10 * parseInt(CleanNumber(productSubtotal)))/100;    
        var taxTotal = '0';
        
        $("#faxTotalAddbooth").text(CommaFormatted(totaltax));
        $("#addboothtax").val(totaltax);

    }

    function calcOrderTotalAddbooth() {

        var orderTotal = 0;

        var productSubtotal = $("#subTotalAddbooth").text() || 0;
        //var taxTotal = $("#faxTotalAddbooth").text() || 0;
        var taxTotal = "0";
            
        var orderTotal = parseInt(CleanNumber(productSubtotal)) + parseInt(CleanNumber(taxTotal));    
            
        $("#grandTotalAddbooth").text(CommaFormatted(orderTotal));
        $("#addboothgrandtotal").val(orderTotal);
        //$("#fc-price").attr("value", orderTotal);
        
    }

    //calculate advert

    $('.num-pallets-input-advert').bind("focus blur change keyup", function(){
    
        // Caching the selector for efficiency 
        var $el = $(this);
    
        // Grab the new quantity the user entered
        var numPallets = CleanNumber($el.val());
                
        // Find the pricing
        var multiplier = $el
            .parent().parent()
            .find("td.price-per-pallet span")
            .text();
        
        // If the quantity is empty, reset everything back to empty
        if ( (numPallets == '') || (numPallets == 0) ) {
        
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
        
        // If the quantity is valid, calculate the row total
        } else if ( (IsNumeric(numPallets)) && (numPallets != '') ) {
            
            var rowTotal = numPallets * multiplier;
            
            $el
                .removeClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val(rowTotal);
                
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
                    
            applyName(titleClass, numPallets);
                                       
        } else {
        
            $el
                .addClass("warning")
                .parent().parent()
                .find("td.row-total input")
                .val("");
            
            var titleClass = $el.parent().parent().find("td.product-title").attr("rel");
            
            removeName(titleClass);
                                          
        };
        
        
        calcProdSubTotalAdvert();
        calcTaxAdvert();
        calcOrderTotalAdvert();
    
    });

    function calcProdSubTotalAdvert() {
    
        var prodSubTotal = 0;

        $(".row-total-input-advert").each(function() {
        
            var valString = $(this).val() || 0;
            
            prodSubTotal += parseInt(valString);
            
        });
        
        $("#subTotalAdvert").text(CommaFormatted(prodSubTotal));
        $("#advertsubtotal").val(prodSubTotal);

    }

    function calcTaxAdvert() {

        var totaltax = 0;

        var productSubtotal = $("#subTotalAdvert").text() || 0;

        var totaltax = (10 * parseInt(CleanNumber(productSubtotal)))/100;    
        
        $("#faxTotalAdvert").text(CommaFormatted(totaltax));
        $("#adverttax").val(totaltax);

    }

    function calcOrderTotalAdvert() {

        var orderTotal = 0;

        var productSubtotal = $("#subTotalAdvert").text() || 0;
        //var taxTotal = $("#faxTotalAdvert").text() || 0;
        var taxTotal = '0';
            
        var orderTotal = parseInt(CleanNumber(productSubtotal)) + parseInt(CleanNumber(taxTotal));    
            
        $("#grandTotalAdvert").text(CommaFormatted(orderTotal));
        
        $("#advertgrandtotal").val(orderTotal);
        
        
    }



});