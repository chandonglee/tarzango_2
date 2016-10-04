<style>
  .item { max-height: 55px !important; }
  .parallax-window { min-height: 220px; position: relative; }

   footer{
        float: left;  
    width: 100%;
    
    min-height: 480px;
    height: auto;
  }
  footer .row .col-sm-12{
    padding-top: 50px;
  }
  
 .data-img{
    background: rgba(248,80,50,0); */
    background: -moz-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(248,80,50,0)), color-stop(100%, rgba(12,19,79,1)));
    /* background: -webkit-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%); */
    background: -o-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    background: -ms-linear-gradient(top, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    background: linear-gradient(to bottom, rgba(248,80,50,0) 0%, rgba(12,19,79,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f85032', endColorstr='#0c134f', GradientType=0 );
 
}
 
 .comment{
     float: left;
    text-align: left;
    margin: 10px 0px 0px 15px !important;
    color: #373b71 !important;
 }
  
 
</style>

<div class="blog_post">
       <?php include $themeurl.'views/new_header.php';?>
  <div class="container-main main_header" style="padding-top:110px">
    <div class="container">
      <div class="row">
       
            <center style="margin-left: 88px; z-index: 999;
    margin-top: 20px;"></center>
          
         
     
        <div class="col-sm-12 page-title">
          <h2 class="">Blog</h2>
          <a  href="<?php echo base_url(); ?>" ><img style="position:relative;z-index:999;" src="images/arrow-blue.png"></a>
        </div>
      </div>
    </div>
    </div>
  </div>
  <div class="blog_post_body">
  <img class="top-bg" src="images/paynow_top.png">
  <img class="left-bg" src="images/membership-left-bg.png">
  <img class="right-bg" src="images/membership-right-bg.png">
  
    <div class="container">
      <div class="col-sm-12 text-center">
        <div class="col-sm-1">
        </div>
        <div class="col-sm-10">
          <div class="section1">
            <div class="box data-img">
              <img class="img-responsive " style="position:relative; z-index:-1; display:block; width:100%;" src="<?php echo str_replace("demo.","",$thumbnail);?>">
              <div class="inner">
                <a href="<?php echo base_url().'blog'; ?>">&#8592; All Posts</a>
                <p>Posted On <?php echo $date;?></p>
                <h2><?php echo $title;?></h2>
              </div>
            </div>
            <div class="content">
              
              <p><?php echo $desc; ?></p>         
              <h5>Posted By <a href="#">Tarzango</a></h5>
              <h5 class="right">Tagged <a href="#">News</a>, <a href="#">Hotel</a>, <a href="#">Travel</a></h5>
            </div>
            <div class="social">
              <p>SHARE THIS POST</p>
              <a id="ref_tw" href="http://twitter.com/home?status=<?php echo base_url(uri_string());?> "  onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><img src="images/twitter_dark.png"></a>

              <a id="ref_fb"  href="http://www.facebook.com/sharer.php?s=100&amp;p[title]=<?php echo $title;?>&amp;p[summary]=<?php echo $title;?>&amp;p[url]=<?php echo urlencode(base_url(uri_string()));?>&amp;
p[images][0]=<?php echo $thumbnail;?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600'); return false;"><img src="images/fb_dark.png" alt=""/></a>
             <!--  <a href="javascript:fbShare('http://jsfiddle.net/stichoza/EYxTJ/', 'Fb Share', 'Facebook share popup', 'http://goo.gl/dS52U', 520, 350)"><img src="images/fb_dark.png"></a> -->

            <!--   <a href=""><img src="images/insta_dark.png"></a> -->

              <a id="ref_pr" href="http://pinterest.com/pin/create/bookmarklet/?media=<?php echo $thumbnail;?>&amp;
url=<?php echo urlencode(base_url(uri_string()));?>&amp;
is_video=false&amp;description=<?php echo $title;?>"
onclick="javascript:window.open(this.href, '_blank', 'menubar=no,toolbar=no,resizable=no,scrollbars=no,height=400,width=600');return false;"><img src="images/print_dark.png" alt=""/></a>

             
            </div>
          </div>
          <div class="section2">
            <form id="comment-form">
              <?php  if(!empty($comment_data)){ ?>
            <h6>COMMENTS</h6>
            <ul>   
            <?php foreach ($comment_data as $var) {     ?>
                  <li style="border:none; padding: 3px 0px !important;">
                      <p class="blog-comment-text" style="text-align:left;padding-left: 120px;width: 100%; color: #373b71 ;position:absolute; ;float:left;margin: 15px 0px 25px 0px;"> <?php echo $var->comment_body; ?></p>
                     <img class="" src="images/img.png" style="height:60px;float:left "><br>
                     <p class="comment"  style=" "> <?php echo $var->ai_first_name; ?></p>
                  <li>
            <?php  } ?>  
            </ul>
            <?php } ?>
            <?php  if(!empty($customerloggedin)){ ?>
             
              
            <h5>Join The Conversation</h5>
            <ul>
             <!-- <li class="first">
                <a href="#" class="first black">0 Comments</a>
                <a href="#">Brave People</a>
                <a href="#" class="right"><img src="images/count.png"> Login <img src="images/field-arrow-down.png"></a>
              </li>
              <li>
                <a href="#" class="first"><img src="images/grey_heart.png"> Recommended</a>
                <a href="#"><img src="images/share.png"> Share</a>
                <a href="#" class="right"> Sort by Best <img src="images/field-arrow-down.png"></a>
              </li> -->
              <li class="last" style="border:none">
                <img src="images/img.png">
                <input type="text" name="comment_body" placeholder="Start the discussion" id="comment_body" >
                <input type="hidden" name="blog_id" value="<?php echo $blogid;?>">
                <input type="hidden" name="user_id" value="<?php echo $customerloggedin?>">
                <input type="hidden" name="ai_first_name" value="<?php echo $firstname; ?>">
                <button style="font-size: 14px;border: none;color: #fff;background-color: #3fcdff;border-radius: 3px;width: 170px;
    padding: 20px 0px; height: 60px;margin-left: 30px;letter-spacing: 2px;margin: 25px 0px 20px 0px;" type="button" onclick="commentFunction()">submit</button>
              </li>
            </ul>
            <?php } ?>
           <!--  <p>Be the first to comment</p> -->
            
            </form>
          </div>
        </div>
        <div class="col-sm-1">
        </div>
      </div>
    </div>
  </div>
  <div class="last-section">
    <div class="col-sm-12 text-center">
      <div class="container-main">
        <div class="container">
          <h4 class="col-sm-9 text-right">Going somewhere? Need a Hotel, let us help you!</h4>
          <a class="col-sm-3 text-center" href="#">TARZANGO</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $image= str_replace("demo.","",$thumbnail); ?>

   <script>
    function fbShare(url, title, descr, image, winWidth, winHeight) {
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);
        var title = '<?php echo $title;?>';
        var desc = 'test';
        var url = '<?php echo base_url(uri_string());?>';
        var image = '<?php echo $image; ?>';
        
        window.open('http://www.facebook.com/sharer.php?s=100&p[title]=' + title + '&p[summary]=' + desc + '&p[url]=' + url + '&p[images][0]=' + image, 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
    }

function commentFunction() {
   var comment_body = $('#comment_body').val();
  
   if (comment_body != null && comment_body != "") {
     $.post("<?php echo base_url(); ?>"+"blog/add_new_comment",$("#comment-form").serialize(), function (response){
            console.log(response);
            //var resp = $.parseJSON(response);
            $('#comment_body').val('');
           location.reload();
      });
    }
}
</script>
