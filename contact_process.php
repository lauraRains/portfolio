<?php

$EmailFrom = trim(stripslashes($_POST['email'])); 
$EmailTo = "rainslaura1965@gmail.com";
$Subject = 'Contact';
$Comments = trim(stripslashes($_POST['comments']));
$Name = trim(stripslashes($_POST['name'])); 
$current_date = date("Y-m-d"); 

$validationOK=true;
if ($EmailFrom=="") $validationOK=false;
if ($Name=="") $validationOK=false;
if (!$validationOK) {
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
  exit;
}

$myFilePath = "contacts/";
$myFileName = "form-data.csv";
$myPointer = fopen ($myFilePath.$myFileName, "a+");
$form_data = $current_date . "," . $EmailFrom . "," . $Subject . "," . $Name . "," . $Comments . "\n";
fputs ($myPointer, $form_data);
fclose ($myPointer);

$Body = "";
$Body .= "name: ";
$Body .= $Name;
$Body .= "\n";
$Body .= "email: ";
$Body .= $EmailFrom;
$Body .= "\n";
$Body .= "comments: ";
$Body .= $Comments;
$Body .= "\n";

$success = mail($EmailTo, $Subject, $Body, "From: <$EmailFrom>");

if ($success){
  print "<meta http-equiv=\"refresh\" content=\"0;URL=ok.html\">";
    
}
else{
  print "<meta http-equiv=\"refresh\" content=\"0;URL=error.html\">";
}


?>

