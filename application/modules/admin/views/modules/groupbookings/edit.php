<div class="panel panel-default">
  <div class="panel-heading"> <span class="panel-title pull-left">Edit Group Booking</span>
    <input type="hidden" id="currenturl" value="<?php echo current_url();?>" />
    <input type="hidden" id="baseurl" value="<?php echo base_url().$this->uri->segment(1);?>" />
    <div class="clearfix"></div>
  </div>
  <div class="panel-body">
    <div class="col-md-12">
      <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data" >
        <input type="hidden" name="pt_group_booking_id" id="pt_group_booking_id" value="<?php echo $bdetails->pt_group_booking_id;?>" />
        <?php //if(!empty($service)){  ?>
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Item</strong></div>
          <div class="panel-body">
            <div class="form-group">
              <label class="col-md-3 control-label">Company Name</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->company_name;?> </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Contact Name</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->contect_name;?> </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Email</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->contect_email;?> </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Check in</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->check_in;?> </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Check Out</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->check_out;?> </div>
            </div>
            <div class="form-group">
              <label class="col-md-3 control-label">Contact no</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->contect_no;?> </div>
            </div>
              
            <div class="form-group">
              <label class="col-md-3 control-label">Aprx Room</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->aprx_rooms;?> </div>
            </div>
              
            <div class="form-group">
              <label class="col-md-3 control-label">City</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->city;?> </div>
            </div>
              
            <div class="form-group">
              <label class="col-md-3 control-label">State</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->state;?> </div>
            </div>
              
            <div class="form-group">
              <label class="col-md-3 control-label">Place Type</label>
              <div class="col-md-8" style="margin-top:7px;"> <?php echo $bdetails->place_type;?> </div>
            </div>
            
            <!--Hotels-->
            <div class="form-group">
                <label class="col-md-3 control-label">Hotel Name</label>
                <div class="col-md-6">
                    <select multiple class="chosen-multi-select" name="hotel_id[]">
                        <?php
                        $sel_hotel_data = $bdetails->hotel_data;
                        $sel_hotel_data = json_decode($sel_hotel_data);

                        for($s_i=0;  $s_i < count($all_hotel); $s_i++){ ?>
                            <option value="<?php echo $all_hotel[$s_i]->hotel_id; ?>"  <?php if(in_array($all_hotel[$s_i]->hotel_id,$sel_hotel_data->hotel_id)){ echo "selected"; } ?> ><?php echo $all_hotel[$s_i]->hotel_title;?></option>
                        <!--<option value="<?php echo $all_hotel[$s_i]->hotel_id; ?>"  <?php if(in_array($all_hotel[$s_i]->hotel_id,$sel_hotel_data->hotel_id)){ echo "selected"; } ?> ><?php echo $all_hotel[$s_i]->hotel_title.' ( '. $all_hotel[$s_i]->hotel_map_city.' )';?></option>-->
                        <?php } ?>
                    </select>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-md-3 control-label">Booking Status</label>
                <div class="col-md-3">
                
                    <select class="form-control status" name="status">
                      <option value="unapproved"  <?php if($bdetails->status == "unapproved"){ echo "selected"; }?>>Not approved</option>
                      <option value="approved" <?php if($bdetails->status == "approved"){ echo "selected"; }?>>Approved</option>
                    </select>
                </div>
            </div>
            
             <div class="form-group link_data">
              <label class="col-md-3 control-label">Link</label>
              <div class="col-md-8 link" style="margin-top:7px;"> <?php echo $bdetails->link_gen; ?> </div>
            </div>
            
          </div>
                
        </div>
        
        <div class="form-group">
          <div class="col-md-2">
            <input type="hidden" name="updatebooking" value="1" />
            <input type="hidden" name="link_gen" id="link_gen" value="<?php echo $bdetails->link_gen; ?>" />
            <input type="hidden" name="link_code" id="link_code" value="<?php echo $bdetails->link_code; ?>" />
            <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url(); ?>" />
            <input type="submit" class="btn btn-primary btn-lg" value="Update">
          </div>
        </div>
        
      </form>
    </div>
   
  </div>
</div>
<script>
    $(".link_data").hide();    
    $(".status").change(function (){

        var status = $( ".status option:selected" ).val();
        var link_code = $("#link_code").val();
        var link_gen = $("#link_gen").val();
        var base_url = $("#base_url").val();
        if(status == 'approved' && link_gen == '' && link_code == ""){
            $.ajax({
                type: 'POST',
            		data:{ },
            		url: base_url+'admin/ajaxcalls/RandomString',
            		cache: false,
            		beforeSend:function(){
            		// show image here
                    $(".popupBg1").show();
                    $(".data").hide();
            		},
            		success: function(data)
            		{
                    var final_url = base_url+'ean/gbsearch?gbcode='+data;
                    $(".link_data").toggle();
            
                    $(".link").html(final_url);
                    $("#link_code").val(data);
                    $("#link_gen").val(final_url);
                    //window.location.replace(url);
            		},
            		error: function(e)
            		{
                    alert(e.message);
		            }
            });
            
        }else if(status == 'approved'){
            $(".link_data").toggle();
        }else{
            $(".link_data").toggle();
        }
    });
</script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/adminbooking.js"></script> 
