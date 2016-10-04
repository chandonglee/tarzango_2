 var grandtotal = 0;
 var newsupPrice = 0;
 $(function() {
     var formname = $(".completebook").prop('name');
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


$('.signup_body').hide();
 function completebook(url, msg) {
    var rate_key = $("[name='rateKey']", $("#bookingdetails")).val();
    var cancel_amount = $("#"+rate_key+'_am').html();
    var cancel_date = $("#"+rate_key+'_da').html();
    var contact_remark = $("#"+rate_key).html();
    $(".summery-text").children(".disp_c_r").html(contact_remark);
    $(".summery-text").children("p").children(".can_date").html(cancel_date);
    $(".summery-text").children("p").children(".can_amt").html(cancel_amount);

     var formname = $(".completebook").prop('name');
     $("#mem_pay").attr('data-name', formname);
     $(".result").html("");
     $('html, body').animate({
         scrollTop: $('#detail-slider').offset().top + 0
     }, 'slow');

     /*$(".completebook").fadeOut("fast");
     $("#waiting").html("Please Wait...");*/
     var mem_type = $("#click_type").val();
     if (mem_type != "cont_as_free" && mem_type != 'already_member') {
        $(".divLoading").show();
         $.post(url + "admin/ajaxcalls/attrprocessMemberignup", $("#bookingdetails, #" + formname + "form ").serialize(), function(response) {
            
             var resp = $.parseJSON(response);
             console.log(resp);

             if (resp.error == "yes") {
                 $(".result").html("<div class='alert alert-danger'>" + resp.msg + "</div>");
             } else {
                    $("#bookingdetails").append('<input type="hidden" name="user_id" value="' + resp.msg[0].accounts_id + '">');
                    $('.signup_body').hide();
                    $("#final_book").show();
                    var price = $("[name='normal_price']", $("#bookingdetails")).val();
                    $(".aj_disp_price").html("$ "+price);

                    $.ajax({
                             type: 'POST',
                             data: {
                                 user_id: resp.msg[0].accounts_id
                             },
                             url: url + "admin/ajaxcalls/check_memer_or_not",
                             cache: false,
                             beforeSend: function() {

                             },
                             success: function(response) {
                                 console.log(response);
                                 var resp = $.parseJSON(response);
                                  $(".divLoading").hide();
                                 if (resp.error == 'no') {
                                 } else {
                                     PayStand.build(checkout);
                                     PayStand.showFrame(checkout);
                                     PayStand.checkout(checkout);
                                 }
                                    $("#bookingdetails").append('<input type="hidden" name="user_id" value="' + resp.msg[0].accounts_id + '">');
                                    $('.signup_body').hide();
                                    $("#final_book").show();
                                    var price = $("[name='normal_price']", $("#bookingdetails")).val();
                                    $(".aj_disp_price").html("$ "+price);
                             }
                    });

             }
         });
     } else {
         console.log('booking call');
        $(".divLoading").show();
         $.post(url + "admin/ajaxcalls/attrprocessBooking" + formname, $("#bookingdetails, #" + formname + "form").serialize(), function(response) {
             $(".divLoading").hide();
             var resp = $.parseJSON(response);
             console.log(resp);

             if(resp.error == "no"){
                $("#bookingdetails").append('<input type="hidden" name="user_id" value="' + resp.msg[0].accounts_id + '">');
                $('.signup_body').hide();
                $("#final_book").show();
                var price = $("[name='normal_price']", $("#bookingdetails")).val();
                $(".aj_disp_price").html("$ "+price);
             }else{
                 $(".result").html("<div class='alert alert-danger'>" + resp.msg + "</div>");
             }
         });
                 /*$(".completebook").fadeIn("fast");
                 $("#waiting").html("");*/

     }

 }

function finalbook(url){
    var formname = $(".completebook").prop('name');
            $(".divLoading").show();
    $.post(url + "admin/ajaxcalls/attrprocessBooking_final", $("#bookingdetails , #final_book , #" + formname + "form").serialize(), function(response) {
            var resp = $.parseJSON(response);
             /*console.log(resp);*/
            /* console.log($("#bookingdetails , #guest_details ").serialize());*/
             if (resp.error == "yes") {
                $(".divLoading").hide();
                 $(".result").html("<div class='alert alert-danger'>" + resp.msg + "</div>");
                 
             } else {
                 setTimeout(function() {
                    window.location.replace(resp.url);
                 }, 2000);

             }

    });
}


 function completebook_login(url, msg) {
    var formname = $(".completebook").prop('name');
    $("#mem_pay").attr('data-name', formname);
    $(".result").html("");
    $('html, body').animate({
        scrollTop: $('#detail-slider').offset().top + 300
    }, 'slow');

    var rate_key = $("[name='rateKey']", $("#bookingdetails")).val();
    var cancel_amount = $("#"+rate_key+'_am').html();
    var cancel_date = $("#"+rate_key+'_da').html();
    var contact_remark = $("#"+rate_key).html();
    $(".summery-text").children(".disp_c_r").html(contact_remark);
    $(".summery-text").children("p").children(".can_date").html(cancel_date);
    $(".summery-text").children("p").children(".can_amt").html(cancel_amount);

    $('.login').hide();
    $("#final_book").show();

    var mem_type = $("#click_type").val();

    if (mem_type == "cont_as_upg_vip") {
        $(".divLoading").show();
         $.post(url + "admin/ajaxcalls/attrprocessMemberignup", $("#bookingdetails, #" + formname + "form ").serialize(), function(response) {
             var resp = $.parseJSON(response);
             console.log(resp);
            $(".divLoading").hide();
             if (resp.error == "yes") {
                 $(".result").html("<div class='alert alert-danger'>" + resp.msg + "</div>");
             } else {
                $.ajax({
                         type: 'POST',
                         data: {
                             user_id: resp.msg[0].accounts_id
                         },
                         url: url + "admin/ajaxcalls/check_memer_or_not",
                         cache: false,
                         beforeSend: function() {

                         },
                         success: function(response) {
                            $(".divLoading").hide();
                             console.log(response);
                             var resp = $.parseJSON(response);
                             if (resp.error == 'no') {
                             } else {
                                 PayStand.build(checkout);
                                 PayStand.showFrame(checkout);
                                 PayStand.checkout(checkout);
                             }
                                $("#bookingdetails").append('<input type="hidden" name="user_id" value="' + resp.msg[0].accounts_id + '">');
                                $('.signup_body').hide();
                                $("#final_book").show();
                                var price = $("[name='normal_price']", $("#bookingdetails")).val();
                                $(".aj_disp_price").html("$ "+price);
                         }
                });

                    /*PayStand.build(checkout);
                    PayStand.showFrame(checkout);
                    PayStand.checkout(checkout);*/
             }
         });
        /*PayStand.build(checkout);
        PayStand.showFrame(checkout);
        PayStand.checkout(checkout);*/
        var price = $("[name='vip_price']", $("#bookingdetails")).val();
        $(".aj_disp_price").html("$ "+price);
     }else if(mem_type == 'already_member'){
         var price = $("[name='vip_price']", $("#bookingdetails")).val();
        $(".aj_disp_price").html("$ "+price);
     } else {
        var price = $("[name='normal_price']", $("#bookingdetails")).val();
        $(".aj_disp_price").html("$ "+price);
        

     }
     //console.log(mem_check);
     console.log(formname);

 }

 function completebook_vip_btn(url, msg) {

     /*PayStand.build(checkout);
     PayStand.showFrame(checkout);
     PayStand.checkout(checkout);*/
     var formname = $(".completebook").prop('name');
     $("#mem_pay").attr('data-name', formname);
     $(".result").html("");
     $('html, body').animate({
         scrollTop: $('#detail-slider').offset().top + 300
     }, 'slow');

     /*$(".completebook").fadeOut("fast");
     $("#waiting").html("Please Wait...");*/
     var user_id = $(".user_id_check").val();

     if (typeof user_id != 'undefined') {

         $.ajax({
             type: 'POST',
             data: {
                 user_id: user_id
             },
             url: url + "admin/ajaxcalls/check_memer_or_not",
             cache: false,
             beforeSend: function() {

             },
             success: function(response) {
                 console.log(response);
                 var resp = $.parseJSON(response);
                 if (resp.error == 'no') {
                     $.post(url + "admin/ajaxcalls/processBooking" + formname, $("#bookingdetails ,#guest_details, #" + formname + "form").serialize(), function(response) {
                         var resp = $.parseJSON(response);
                         console.log(resp);

                         if (resp.error == "yes") {
                             $(".result").html("<div class='alert alert-danger'>" + resp.msg + "</div>");
                             $(".completebook").fadeIn("fast");
                             $("#waiting").html("");

                         } else {
                             $(".bdetails").addClass("complete");
                             $(".bdetails").removeClass("active");
                             $(".bsuccess").removeClass("disabled");
                             $(".bsuccess").addClass("active");
                             $(".bsuccess").addClass("complete");
                             $(".acc_section").hide();
                             $(".extrasection").hide();
                             $(".final_section").fadeIn("fast");
                             $(".result").html("");


                             setTimeout(function() {
                                 window.location.replace(resp.url);
                             }, 2000);

                         }

                     });
                 } else {
                     PayStand.build(checkout);
                     PayStand.showFrame(checkout);
                     PayStand.checkout(checkout);
                 }
             }
         });


     } else {
         PayStand.build(checkout);
         PayStand.showFrame(checkout);
         PayStand.checkout(checkout);
         console.log('elseeeeee');
     }

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