<?php
    
    // onderstaand bestand wordt ingeladen
    include('../core/header.php');
    include('../core/checklogin_admin.php');
    include('category-menu.php');
?>

<h1>category overzicht</h1>

<?php
        $liqry = $con->prepare("SELECT category_id,name,description,active FROM category");
        if($liqry === false) {
           echo mysqli_error($con);
        } else{
            $liqry->bind_result($category_id,$name,$description,$active);
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
                            <td>category_id</td>
                            <td>name</td>
                            <td>description</td>
                            <td>active</td>
                            <td>edit</td>
                            <td>delete</td>
                        </tr>';
                while ($liqry->fetch() ) { ?>
                        <tr>
                        <td><?php echo $category_id; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $description; ?></td>
                        <td><?php echo $active; ?></td>
                        <td><a href="edit_category.php?category_id=<?php echo $category_id; ?>">edit</a></td>
                        <td><a href="delete_category.php?category_id=<?php echo $category_id; ?>">delete</a></td>
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
