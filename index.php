<?php
    include('core/header.php');
?>
Homepage

<h2>Categorie overzicht</h2>
<?php
$sql = "SELECT name, description FROM category WHERE active = 1";
$liqry = $con->prepare($sql);
if($liqry === false) {
    echo mysqli_error($con);
} else{
    // $liqry->bind_param('s',$email);
    $liqry->bind_result($categoryName, $categoryDescription);
    if($liqry->execute()){
        $liqry->store_result();
        while($liqry->fetch()){
            ?>
            <article>
                <h3><?php echo $categoryName;?></h3>
                <div><?php echo $categoryDescription;?></div>
            </article>
            <?php
        }
    }
    $liqry->close();
}
?>

<h2>Random producten overzicht</h2>
<!-- Willekeurig 3 producten nodig; product naam, product prijs en categorie titel -->
<?php
$productsql = "SELECT product.name AS productName, product.price, category.name AS categoryName FROM product INNER JOIN category ON product.category_id = category.category_id WHERE category.active = 1 AND product.active = 1 ORDER BY RAND() LIMIT 3";

$productqry = $con->prepare($productsql);
if($productqry === false) {
    echo mysqli_error($con);
} else{
    $productqry->bind_result($productName, $productPrice, $categoryNameProduct);
    if($productqry->execute()){
        $productqry->store_result();
        while($productqry->fetch()){
            ?>
            <article>
                <h3><?php echo $productName;?></h3>
                <div>
                    <?php echo $categoryNameProduct;?><br>
                    &euro; <?php echo $productPrice;?>
                </div>
            </article>
            <?php
        }
    }
    $productqry->close();
}
?>

<?php
    include('core/footer.php');
?>