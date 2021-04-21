<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('products-menu.php');
?>

<h1>Product toevoegen</h1>

<?php
    if (isset($_POST['name']) && $_POST['name'] != "") {
        $name           = $con->real_escape_string($_POST['name']);
        $description    = $con->real_escape_string($_POST['description']);
        $category_id    = $con->real_escape_string($_POST['category_id']);
        $price          = $con->real_escape_string($_POST['price']);
        $color          = $con->real_escape_string($_POST['color']);
        $weight         = $con->real_escape_string($_POST['weight']);
        $active         = $con->real_escape_string($_POST['active']);

        $liqry = $con->prepare("INSERT INTO product (name,description,category_id, price,color, weight, active) VALUES (?,?,?,?,?,?,?)");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('ssiisii', $name, $description,$category_id,$price,$color,$weight,$active);
            if($liqry->execute()){
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