<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<h1>Product bewerken</h1>

<?php
//prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $product_id = $con->real_escape_string($_POST['product_id']);
        $name           = $con->real_escape_string($_POST['name']);
        $description    = $con->real_escape_string($_POST['description']);
        $category_id    = $con->real_escape_string($_POST['category_id']);
        $price          = $con->real_escape_string($_POST['price']);
        $color          = $con->real_escape_string($_POST['color']);
        $weight         = $con->real_escape_string($_POST['weight']);
        $active         = $con->real_escape_string($_POST['active']);
        $query1 = $con->prepare("UPDATE product SET name = ?, description =?, category_id =?, price = ?, color =?, weight = ?, active = ? WHERE product_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('ssiisiii', $name, $description,$category_id,$price,$color,$weight,$active, $product_id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">product aangepast</div>';
        }
        $query1->close();
                    
    }
?>



<form action="" method="POST">
<?php
    if (isset($_GET['product_id']) && $_GET['product_id'] != '') {
        $product_id = $con->real_escape_string($_GET['product_id']);

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
                    echo 'product_id: ' . $product_id . '<br>';
                    echo '<input type="hidden" name="product_id" value="' . $product_id . '" />';

                    echo 'name:';
                    echo '<input type="text" name="name" value="' . $name . '" /><br>';

                    echo 'description: ';
                    echo '<input type="text" name="description" value="' . $description . '" /><br>';

                    echo 'category_id: ';
                    echo '<input type="number" name="category_id" value="' . $category_id . '" /><br>';

                    echo 'price: ';
                    echo '<input type="number" name="price" value="' . $price . '" /><br>';

                    echo 'color: ';
                    echo '<input type="text" name="color" value="' . $color . '" /><br>';

                    echo 'weight: ';
                    echo '<input type="text" name="weight" value="' . $weight . '" /><br>';

                    echo 'active: ';
                    echo '<input type="number" name="active" value="' . $active . '" /><br>';
;
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