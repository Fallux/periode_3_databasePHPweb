<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('products-menu.php');
?>

<h1>Product toevoegen</h1>

<?php
    if (isset($_POST['product_name']) && $_POST['product_name'] != "") {
        $email = $con->real_escape_string($_POST['product_name']);

        $liqry = $con->prepare("INSERT INTO product (product_id, name,description,category_id, price,color, weight, active) VALUES (?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('s',$email);
            if($liqry->execute()){
                echo "admin user met email " . $email . " toegevoegd.";
                
            }
        }
        $liqry->close();

    }
?>

<form action="" method="POST">
product_id: <input type="text" name="product_id" value=""><br><br>
name: <input type="text" name="name" value=""><br><br>
description: <input type="text" name="description" value=""><br><br>
category_id: <input type="text" name="category_id" value=""><br><br>
price: <input type="text" name="price" value=""><br><br>
color: <input type="text" name="color" value=""><br><br>
weight: <input type="text" name="weight" value=""><br><br>
active: <input type="text" name="active" value=""><br><br>
<input type="submit" name="submit" value="Toevoegen">
</form>



<?php
    include('../core/footer.php');
?>