<style type="text/css">
   .panel-default > .panel-heading{
      background: none;
   }
   .panel {
      border-radius: 0px;
   }
   .panel-title{
      font-weight: bold;
      font-family: "Roboto";
   }
   .form-group{
      font-family: "Roboto";
   }
   .form-control{
      border-radius: 0px;
      font-family: "Roboto";
   }
   .updateprofile{    
      background: url(<?php echo $theme_url; ?>img/btn-bg.jpg) no-repeat;
       background-size: 100%;
       text-align: center;
       color: #fff;
       border: 0;
       height: 45px;
       font-weight: 700;
    }
</style>
<br>
        <div class="toppage"></div>

            <div class="col-md-12">
               <div class="clearfix"></div>
               <div class="accountresult"></div>
               <form action="" id="profilefrm" method="POST" onsubmit="return false;">
                  <div class="form-horizontal">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3 class="panel-title go-text-right"><?php echo trans('088');?></h3>
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('090');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('090');?>" name="firstname"  value="<?php echo $profile[0]->ai_first_name; ?>" readonly>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('091');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('091');?>" name="lastname"  value="<?php echo $profile[0]->ai_last_name; ?>"  readonly>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('092');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('092');?>" name="phone"  value="<?php echo $profile[0]->ai_mobile; ?>">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3 class="panel-title go-text-right"><?php echo trans('093');?>?</h3>
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('094');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('094');?>" name="email"  value="<?php echo $profile[0]->accounts_email; ?>">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('095');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="password" placeholder="<?php echo trans('095');?>" name="password"  value="">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('096');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="password" placeholder="<?php echo trans('096');?>" name="confirmpassword"  value="">
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3 class="panel-title go-text-right"><?php echo trans('097');?></h3>
                        </div>
                        <div class="panel-body">
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('098');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('098');?>" name="address1"  value="<?php echo $profile[0]->ai_address_1; ?>">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('099');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('099');?>" name="address2"  value="<?php echo $profile[0]->ai_address_2; ?>">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('0100');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('0100');?>" name="city"  value="<?php echo $profile[0]->ai_city; ?>">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('0101');?>/<?php echo trans('0102');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('0101');?>/<?php echo trans('0102');?>" name="state"  value="<?php echo $profile[0]->ai_state; ?>">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('0103');?>/<?php echo trans('0104');?></div>
                              <div class="col-md-6 go-right">
                                 <input class="form-control form" type="text" placeholder="<?php echo trans('0103');?>/<?php echo trans('0104');?>" name="zip"  value="<?php echo $profile[0]->ai_postal_code; ?>">
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-3 go-right"><?php echo trans('0105');?></div>
                              <div class="col-md-6 go-right">
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
                        </div>
                        <div class="panel-footer col-md-3  col-md-offset-5">
                           <input type="hidden" name="oldemail" value="<?php echo $profile[0]->accounts_email;?>" />
                           <button class="btn btn-action btn-block updateprofile"> Update profile </button>
                        </div>
                     </div>
                  </div>
               </form>
                                 </div>

