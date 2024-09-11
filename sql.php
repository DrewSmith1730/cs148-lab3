<?php
include 'top.php';
?>
<main>
    <p>Create Table SQL</p>

    <pre>
    CREATE TABLE tblWildlife (
        pmkWildlifeId int(11) NOT NULL,
        fldType varchar(12) NOT NULL,
        fldCommonName varchar(20) NOT NULL,
        fldDescription varchar(900) NOT NULL,
        fldHabitat text NOT NULL,
        fldReproduction text NOT NULL,
        fldDiet text NOT NULL,
        fldManagement text NOT NULL,
        fldStatus text NOT NULL,
        fldMainImage varchar(30) NOT NULL
    )
    </pre>

    <p>Select table </p>
    <pre>
        SELECT pmkWildlifeId, fldType, fldCommonName, fldDescription, fldHabitat, fldReproduction, fldDiet, fldManagement, fldStatus, fldMainImage
        FROM tblWildlife
        ORDER BY fldCommonName
    </pre>

    
</main>
<?php include 'footer.php'; ?>
</body>
</html>