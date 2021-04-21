<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('products-menu.php');
?>

<h1>Product toevoegen</h1>

<?php
    if (isset($_POST['product_name']) && $_POST['product_name'] != "") {
        $product_id     = $con->real_escape_string($_POST['product_name']);
        $name           = $con->real_escape_string($_POST['product_name']);
        $description    = $con->real_escape_string($_POST['product_name']);
        $category_id    = $con->real_escape_string($_POST['product_name']);
        $price          = $con->real_escape_string($_POST['product_name']);
        $color          = $con->real_escape_string($_POST['product_name']);
        $weight         = $con->real_escape_string($_POST['product_name']);
        $active         = $con->real_escape_string($_POST['product_name']);

        $liqry = $con->prepare("INSERT INTO product (product_id, name,description,category_id, price,color, weight, active) VALUES (?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('s',$product_id, $name, $description,$category_id,$price,$color,$weight,$active);
            if($liqry->execute()){
                echo "product_id "  . $product_id . " toegevoegd.";
                echo "name "        . $name . " toegevoegd.";
                echo "description " . $description . " toegevoegd.";
                echo "category_id " . $category_id . " toegevoegd.";
                echo "price "       . $price . " toegevoegd.";
                echo "color "       . $color . " toegevoegd.";
                echo "weight "      . $weight . " toegevoegd.";
                echo "active "      . $active . " toegevoegd.";
                
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