<?php
include 'top.php';

$critterId = (isset($_GET['cid'])) ? (int) htmlspecialchars($_GET['cid']) : 0;

$sql  = 'SELECT pmkWildlifeId, fldType, fldCommonName, fldDescription, fldHabitat, ';
$sql .= 'fldReproduction, fldDiet, fldManagement, fldStatus, fldMainImage ';
$sql .= 'FROM tblWildlife ';
$sql .= 'WHERE pmkWildlifeId = ? ';
$sql .= 'ORDER BY fldCommonName';

$data = array($critterId);
$animals = $thisDatabaseReader->select($sql, $data);

?>

<main>
    <?php
    if(is_array($animals)){
        foreach($animals as $animal){
            print '<h2> ' . $animal['fldCommonName'] . '</h2>';
            // add button to connect this to the appropriate form
            print '<a class="button fixed" href="adoptCritter.php?cid=' . $animal['pmkWildlifeId'] . '">Adopt a ' . $animal['fldCommonName'] . '</a>';
            print '<figure class="animal">';
            print '<img alt="' . $animal['fldCommonName'] . '" src="images/' . $animal['fldMainImage'] . '">';
            print '<figcaption>' . $animal['fldCommonName'] . '</figcaption>';
            print '</figure>';
            print '<h3> Description </h3>';
            print $animal['fldDescription'];
            print '<h3> Habitat </h3>';
            print $animal['fldHabitat'];
            print '<h3> Reproduction </h3>';
            print $animal['fldReproduction'];
            print '<h3> Diet </h3>';
            print $animal['fldDiet'];
            print '<h3> Management </h3>';
            print $animal['fldManagement'];
            print '<h3> Status </h3>';
            print $animal['fldStatus'];

        }
    }

    ?>
</main>

<?php 
    include 'footer.php';
?>