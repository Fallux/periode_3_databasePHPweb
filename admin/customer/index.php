<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('customer-menu.php');
?>

<h1>Customers overzicht</h1>

<?php
        $liqry = $con->prepare("SELECT customer_id,gender,first_name,middle_name,last_name,street,house_number,house_number_addon,zip_code,city,phone,emailadres,password,newsletter_subscription,date_added FROM customer");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_result($customer_id,$gender, $first_name,$middle_name,$last_name,$street,$house_number,$house_number_addon,$zip_code,$city,$phone,$emailadres,$password,$newsletter_subscription,$date_added);
            if($liqry->execute()){
                $liqry->store_result();
                // while($liqry->fetch()) {
                //     echo 'admin id :' . $adminId . " - ";
                //     echo 'email :' . $email . " - ";
                //     echo '<a href="edit_user.php?uid='.$adminId.'">edit</a><br>';
                // }

                // table>tr*1>td*4
                echo '<table border=1>
                        <tr>
                            <td>customer_id</td>
                            <td>gender</td>
                            <td>first_name</td>
                            <td>middle_name</td>
                            <td>last_name</td>
                            <td>street</td>
                            <td>house_number</td>
                            <td>house_number_addon</td>
                            <td>zip_code</td>
                            <td>city</td>
                            <td>phone</td>
                            <td>emailadres</td>
                            <td>password</td>
                            <td>newsletter_subscription</td>
                            <td>date_added</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>';
                while ($liqry->fetch() ) { ?>
                        <tr>
                        <td><?php echo $customer_id; ?></td>
                        <td><?php echo $gender; ?></td>
                        <td><?php echo $first_name; ?></td>
                        <td><?php echo $middle_name; ?></td>
                        <td><?php echo $last_name; ?></td>
                        <td><?php echo $street; ?></td>
                        <td><?php echo $house_number; ?></td>
                        <td><?php echo $house_number_addon; ?></td>
                        <td><?php echo $zip_code; ?></td>
                        <td><?php echo $city; ?></td>
                        <td><?php echo $phone; ?></td>
                        <td><?php echo $emailadres; ?></td>
                        <td><?php echo $password; ?></td>
                        <td><?php echo $newsletter_subscription; ?></td>
                        <td><?php echo $date_added; ?></td>
                        <td><a href="edit_customer.php?customer_id=<?php echo $customer_id; ?>">edit</a></td>
                        <td><a href="delete_customer.php?customer_id=<?php echo $customer_id; ?>">delete</a></td>
                    </tr>
                    <?php 
                }
                echo '</table>';
            }

            $liqry->close();
        }

?>

<?php
    include('../core/footer.php');
?>
