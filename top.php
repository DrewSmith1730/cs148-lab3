<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Robert Erickson">
        <meta name="description" content="A site map to all my groovy assignments for the best course at UVM.">

        <title>CS 148 Database Design for the web</title>

        <link rel="stylesheet"
            href="css/custom.css?version=<?php print time(); ?>"
            type="text/css">
        <link rel="stylesheet" media="(max-width:800px)"
            href="css/tablet.css?version=<?php print time(); ?>"
            type="text/css">
        <link rel="styleshet" media="(max-width:600px)"
            href="css/phone.css?version=<?php print time(); ?>"
            type="text/css">

    


<?php

include 'lib/constants.php';
print '<!-- make database connections -->';
require_once(LIB_PATH . '/Database.php');

$thisDatabaseReader = new Database('asmith16_reader', 'r', DATABASE_NAME);
$thisDatabaseWriter = new Database('asmith16_writer', 'w', DATABASE_NAME)
?>
    
</head>

<?php

print '<body>';
print '<!-- ***** START OF THE BODY **** -->';

print PHP_EOL;

include 'header.php';
print PHP_EOL;

include 'nav.php';
print PHP_EOL;

?>
