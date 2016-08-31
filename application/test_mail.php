<?php
// the message
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
$isss = mail("ravi.gajera20@gmail.com","My subject",$msg);
if($isss){
  echo "Mail Sent Successfully";
}else{
  echo "Mail Not Sent";
}
?>