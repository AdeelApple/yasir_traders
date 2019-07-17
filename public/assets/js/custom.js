document.onkeyup = function(e) {
  if (e.shiftKey && e.which == 13) {
    if($('#stock_btn').length)
        add_stock_row()
        else
        add_invoice_row()
    // delete row
  }
};




    function getdate(d){
    var today = new Date();
    var day = today.getDay();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    var weekdays = new Array(7);
    weekday = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
    if(dd<10) { dd = '0'+dd;    }
    if(mm<10) {    mm = '0'+mm      }
    if(d=='/')
        return dd + '/' + mm +  '/' + yyyy;
    if(d=='-')
        return yyyy+"-"+ mm + '-' + dd;
    if(d=='day')
        return weekdays[day] +" "+ dd + '/' + mm + '/' + yyyy;
    }

    
    function today_date(){  $(".date").html(getdate('/')); }
    function today_form_date(){ $(".date").val(getdate('-'));   }
        
         

    function sum(a,b){  return Number(Number(a) + Number(b)).toFixed(2);    }
    function sub(a,b){  return Number(Number(a) - Number(b)).toFixed(2);    }
    function mul(a,b){  return Number(Number(a) * Number(b)).toFixed(2);    }
    function div(a,b){  return Number(Number(a) / Number(b)).toFixed(2);    }



    // Filter & Pagination

 function filter(page=1){

    var filter = '';
    $('.filter').each(function(ind,el){
        if($(el).val()!=='')
        filter += '&' + $(el).attr('id') + '=' + $(el).val();
    });
    var url = $("#table").attr("data-url")
    // console.log(filter);
    axios.get(url+'?page='+page+filter).then(d => $('#table').html(d.data));
}

$(document).on('click', '.pagination a', function(event){
  event.preventDefault();
  var page = $(this).attr('href').split('page=')[1];
  $('li').removeClass('active');
    $(this).parent().addClass('active');
    filter(page)
});
    // Filter & Pagination






    // Stock Functions

add_stock_row = function(){
    axios.get('/get_stock_row').then(d => $('#rows').append(d.data));
}
delRow = function(btn){
    $(btn).closest('.row').remove();
}

// Invoice Functions

countTotalPrice = function(obj){
    var qty = $(obj).closest('tr').find('.qty').val();
    var unit_price = $(obj).closest('tr').find('.unit_price').val();
    $(obj).closest('tr').find('.total_price').val(mul(qty,unit_price));
    countDoscountTotal(obj);
    countDiscountAmount(obj);
}

countDiscountAmount = function(obj){
    var discount = $(obj).closest('tr').find('.discount').val();
    var total_price = $(obj).closest('tr').find('.total_price').val();
    var discount_amount = mul(div(total_price,100),discount);
    $(obj).closest('tr').find('.discount_amount').val(discount_amount);

    countDoscountTotal(obj);
}
countDoscountTotal = function(obj){
    var total_price = $(obj).closest('tr').find('.total_price').val();
    var discount_amount = $(obj).closest('tr').find('.discount_amount').val();
    $(obj).closest('tr').find('.discount_total').val(sub(total_price,discount_amount));

    countInvoiceDiscount();
}

countInvoiceDiscount = function(){
    var rows = $('#tbody').children();
    var invoiceTotalAmount = 0.00;
    var invoiceTotalDiscount = 0.00;
    var invoiceDiscountTotal = 0.00;
    for(var i=0; i<rows.length;i++){

        invoiceTotalAmount = sum(invoiceTotalAmount,$(rows[i]).find('.total_price').val());
        invoiceTotalDiscount = sum(invoiceTotalDiscount,$(rows[i]).find('.discount_amount').val());
        invoiceDiscountTotal = sum(invoiceDiscountTotal,$(rows[i]).find('.discount_total').val());

    }

    $('#total_amount').val(invoiceTotalAmount);
    $('#total_discount').val(invoiceTotalDiscount);
    $('#discount_total').val(invoiceDiscountTotal);
}

add_invoice_row = function(){
    axios.get('/get_invoice_row').then(d => $('#tbody').append(d.data));
}
delInvoiceRow = function(btn){
    
        // delete row
        $(btn).closest('tr').remove();

}




count_per_unit_purchase = function(obj){
    
        var total_price = $(obj).closest('.row').find('.total_purchase').val();
        var qty = $(obj).closest('.row').find('.qty').val();
        $(obj).closest('.row').find('.unit_purchase').val(div(total_price,qty));

}

    // Receive Invoice


receiveInvoice = function(obj,id){
    var tr = $(obj).closest('tr');
    var received_amount = $(tr).find('.received_amount').val();
    if (received_amount) {
        
    }
    axios.post('/invoice_receive',{id:id,received_amount:received_amount})
    .then(d => {
        console.log(d.data);
        $(tr).remove()}).catch(e => console.log(e));

}


jQuery(document).ready(function($) {


	$('#company').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "/search_companies",
				data: 'searchString=' + query,            
                dataType: "json",
                type: "GET",
                success: function (data) {
					result($.map(data, function (item) {
						return item;
                    }));
                }
            });
        }
    });

    $('#customer').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "/search_customer",
                data: 'searchString=' + query,            
                dataType: "json",
                type: "GET",
                success: function (data) {
                    result($.map(data, function (item) {
                        return item;
                    }));
                }
            });
        }
    });

    $('#orderbooker').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "/search_orderbooker",
                data: 'searchString=' + query,            
                dataType: "json",
                type: "GET",
                success: function (data) {
                    result($.map(data, function (item) {
                        return item;
                    }));
                }
            });
        }
    });

    $('#saleman').typeahead({
        source: function (query, result) {
            $.ajax({
                url: "/search_salemen",
                data: 'searchString=' + query,            
                dataType: "json",
                type: "GET",
                success: function (data) {
                    result($.map(data, function (item) {
                        return item;
                    }));
                }
            });
        }
    });

 });

