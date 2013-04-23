<?php
/* This will give an error. Note the output
 * above, which is before the header() call */
header("Content-type: image/svg+xml");
?>
<?php
$barcode = new Code39();
echo $barcode->draw($text);?>
