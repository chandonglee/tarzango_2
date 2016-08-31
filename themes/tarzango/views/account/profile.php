<style type="text/css">
 
    .updateprofile {
       background-color: #1cc0fb;
    border: 1px solid #1cc0fb !important;
    color: #fff !important;
    width: 100%;
    margin: 25px 0px 0px 0px;
    padding: 20px;
    font-family: 'Apercu-Regular';
    letter-spacing: 1px;
        font-size: 14px;
}
</style>
<div class="toppage"></div>

            
               <div class="clearfix"></div>
<div class="accountresult"></div>
   <form action="" id="profilefrm" method="POST" onsubmit="return false;">
                           <div class="col-sm-12">
                              <label>Subscribe to Newsletter</label>
                              <a class="subscribed" href="#">Subscribed<i class="fa fa-check" aria-hidden="true"></i></a>
                              <a class="unsubscribed" href="#">Unsubscribe<i class="fa fa-times" aria-hidden="true"></i></a>
                           </div>
                           <div class="col-sm-12">
                              <p>PERSONAL INFORMATION</p>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="fname">First Name</label>
                                 <input  class="form-control form" type="text" placeholder="<?php echo trans('090');?>" name="firstname"  value="<?php echo $profile[0]->ai_first_name; ?>" readonly>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="lname">Last Name</label>
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('091');?>" name="lastname"  value="<?php echo $profile[0]->ai_last_name; ?>"  readonly>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="number">Phone Number</label>
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('092');?>" name="phone"  value="<?php echo $profile[0]->ai_mobile; ?>">
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <p>WHERE SHOULD WE SEND YOUR CONFIRMATION</p>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="email">E-mail</label>
                                  <input class="form-control form" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="<?php echo $profile[0]->accounts_email; ?>">
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <p>SECURITY INFORMATION</p>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="password">password</label>
                                 <input class="form-control form" type="password" placeholder="<?php echo trans('095');?>" name="password"  value="">
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="confirm_password">Confirm password</label>
                                <input class="form-control form" type="password" placeholder="<?php echo trans('096');?>" name="confirmpassword"  value="">
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <p>PERSONAL INFORMATION</p>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="address">Address</label>
                                <input class="form-control form" type="text" placeholder="<?php echo trans('098');?>" name="address1"  value="<?php echo $profile[0]->ai_address_1; ?>">
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="address2">Address 2</label>
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('099');?>" name="address2"  value="<?php echo $profile[0]->ai_address_2; ?>">
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="city">City</label>
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('0100');?>" name="city"  value="<?php echo $profile[0]->ai_city; ?>">
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                <label for="sel1">State / Region</label>
                                  <input class="form-control form" type="text" placeholder="<?php echo trans('0101');?>/<?php echo trans('0102');?>" name="state"  value="<?php echo $profile[0]->ai_state; ?>">
                                </select>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                 <label for="zip_code">Postal / Zip Code</label>
                                  <input class="form-control form" type="text" placeholder="<?php echo trans('0103');?>/<?php echo trans('0104');?>" name="zip"  value="<?php echo $profile[0]->ai_postal_code; ?>">
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="form-group">
                                <label for="sel1">Country</label>
                                <select  class="form-control form" name="country">
                                    <option value=""><?php echo trans('0484');?></option>
                                    <?php
                                       foreach($allcountries as $country){
                                       ?>
                                    <option value="<?php echo $country->iso2;?>" <?php if($profile[0]->ai_country == $country->iso2){echo "selected";}?> ><?php echo $country->short_name;?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                           </div>
                           <div class="col-sm-12">
                              <div class="col-sm-4">
                              </div>
                              <div class="col-sm-4 form-group">
                              <input type="hidden" name="oldemail" value="<?php echo $profile[0]->accounts_email;?>" />
                              <button class="btn btn-action btn-block updateprofile"> Update profile </button>
                                 
                              </div>
                              <div class="col-sm-4">
                              </div>
                           </div>
                        </form>



 
