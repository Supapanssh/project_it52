<?php  
include_once("../connectDB/connectDB.php");  
  
$email=$_POST['email'];  
  
$rs=mysql_query("select email from login where email='$email' ");  
$row=mysql_fetch_array($rs);  
$count=mysql_num_rows($rs);  
  
if(!emptyempty($count)) {  
  
$newpass=rand(10000000,99999999);  // ทำการสุ่มสร้างรหัสใหม่   
$newpass_md5=md5($newpass);  // แปลงเป็น md5 เพื่อบันทึกลงเบส

mysqli_query("update login set password='$newpass_md5' where email='$email' ");  // บันทึกรหัสใหม่ลงฐานข้อมูล  
  
// ส่งรหัสใหม่ให้สมาชิกทางเมล  
  
$emailadmin="test@yourdomain";  // เมลคนส่ง    
$sendto=$memberemail;    
            
        $mailheaders = "From: ".$emailadmin."\n";    
        $mailheaders .= "Content-type: text/html;charset=UTF-8\n";    
        $mailheaders .= "X-Priority: 1\n";    
        $mailheaders .= "Importance: High\n";    
        $mailheaders .= "X-MSMail-Priority: High\n";    
        $mailheaders .= "X-Mailer: Mailler With PHP!\n";    
    
        $mailsubject = "รหัสผ่านใหม่";    
            
        $body = "<html>    
        <body>";    
        $body .= "รหัสผ่านใหม่ของคุณคือ ".$newpass;    
        $body .= "</body>";    
        $body .= "</html>";               
        mail($sendto, $mailsubject, $body, $mailheaders);    
  
} else {  
   echo "เมลไม่ถูก";  
  
}
