<?php
include 'top.php';

function getData($field){
    if(!isset($_POST[$field])) {
        $data = "";
    } else {
        $data = trim($_POST[$field]);
        $data = htmlspecialchars($data, ENT_QUOTES);
    }
    return $data;
}

$critterId = (isset($_GET['cid'])) ? (int) htmlspecialchars($_GET['cid']) : 0;

$sql  = 'SELECT pmkWildlifeId, fldCommonName ';
$sql .= 'FROM tblWildlife ';
$sql .= 'WHERE pmkWildlifeId = ? ';

$data = array($critterId);
$animalToAdopt = $thisDatabaseReader->select($sql, $data);

$critterCommonName = $animalToAdopt[0]['fldCommonName'];

$donationAmount = 50;
$adopterEmail = '';
$adopterFirstName = '';
$adopterLastName = '';
$adopterAgree = 1;
$adopterPromotional = 1;
$adopterCritterId = 15;



$saveData = true;
?>

<main>
    <h2>Adopt a 
        <?php print $critterCommonName; ?>
    </h2>
    <?php
    if(isset($_POST['btnSubmit'])){
        if(DEBUG){
            print '<p>POST array: </p><pre>';
            print_r($_POST);
            print '</pre>';
        }

        // sanitize data
        $donationAmount = (int) getData('rngDonationAmount');
        $adopterEmail = filter_var($_POST['txtAdopterEmail'], FILTER_SANITIZE_EMAIL);
        $adopterFirstName = filter_var($_POST['txtFirstName'], FILTER_SANITIZE_STRING);
        $adopterLastName = filter_var($_POST['txtLastName'], FILTER_SANITIZE_STRING);
        $adopterAgree = filter_var($_POST['chkAgreeToTerms'], FILTER_SANITIZE_NUMBER_INT);
        $adopterPromotional = filter_var($_POST['chkAgreeToPromotional'], FILTER_SANITIZE_NUMBER_INT);
        $adopterCritterId = (int) getData('hidWildlifeId');

        // Validate data
        if ($donationAmount <= 25 or $donationAmount >= 1000) {
            print '<p class="mistake">Please choose a valid donation amount.</p>';
            $saveData = false;
        }
        if (!filter_var($adopterEmail, FILTER_VALIDATE_EMAIL)) {
            print '<p class="mistake">Please enter a valid email address.</p>';
            $saveData = false;
        }
        if(!filter_var($adopterFirstName, FILTER_SANITIZE_STRING)){
            print '<p class="mistake">Please enter a valid First Name.</p>';
            $saveData = false;
        }
        if(!filter_var($adopterLastName, FILTER_SANITIZE_STRING)){
            print '<p class="mistake">Please enter a valid Last Name.</p>';
            $saveData = false;
        }
        if(!filter_var($adopterAgree, FILTER_SANITIZE_NUMBER_INT)){
            print '<p class="mistake">Please enter a valid Check value.</p>';
            $saveData = false;
        }
        if(!filter_var($adopterPromotional, FILTER_SANITIZE_NUMBER_INT)){
            print '<p class="mistake">Please enter a valid Check value.</p>';
            $saveData = false;
        }
        if($adopterCritterId != $critterId){
            print '<p class="mistake">Please dont change the id value.</p>';
            $saveData = false;
        }

        if($saveData){
            $sql  = 'INSERT INTO tblAdopterWildlife SET ';
            $sql .= 'fldDonationAmount = ?, ';
            $sql .= 'fpkWildlifeId = ?, ';
            $sql .= 'fpkAdopterEmail = ? ';

            $data = array();
            $data[] = $donationAmount;
            $data[] = $adopterCritterId;
            $data[] = $adopterEmail;

            if(DEBUG){
                print $thisDatabaseReader->displayQuery($sql, $data);
            }

            // table adopters
            $sql2  = 'INSERT INTO tblAdopter SET ';
            $sql2 .= 'pmkAdopterEmail = ?, ';
            $sql2 .= 'fldFirstName = ?, ';
            $sql2 .= 'fldLastName = ?, ';
            $sql2 .= 'fldAgreedToTerms = ?, ';
            $sql2 .= 'fldRecieveCommunication = ? ';

            $data2 = array();
            $data2[] = $adopterEmail;
            $data2[] = $adopterFirstName;
            $data2[] = $adopterLastName;
            $data2[] = $adopterAgree;
            $data2[] = $adopterPromotional;

            if (DEBUG){
                print $thisDatabaseReader->displayQuery($sql2, $data2);
            }

            $thisDatabaseWriter->insert($sql, $data);
            $thisDatabaseWriter->insert($sql2, $data2);

        }
    }
    ?>
    <form action="<?php print 'adoptCritter.php?cid=' . $critterId; ?>" id="frmAdopt" method="post">
        <fieldset class="range">
            <p>
                <label for="rngDonationAmount">Donation Amount </label>
                <input type="range" min="25" max="1000" step="25" value="<?php print $donationAmount; ?>" name="rngDonationAmount" id="rngDonationAmount">
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <label for="txtAdopterEmail">Email Address</label>
                <input type="email" id="txtAdopterEmail" name="txtAdopterEmail" value="<?php print $adopterEmail ?>" tabindex="200">
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <label for="txtFirstName">First Name</label>
                <input type="text" id="txtFirstName" name="txtFirstName" value="<?php print $adopterFirstName ?>" tabindex="300">
            </p>
        </fieldset>

        <fieldset class="textbox">
            <p>
                <label for="txtLastName">Last Name</label>
                <input type="text" id="txtLastName" name="txtLastName" value="<?php print $adopterLastName ?>" tabindex="400">
            </p>
        </fieldset>

        <fieldset class="checkbox">
            <p>
                <input type="checkbox" id="chkAgreeToTerms" name="chkAgreeToTerms" value="<?php print $adopterAgree ?>" tabindex="500" checked>
                <label for="chkAgreeToTerms">I agree to the terms and conditions. </label>
            </p>
        </fieldset>

        <fieldset class="checkbox">
            <p>
                <input type="checkbox" id="chkAgreeToPromotional" name="chkAgreeToPromotional" value="<?php print $adopterPromotional ?>" tabindex="600" checked>
                <label for="chkAgreeToPromotional">Would you like to recieve promotional materials? </label>
            </p>
        </fieldset>

        <input type="hidden" id ="hidWildlifeId" name="hidWildlifeId" value="<?php print $critterId ?>">

        <fieldset>
            <p><input type="submit" value="Adopt" tabindex="999" name="btnSubmit"></p>
        </fieldset>
    </form>
</main>

<?php
include 'footer.php';
?>