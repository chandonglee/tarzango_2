<h3 class="margin-top-0"><?php echo $headingText;?></h3>
<div class="output"></div>
<form action="" method="POST" class="hotel-form" enctype="multipart/form-data"  >
  <div class="panel panel-default">
  
    <div class="panel-body"> <br>
      <div class="tab-content form-horizontal">
        <div class="tab-pane wow fadeIn animated active in" id="GENERAL">
          <div class="clearfix"></div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Hotel ID</label>
            <div class="col-md-4">
              <input name="iHbHotelID" type="text" placeholder="HB Hotel ID" required="" class="form-control" value="<?php echo $hdata[0]->iHbHotelID;?>" />
            </div>
          </div>
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Hotel Name</label>
            <div class="col-md-4">
              <input name="sHbHotelName" type="text" placeholder="Hotel Name" required="" class="form-control" value="<?php echo $hdata[0]->sHbHotelName;?>" />
            </div>
          </div>

          <input type="hidden" name="removeID" id="removeID" value="" class="removeid" />
        <?php 
        if(!empty($hroomdata)){ 
            
            $roomID = '';

          foreach ($hroomdata as $key) {

            $roomID .= $key->iRoomID.',';
            
          ?>
          <input type="hidden" name="iRoomID" value="<?php echo $roomID;?>" />
          
          <div class="test">
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Room Name</label>
            <div class="col-md-4">
              <input name="sRoomName<?php echo $key->iRoomID;?>" type="text" placeholder="Name" required="" class="form-control" value="<?php echo $key->sRoomName;?>" />
            </div>
          </div>          
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Room Image</label>
            <div class="col-md-4">
              <input type="file" accept="image/*" name="sRoomImage<?php echo $key->iRoomID;?>">
              <input type="hidden" name="sRoomImageold<?php echo $key->iRoomID;?>" value="<?php echo $key->sRoomImage;?>" />
            </div>
              <div class="col-md-4">
              <img src="<?php echo base_url().'uploads/images/hbrooms/'.$key->sRoomImage; ?>" height="100px" width="150px">
            </div>
          </div> 
          <a href="#" class="remove_field01"  data-id="<?php echo $key->iRoomID;?>">Remove</a>
          </div>   
            
          <?php }?>
          <div class="input_fields_wrap">
          </div>  
          <?php } else{ ?>


          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Room Name</label>
            <div class="col-md-4">
              <input name="sRoomName[]" type="text" placeholder="Name" required="" class="form-control"  />
            </div>
          </div>          
          <div class="row form-group">
            <label class="col-md-2 control-label text-left">Room Image</label>
            <div class="col-md-4">
              <input type="file" required="" accept="image/*" name="sRoomImage[]">
            </div>
          </div>

          <div class="input_fields_wrap">
          </div>

<?php } ?>


          <div class="row form-group">
            <label class="col-md-2 control-label text-left">&nbsp;</label>
            <div class="col-md-4">
            <button id="add_more">Add More</button>
            </div>
          </div>
          

        </div>

        
      </div>
      
    </div>
  </div>
  <div class="panel-footer">
    
    <input type="hidden" name="submittype" value="<?php echo $submittype;?>" />
    <input type="hidden" name="iHotelID" value="<?php echo $iHotelID;?>" />
    <button type="submmit" class="btn btn-primary submitfrm" id="<?php echo $submittype; ?>">Submit</button>
  </div>
  </div>
</form>

<script type="text/javascript">
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add_more"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><div class="row form-group"><label class="col-md-2 control-label text-left">Room Name</label><div class="col-md-4"><input name="sRoomName[]" type="text" placeholder="Name" required="" class="form-control" /></div></div><div class="row form-group"><label class="col-md-2 control-label text-left">Room Image</label><div class="col-md-4"><input type="file" required="" accept="image/*" name="sRoomImage[]"></div></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })

 var app = '';

    $(".test").on("click",".remove_field01", function(e){ //user click on remove text
     
        
        app = app + $(this).data("id") + ',';

        $( "#removeID" ).val(app);

        e.preventDefault(); $(this).parent('div').remove(); 
    })

});  
</script>
<script>
  $(document).ready(function() {
      if (window.location.hash != "") {
          $('a[href="' + window.location.hash + '"]').click()
      }
  });
</script>