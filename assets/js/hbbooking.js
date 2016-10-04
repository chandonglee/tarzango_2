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



 function completebook(url, msg) {
     var formname = $(".completebook").prop('name');
     $("#mem_pay").attr('data-name', formname);
     $(".result").html("");
     $('html, body').animate({
         scrollTop: $('#detail-slider').offset().top + 500
     }, 'slow');

     /*$(".completebook").fadeOut("fast");
     $("#waiting").html("Please Wait...");*/
     var mem_type = $("#click_type").val();
     console.log(mem_type);
     if (mem_type != "cont_as_free" && mem_type != 'already_member') {
         $.post(url + "admin/ajaxcalls/hbprocessMemberignup", $("#bookingdetails, #" + formname + "form , #vip_details").serialize(), function(response) {
             var resp = $.parseJSON(response);
             console.log(resp);

             if (resp.error == "yes") {
                 $(".result").html("<div class='alert alert-danger'>" + resp.msg + "</div>");
             } else {
                 if (resp.user_id) {
                     //console.log('if');

                     $('.book_extra_hide').hide();
                     $('#vip_drop').show();
                     $('#ROOMS').append('<input type="hidden" value="' + resp.user_id + '" class="user_id_check">');
                     $("#vip_details").append('<input type="hidden" name="user_id" value="' + resp.user_id + '">');

                 } else {
                     console.log('else');
                     $('.book_extra_hide').hide();
                     $('#vip_drop').show();
                 }

             }
         });
     } else {
         console.log('booking call');
         $.post(url + "admin/ajaxcalls/hbprocessBooking" + formname, $("#bookingdetails, #guest_details  ,#vip_details  , #" + formname + "form").serialize(), function(response) {
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

     }
     //console.log(mem_check);
     console.log(formname);

 }


 function completebook_login(url, msg) {
     var formname = $(".completebook").prop('name');
     $("#mem_pay").attr('data-name', formname);
     $(".result").html("");
     $('html, body').animate({
         scrollTop: $('#detail-slider').offset().top + 500
     }, 'slow');

     /*$(".completebook").fadeOut("fast");
     $("#waiting").html("Please Wait...");*/
     var mem_type = $("#click_type").val();
     console.log(mem_type);
     if (mem_type == "cont_as_upg_vip" || mem_type == 'already_member') {
         console.log('else');
         $('.book_extra_hide').hide();
         $('#vip_drop').show();
     } else {
         console.log('booking call');
         $.post(url + "admin/ajaxcalls/hbprocessBooking" + formname, $("#bookingdetails , #guest_details ,#vip_details , #" + formname + "form").serialize(), function(response) {
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
         scrollTop: $('#detail-slider').offset().top + 500
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
                     $.post(url + "admin/ajaxcalls/hbprocessBooking" + formname, $("#bookingdetails ,#guest_details, #vip_details, #" + formname + "form").serialize(), function(response) {
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