<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('category-menu.php')
?>

<h1>category verwijderen</h1>

<?php
//prettyDump($_POST);
    if (isset($_POST['submit']) && $_POST['submit'] != '') {
        $category_id     = $con->real_escape_string($_POST['category_id']);
        $name           = $con->real_escape_string($_POST['name']);
        $description    = $con->real_escape_string($_POST['description']);
        $active         = $con->real_escape_string($_POST['active']);

        $query1 = $con->prepare("DELETE FROM category WHERE category_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('i',$category_id);
        if ($query1->execute() === false) {
            echo mysqli_error($con);
        } else {
            echo '<div style="border: 2px solid red">Gebruiker met category_id '.$category_id.' verwijderd!</div>';
        }
        $query1->close();
                    
    }
?>


<?php
    // if (isset($_GET['uid']) && $_GET['uid'] != '') {
        if (isset($_GET['category_id']) && $_GET['category_id'] != '') {


        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <h2 style="color: red">weet je zeker dat je deze gebruiker wilt verwijderen?</h2><?php

        $category_id     = $con->real_escape_string($_GET['category_id']);
           $liqry = $con->prepare("SELECT category_id,name,description,active FROM category WHERE category_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$category_id);
            $liqry->bind_result($category_id,$name,$description,$active);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo '$category_id: ' . $category_id . '<br>';
                    echo '<input type="hidden" name="category_id" value="' . $category_id . '" />';

                    echo '$name: ' . $name . '<br>';
                    echo '<input type="hidden" name="name" value="' . $name . '" />';

                    echo '$description: ' . $description . '<br>';
                    echo '<input type="hidden" name="description" value="' . $description . '" />';

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