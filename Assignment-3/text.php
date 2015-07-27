
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  
<style type="text/css">
div {		/* style rules for div are formed from selected styles */
<?php
if( isset($_POST['font_Family']) )
{
   $font_family = $_POST['font_Family'];
   print "font-family: $font_family;\n";
}

if( isset($_POST['font_Color']) )
{
   $font_Color = $_POST['font_Color'];
   if ($font_Color == "purple")
   		print "color: Purple;\n";
	 if ($font_Color == "brown")
   		print "color: Brown;\n";
		 if ($font_Color == "green")
   		print "color: green;\n";
		 if ($font_Color == "yellow")
   		print "color: yellow;\n";
}

if( isset($_POST['font_style']) ) 
{
   $font_style = $_POST['font_style'];
   if ($font_style == "b")
   		print "font-style: Bold;\n";
	if ($font_style == "i")
   		print "font-style: italic;\n";
	
}

?>
    }
</style>

</head>
<body>


<?php
		/* Print user-provided text in a div */
    print "<div>\n";
    print htmlspecialchars($_POST['Text']);
    print "\n</div>\n";
?>


</body>
</html>