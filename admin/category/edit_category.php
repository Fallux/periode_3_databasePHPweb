<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
?>

<h1>category bewerken</h1>

<?php
//prettyDump($_POST);
if (isset($_POST['submit']) && $_POST['submit'] != '') {
    $category_id     = $con->real_escape_string($_POST['category_id']);
    $name           = $con->real_escape_string($_POST['name']);
    $description    = $con->real_escape_string($_POST['description']);
    $active         = $con->real_escape_string($_POST['active']);
        $query1 = $con->prepare("UPDATE category SET name = ?, description =?, active = ? WHERE category_id = ? LIMIT 1;");
        if ($query1 === false) {
            echo mysqli_error($con);
        }
                    
        $query1->bind_param('ssii', $name, $description,$active, $category_id);
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
    if (isset($_GET['category_id']) && $_GET['category_id'] != '') {
        $category_id = $con->real_escape_string($_GET['category_id']);

        $liqry = $con->prepare("SELECT category_id,name,description,category_id,price,color,weight,active FROM category WHERE category_id = ? LIMIT 1;");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_param('i',$category_id);
            $liqry->bind_result($category_id,$name,$description,$active);
            if($liqry->execute()){
                $liqry->store_result();
                $liqry->fetch();
                if($liqry->num_rows == '1'){
                    echo 'category_id: ' . $category_id . '<br>';
                    echo '<input type="hidden" name="category_id" value="' . $category_id . '" />';

                    echo 'name:';
                    echo '<input type="text" name="name" value="' . $name . '" /><br>';

                    echo 'description: ';
                    echo '<input type="text" name="description" value="' . $description . '" /><br>';

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