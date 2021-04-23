<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('customer-menu.php');
?>

<h1>customer toevoegen</h1>

<?php
    if (isset($_POST['gender']) && $_POST['gender'] != "") {
        $gender           = $con->real_escape_string($_POST['gender']);
        $first_name    = $con->real_escape_string($_POST['first_name']);
        $middle_name    = $con->real_escape_string($_POST['middle_nam']);
        $last_name          = $con->real_escape_string($_POST['last_name']);
        $street          = $con->real_escape_string($_POST['street']);
        $house_number         = $con->real_escape_string($_POST['house_number']);
        $house_number_addon         = $con->real_escape_string($_POST['house_number_addon']);
        $zip_code         = $con->real_escape_string($_POST['zip_code']);
        $city         = $con->real_escape_string($_POST['city']);
        $phone         = $con->real_escape_string($_POST['phone']);
        $emailadress         = $con->real_escape_string($_POST['emailadress']);
        $password         = $con->real_escape_string($_POST['password']);
        $newsletter_subscription         = $con->real_escape_string($_POST['newsletter_subscription']);

        $liqry = $con->prepare("INSERT INTO customer (gender,firts_name,middle_name,last_name,street,house_number,house_number_addon,zip_code,city,phone,emailadres,password,newsletter_subscription) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('ssssssisssisss', $gender, $first_name,$middle_name,$last_name,$street,$house_number,$house_number_addon,$zip_code,$city,$phone,$emailadress,$password,$newsletter_subscription);
            if($liqry->execute()){
                echo "gender "        . $gender . " toegevoegd.";
                echo "first_name " . $first_name . " toegevoegd.";
                echo "middle_name " . $middle_name . " toegevoegd.";
                echo "last_name " . $last_name . " toegevoegd.";
                echo "street " . $street . " toegevoegd.";
                echo "housenumber "       . $housenumber . " toegevoegd.";
                echo "house_number_addon "       . $house_number_addon . " toegevoegd.";
                echo "city "       . $city . " toegevoegd.";
                echo "phone "       . $phone . " toegevoegd.";
                echo "emailadress "       . $emailadress . " toegevoegd.";
                echo "password "      . $password . " toegevoegd.";
                echo "newsletter_subscription "      . $newsletter_subscription . " toegevoegd.";
            }
        }
        $liqry->close();

    }
?>

<form action="" method="POST">
customer_id: <input type="text" name="customer_id" value=""><br><br>
first_name: <input type="text" name="name" value=""><br><br>
middle_name: <input type="text" name="name" value=""><br><br>
last_name: <input type="text" name="name" value=""><br><br>
street: <input type="text" name="street" value=""><br><br>
house_number: <input type="text" name="house_number" value=""><br><br>
house_number_addon: <input type="text" name="house_number_addon" value=""><br><br>
zip_code: <input type="text" name="zip_code" value=""><br><br>
city: <input type="text" name="city" value=""><br><br>
phone: <input type="text" name="phone" value=""><br><br>
emailadress: <input type="text" name="emailadress" value=""><br><br>
password: <input type="text" name="password" value=""><br><br>
newsletter_subscription: <input type="text" name="newsletter_subscription" value=""><br><br>
<input type="submit" name="submit" value="Toevoegen">
</form>



<?php
    include('../core/footer.php');
?>