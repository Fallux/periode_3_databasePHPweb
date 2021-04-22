<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('products-menu.php')
?>

<h1>Product verwijderen</h1>

<?php
//prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $product_id     = $con->real_escape_string($_POST['product_id']);
        $name           = $con->real_escape_string($_POST['name']);
        $description    = $con->real_escape_string($_POST['description']);
        $category_id    = $con->real_escape_string($_POST['category_id']);
        $price          = $con->real_escape_string($_POST['price']);
        $color          = $con->real_escape_string($_POST['color']);
        $weight         = $con->real_escape_string($_POST['weight']);
        $active         = $con->real_escape_string($_POST['active']);

        $query1 = $con->prepare("DELETE FROM product WHERE product_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('i',$product_id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Gebruiker met product_id '.$product_id.' verwijderd!</div>';
        }
        $query1->close();
                    
    }
?>


<?php
    // if (isset($_GET['uid']) && $_GET['uid'] != '') {
        if (isset($_GET['product_id']) && $_GET['product_id'] != '') {


        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <h2 style="color: red">weet je zeker dat je deze gebruiker wilt verwijderen?</h2><?php

        $product_id     = $con->real_escape_string($_GET['product_id']);
           $liqry = $con->prepare("SELECT product_id,name,description,category_id,price,color,weight,active FROM product WHERE product_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$product_id);
            $liqry->bind_result($product_id,$name,$description,$category_id,$price,$color,$weight,$active);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo '$product_id: ' . $product_id . '<br>';
                    echo '<input type="hidden" name="product_id" value="' . $product_id . '" />';

                    echo '$name: ' . $name . '<br>';
                    echo '<input type="hidden" name="name" value="' . $name . '" />';

                    echo '$description: ' . $description . '<br>';
                    echo '<input type="hidden" name="description" value="' . $description . '" />';

                    echo '$category_id: ' . $category_id . '<br>';
                    echo '<input type="hidden" name="category_id" value="' . $category_id . '" />';

                    echo '$price: ' . $price . '<br>';
                    echo '<input type="hidden" name="price" value="' . $price . '" />';

                    echo '$color: ' . $color . '<br>';
                    echo '<input type="hidden" name="color" value="' . $color . '" />';

                    echo '$weight: ' . $weight . '<br>';
                    echo '<input type="hidden" name="weight" value="' . $weight . '" />';

                    echo '$active: ' . $active . '<br>';
                    echo '<input type="hidden" name="active" value="' . $active . '" />';

                }
            }
        }
        $liqry->close();

        ?>
        <br>
        <input type="submit" name="submit" value="Ja, verwijderen!">
        </form>
        <?php

    }
?>

<?php
    include('../core/footer.php');
?>