<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<h1>customer bewerken</h1>

<?php
prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $customer_id = $con->real_escape_string($_POST['customer_id']);
        $gender           = $con->real_escape_string($_POST['gender']);
        $first_name           = $con->real_escape_string($_POST['first_name']);
        $middle_name           = $con->real_escape_string($_POST['middle_name']);
        $last_name           = $con->real_escape_string($_POST['last_name']);
        $street    = $con->real_escape_string($_POST['street']);
        $house_number    = $con->real_escape_string($_POST['house_number']);
        $house_number_addon          = $con->real_escape_string($_POST['house_number_addon']);
        $zip_code          = $con->real_escape_string($_POST['zip_code']);
        $city          = $con->real_escape_string($_POST['city']);
        $phone          = $con->real_escape_string($_POST['phone']);
        $emailadres         = $con->real_escape_string($_POST['emailadres']);
        $password         = $con->real_escape_string($_POST['password']);
        if(($_POST['newsletter_subscription']) && $_POST['newsletter_subscription'] !=""){
            echo("jdfbdjfkbbjk");
        }
        $newsletter_subscription         = $con->real_escape_string($_POST['newsletter_subscription']);

        $query1 = $con->prepare("UPDATE `customer` SET `customer_id`=?,`gender`=?,`first_name`=?,`middle_name`=?,`last_name`=?,`street`=?,`house_number`=?,`house_number_addon`=?,`zip_code`=?,`city`=?,`phone`=?,`emailadres`=?,`password`=?,`newsletter_subscription`=? WHERE customer_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('ssssssisssisss', $gender, $first_name,$middle_name,$last_name,$street,$house_number,$house_number_addon,$zip_code,$city,$phone,$emailadress,$password,$newsletter_subscription);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">customer aangepast</div>';
        }
        $query1->close();
                    
    }
?>



<form action="" method="POST">
<?php
    if (isset($_GET['customer_id']) && $_GET['customer_id'] != '') {
        $customer_id = $con->real_escape_string($_GET['customer_id']);

        $liqry = $con->prepare("SELECT customer_id,gender,first_name,middle_name,last_name,street,house_number,house_number_addon,zip_code,city,phone,emailadres,password,newsletter_subscription,date_added FROM customer WHERE customer_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$customer_id);
            $liqry->bind_result($customer_id,$gender, $first_name,$middle_name,$last_name,$street,$house_number,$house_number_addon,$zip_code,$city,$phone,$emailadres,$password,$newsletter_subscription,$date_added);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo '$customer_id: ' . $customer_id ;
                    echo '<input type="hidden" name="customer_id" value="' . $customer_id . '" /><br>';

                    echo '$gender: ' . $gender ;
                    echo '<input type="text" name="gender" value="' . $gender . '" /><br>';
                    echo '$first_name: ' . $first_name ;
                    echo '<input type="text" name="first_name" value="' . $first_name . '" /><br>';
                    echo '$middle_name: ' . $middle_name ;
                    echo '<input type="text" name="middle_name" value="' . $middle_name . '" /><br>';
                    echo '$last_name: ' . $last_name ;
                    echo '<input type="text" name="last_name" value="' . $last_name . '" /><br>';

                    echo '$street: ' . $street ;
                    echo '<input type="text" name="street" value="' . $street . '" /><br>';


                    echo '$house_number: ' . $house_number ;
                    echo '<input type="text" name="house_number" value="' . $house_number . '" /><br>';
                    
                    echo '$house_number_addon: ' . $house_number_addon ;
                    echo '<input type="text" name="house_number_addon" value="' . $house_number_addon . '" /><br>';

                    echo '$zip_code: ' . $zip_code ;
                    echo '<input type="text" name="zip_code" value="' . $zip_code . '" /><br>';
                    echo '$city: ' . $city ;
                    echo '<input type="text" name="city" value="' . $city . '" /><br>';
                    echo '$phone: ' . $phone ;
                    echo '<input type="text" name="phone" value="' . $phone . '" /><br>';


                    echo '$emailadres: ' . $emailadres ;
                    echo '<input type="email" name="emailadres" value="' . $emailadres . '" /><br>';

                    echo '$password: ' . $password ;
                    echo '<input type="password" name="password" value="' . $password . '" /><br>';

                    echo '$newsletter_subscription: ' . $newsletter_subscription ;
                    echo '<input type="checkbox" name="newsletter_subscription" value="1' . $newsletter_subscription . '" /><br>';

                }
            }
        }
        $liqry->close();

    }
?>
<br>
<input type="submit" name="submit" value="Opslaan">
</form>

<?php
    include('../core/footer.php');
?>