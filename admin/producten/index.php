<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('products-menu.php');
?>

<h1>Productsoverzicht</h1>

<?php
        $liqry = $con->prepare("SELECT product_id,name,description,category_id,price,color,weight,active FROM product");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_result($product_id,$name,$description,$category_id,$price,$color,$weight,$active);
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
                            <td>product_id</td>
                            <td>name</td>
                            <td>description</td>
                            <td>category_id</td>
                            <td>price</td>
                            <td>color</td>
                            <td>weight</td>
                            <td>active</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>';
                while ($liqry->fetch() ) { ?>
                        <tr>
                        <td><?php echo $product_id; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $category_id; ?></td>
                        <td><?php echo $price; ?></td>
                        <td><?php echo $color; ?></td>
                        <td><?php echo $weight; ?></td>
                        <td><?php echo $active; ?></td>
                        <td><a href="edit_product.php?product_id=<?php echo $product_id; ?>">edit</a></td>
                        <td><a href="delete_product.php?product_id=<?php echo $product_id; ?>">delete</a></td>
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
