<?php 
include('../config/dbconfig.php');
$dbcon = new dbconfig();



// getting Post values
$cmcode ="";
$cname=$_POST['comp_name'];
$csubject=$_POST['comp_subject'];
$cemail=$_POST['comp_email'];
$bname=$_POST['comp_bankname'];
$branch = $_POST ['comp_branch'];
$baddress=$_POST['comp_baddress'];
$cphone = $_POST['comp_number'];


date_default_timezone_set("Asia/Calcutta"); 
$cdate = date("Y-m-d");
// $cdate = date("d-m-Y");
// $cdate=date("Y-m-d H:i:s");
$ctdate=date('d-m-Y H:i:s', time());
// $cdate = substr($ctdate,0,10);
//  $comdate = mysql_real_escape_string(date('Y-m-d H:i:s', $cdate));
$cstatus = 'Open';
$cmsg = trim($_POST['comp_msg']);
// $isread=0;
// Insert quaery

// $sql="INSERT INTO complaints(comp_subject,comp_name,comp_email,comp_bname,comp_baddress,comp_number,comp_whatsup,comp_date,comp_status,comp_comments)
// VALUES('complaint', 'Siva','sivakumar.pmani@gmail.com','chrompet','test',000000,00000,'01-01-2022','open','test')";
// $result=mysqli_query($con,$sql);

// echo substr($csubject,0,3);
$sql="INSERT INTO  complaint_register(comp_code,comp_name,comp_subject,comp_email,comp_bankname,comp_branch,comp_baddress,comp_number,comp_date,comp_datetime,comp_status,comp_msg) 
VALUES('$cmcode ','$cname','$csubject','$cemail','$bname','$branch ','$baddress','$cphone','$cdate','$ctdate','$cstatus','$cmsg')";
$result=mysqli_query($dbcon->connection,$sql);

$last_id = $dbcon->connection->insert_id;
// $ccode = strtoupper(substr($csubject,0,3).$last_id);
$ccode = "CFB".$last_id;

$sql1 = "UPDATE complaint_register set comp_code = '".$ccode."' WHERE  comp_id=".$last_id;
$result=mysqli_query($dbcon->connection,$sql1);


$tomail =trim($_POST['comp_email']);
// $name=ucfirst(trim($_POST['comp_name']));

 
// $to = 'sivakumar.pmani@gmail.com';
$subject = 'Your complaint Number: '. $ccode ."  "."on  "."  " ."  " .$ctdate ;
$from = 'noreply@timecablevision.com';
$bcc = 'timecablevision@gmail.com';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Create email headers
$headers .= 'From: '.$from."\r\n".
   'Bcc: '.$bcc."\r\n" .
   'X-Mailer: PHP/' . phpversion();

// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#535555" style="margin: 30px 0;">
<tr>
   <td align="center" valign="top" >
       <table width="600" border="0" cellspacing="0" cellpadding="0" bgColor="white" style="border:1px solid #ccc" class="mobile-shell">
           <tr>
               <td  align="center"
                   style="font-size:0pt; line-height:0pt; text-align:center; background: #f4f3f3; padding: 10px 0; ">
                   Greetings from SNEHA ENTERPRISES
               </td>
           </tr>
           
           <tr>
               <td 
                   style="font-size:14px; padding:20px 30px 5px 30px; line-height:20px; text-align:left; color: #1e1f1f;">
                   Dear ' . $cname ;
$message .= ',</td>
           </tr>
      
           
           <tr>
               <td 
                   style="font-size:14px; padding:20px 30px 5px 30px; line-height:20px; text-align:left; color: #1e1f1f;">
                   Subject : Your complaint number - '. $ccode ." "." Reported on: " .$ctdate ;
$message .= ', </td>
           </tr>
           <tr>
               <td 
                   style="font-size:14px; padding:20px 30px 5px 30px; line-height:20px; text-align:left; color: #1e1f1f;">
                  Thank you for contact us, our techincal team will contact you soon !
               </td>
           </tr>
         
           <tr>
               <td 
                   style="font-size:14px; padding:20px 30px 15px 30px; line-height:20px; text-align:left; color: #1e1f1f;">
                   Best regards,<br/>
                   for Sneha Enterprises
               </td>
           </tr>

        
           <tr>
               <td  align="center"
                   style="font-size:10pt; line-height:20pt; text-align:center; background:#ccc; padding:10px ">
                 <a href="">www.snehaenterprises.com</a>
               </td>
           </tr>
       </table>
       
   </td>
</tr>
</table>';
$message .= '</body></html>';

// Sending email
if(mail($tomail, $subject, $message, $headers)){
   echo   "<script type=\"text/javascript\">".
   "window.alert('You are feedback successfully send, we will get back to you.');  
    window.location='./view/complaint-register.php';".
   "</script>";
    exit;  
} else{
   echo 'Unable to send email. Please try again.';
}
mysqli_close($dbcon->connection);
?>