 var grandtotal = 0;
 var newsupPrice = 0;
 $(function() {
     var formname = $(".completebook").prop('name');
     console.log('-----------------' + formname);
     $("#mem_pay").attr('data-name', 'login');
     $("#guesttab").on('click', function() {

         $(".completebook").prop('name', 'guest');

     })

     $("#signintab").on('click', function() {
         $('.Viptab').show();
         $(".completebook").prop('name', 'login');
         $("#mem_pay").attr('data-name', 'login');

     })

     $("#signuptab").on('click', function() {
         $('.Viptab').show();
         $(".completebook").prop('name', 'signup');
         $("#mem_pay").attr('data-name', 'signup');
     })

 });


function bookSummerytest(){

    $('html, body').animate({
        scrollTop: $('#detail-slider').offset().top + 500
    }, 'slow');

    $('#vip_drop_select').hide();
    $(".booksummary").show();
}

 function completebook(url, msg) {

     var formname = $(".completebook").prop('name');
     $("#mem_pay").attr('data-name', formname);
     $(".result").html("");
     $('html, body').animate({
         scrollTop: $('#detail-slider').offset().top + 500
     }, 'slow');

     
     var mem_type = $("#click_type").val();
    // console.log(mem_type);
     if (mem_type != "cont_as_free" && mem_type != 'already_member') {
         $.post(url + "admin/carajaxcalls/process" + formname, $("#" + formname + "form").serialize(), function(response) {
             var resp = $.parseJSON(response);
             console.log(resp);

             if (resp.error == "yes") {
                 $(".result").html("<div class='alert alert-danger'>" + resp.msg + "</div>");
             } else {
                 
                 $("#bookingdetails").append('<input type="hidden" name="user_id" id="user_id" value="' + resp.user_id + '">');

                 $('.book_extra_hide').hide();
                 $(".result").html("");
                 
                 if (resp.mem_data != null){

                    $('#vip_drop_select').show();   

                 }else{

                    PayStand.build(checkout);
                    PayStand.showFrame(checkout);
                    PayStand.checkout(checkout);

                 }

             }
         });
     } else {

        //console.log('else');
        
         $.post(url + "admin/carajaxcalls/process" + formname, $("#" + formname + "form").serialize(), function(response) {
             var resp = $.parseJSON(response);
             
             console.log(resp);

             if (resp.error == "yes") {
                 $(".result").html("<div class='alert alert-danger'>" + resp.msg + "</div>");
                 $(".completebook").fadeIn("fast");
                 $("#waiting").html("");

             } else {
                 
                 $("#bookingdetails").append('<input type="hidden" name="user_id" value="' + resp.user_id + '">');

                 $('.book_extra_hide').hide();
                 $(".result").html("");
                 
                 if (resp.mem_data != null){

                    $('#vip_drop_select').show();   

                 }else{

                    $(".check-out-form").hide();
                    $(".booksummary").show();

                 }
                 

             }


         });

     }
     //console.log(mem_check);
     //console.log(formname);

 }

function completebook_confirm(url, msg) {

     var formname = $(".completebook").prop('name');
     $("#mem_pay").attr('data-name', formname);
     $(".result").html("");
     $('html, body').animate({
         scrollTop: $('#detail-slider').offset().top + 500
     }, 'slow');

     
     var mem_type = $("#click_type").val();
    console.log(mem_type);

     if (mem_type != "cont_as_free" && mem_type != 'already_member') {
         $.post(url + "admin/carajaxcalls/processBooking", $("#bookingdetails,#guest_details").serialize(), function(response) {
             var resp = $.parseJSON(response);
            // console.log(resp);

                setTimeout(function() {
                     window.location.replace(resp.url);
                 }, 2000);

         });
     } else {

        
       $("#err_term").text("");
       var policy = $("input[name='attantion']:checked").val();

       if (typeof policy != "undefined") {

             $.post(url + "admin/carajaxcalls/processBooking", $("#bookingdetails,#guest_details").serialize(), function(response) {
                 var resp = $.parseJSON(response);
                  console.log(resp);

                  setTimeout(function() {
                     window.location.replace(resp.url);
                 }, 2000);

             });  

      } else {
            $("#err_term").text("Please select the checkbox for policy");
      }

     }
     //console.log(mem_check);
     //console.log(formname);

 }

 function completebook_login(url, msg) {
     var formname = $(".completebook").prop('name');
     $("#mem_pay").attr('data-name', formname);
     $(".result").html("");
     $('html, body').animate({
         scrollTop: $('#detail-slider').offset().top + 500
     }, 'slow');

     
     var mem_type = $("#click_type").val();
     console.log('-------'+mem_type);
     if (mem_type == "cont_as_upg_vip" || mem_type == 'already_member') {
         
         $('.book_extra_hide').hide();

         $(".result").html("");
         
         if (mem_type == 'already_member'){

            $('#vip_drop_select').show();   

         }else{

                $.post(url + "admin/carajaxcalls/processlogged", function(response) {
                     var resp = $.parseJSON(response);
                     console.log(resp);

                     if (resp.error == "yes") {
                         $(".result").html("<div class='alert alert-danger'>" + resp.msg + "</div>");
                         $(".completebook").fadeIn("fast");
                         $("#waiting").html("");

                     } else {
                         
                        $("#bookingdetails").append('<input type="hidden" name="user_id" id="user_id" value="' + resp.user_id + '">');

                        PayStand.build(checkout);
                        PayStand.showFrame(checkout);
                        PayStand.checkout(checkout);

                     }

                 });

         }         

     } else {
         
            $('.book_extra_hide').hide();
            $(".result").html("");

            $(".check-out-form").hide();
            $(".booksummary").show();

     }
     //console.log(mem_check);
     console.log(formname);

 }

 
 function updateBookingData(url) {
     //var formname = $(".completebook").prop('name');
     $.post(url, $("#bookingdetails").serialize(), function(response) {
         var resp = $.parseJSON(response);

         $("#displaytotal").html(resp.grandTotal);
         $("#displaytax").html(resp.taxAmount);
         $("#displaydeposit").html(resp.depositAmount);
         $("#displaypmethod").html(resp.paymethodFee);
         $(".allextras").remove();
         $(".beforeExtraspanel").after(resp.extrashtml);
         console.log(resp);


     });

 }

 function select_tour_sup(price, title, supid, currency) {

     var commissiontype = $("#commission").attr('class');
     var commissionvalue = parseFloat($("#commission").val());
     var taxtype = $("#tax").attr('class');
     var taxvalue = parseFloat($("#tax").val());

     if (newsupPrice < 0) {
         newsupPrice = 0;
     }
     var countsupp = $('div[id^=supp_' + supid + ']').length;
     if (countsupp < 1) {

         add_sup_to_right_div(supid, title, price, currency);
     }

     if (!$("#supplements_" + supid).prop('checked')) {
         $('.rightpanel').find('#supp_' + supid).remove();
         newsupPrice -= price;
     } else {
         newsupPrice += price;
     }



     $("#totalsupamount").val(newsupPrice);

     var tts = parseFloat($("#totaltouramount").val()) + parseFloat($("#totalsupamount").val());
     if (taxtype == 'fixed') {

         $("#taxamount").val(taxvalue);
         $("#displaytax").html(currency + taxvalue);
     } else {
         var taxper = parseFloat(parseFloat(tts) * parseFloat(taxvalue) / 100).toFixed(2);

         $("#taxamount").val(taxper);
         $("#displaytax").html(currency + taxper);
     }

     var totalaftertax = parseFloat($("#taxamount").val()) + tts;
     var paymetodfee = parseFloat($(".paymethod option:selected").data('fee')) || 0;
     var payfeeamount = parseFloat(tts) * parseFloat(paymetodfee) / 100;

     var totalafterpaytax = parseFloat(parseFloat(payfeeamount) + totalaftertax).toFixed(2);

     if (commissiontype == 'percentage') {

         var totaldeposit = parseFloat(totalafterpaytax) * parseFloat(commissionvalue) / 100;


         $("#topaytotal").html(currency + parseFloat(totaldeposit).toFixed(2));

         $("#totaltopay").val(parseFloat(totaldeposit).toFixed(2));

     } else {

         commissionvalue = parseFloat($("#commission").val()).toFixed(2);

         $("#topaytotal").html(currency + commissionvalue);

         $("#totaltopay").val(parseFloat(commissionvalue).toFixed(2));

     }


     $("#grandtotal").html(currency + totalafterpaytax);
     $("#paymethodfee").val(payfeeamount);
 }

 $("#selectDropOff").click(function(){
    $("#vip_drop_select").hide();
    $("#vip_drop_details").show();
 });

 $("#selectTo").click(function(){

   $(".error").text('');

    if ( $("#pickup_date").val() == "") {
        $("#err_pic_date").text('Please select pickup date');
        return false;
    } else if ( $("#pickup_country").val() == "" && $("#pickup_terminal").val() == "") {
        $("#err_pic_cnt").text('Please select country');
        $("#err_pic_term").text('Please select terminal');
        return false;
    } else if ( $("#pickup_country").val() == "") {
        $("#err_pic_cnt").text('Please select country');
        return false;
    } else if ( $("#pickup_terminal").val() == "") {
        $("#err_pic_term").text('Please select terminal');
        return false;
    }else {
         $("#vip_drop_to").hide();
        $("#vip_drop_from").show();
    }


   
 });

$(document).ready(function(){
 $("input[type='radio']").click(function(){
        
        var BookType = $("input[name='BookType']:checked").val();
        if(BookType == "oneway"){
           $("#dep").hide();
        } else{
            $("#dep").show();
        }
    });
 });