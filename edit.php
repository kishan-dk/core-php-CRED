<?php 
 
require_once 'connection.php';
 
if(isset($_GET['id'])) {
    $id = $_GET['id'];
 
    $sql = "SELECT * FROM product WHERE id = {$id}";
    $result = $conn->query($sql);
 
    $data = $result->fetch_assoc();
 
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
 
    <style type="text/css">
        fieldset {
            margin: auto;
            margin-top: 100px;
            width: 50%;
        }
 
        table tr th {
            padding-top: 20px;
        }
    </style>
 
</head>
<body>
 
<fieldset>
    <legend>Edit Product</legend>
    <?php
        $csql = "SELECT * FROM tab_cat";
        $cresult = $conn->query($csql);
    ?>
    <form action="edit.php" method="post">
        <table cellspacing="0" cellpadding="0">
            <tr>
                <th>Product Name</th>
                <td><input type="text" name="pname" placeholder="First Name" value="<?php echo $data['product_name'] ?>" /></td>
            </tr>     
            <tr>
                <th>Category Name</th>
                <td>
                    <select name="cname">
                        <option>Select Prtoduct Category</option>
                        <?PHP
                            while($row = $cresult->fetch_assoc()) {?>
                                <option <?php if(isset($data['cat_id']) && $data['cat_id']==$row['id']){ ?>selected="true"<?php }?> value="<?php echo $row['id'];?>"><?php echo $row['cat_name']; ?></option>
                            <?php
                            } 
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <input type="hidden" name="id" value="<?php echo $data['id']?>" />
                <td><button type="submit">Save Changes</button></td>
                <td><a href="index.php"><button type="button">Back</button></a></td>
            </tr>
        </table>
    </form>
 
</fieldset>

</body>
</html>
 
<?php
}
?>
<?php 
 
 
 if($_POST) {
     $pname = $_POST['pname'];
     $cname = $_POST['cname'];
  
     $id = $_POST['id'];
     $sql = "UPDATE product SET product_name = '$pname', cat_id = '$cname' WHERE id = {$id}";
     if($conn->query($sql) === TRUE) {
         echo "<p>Succcessfully Updated</p>";
         echo "<a href='edit.php?id=".$id."'><button type='button'>Back</button></a>";
         echo "<a href='index.php'><button type='button'>Home</button></a>";
     } else {
         echo "Erorr while updating record : ". $connect->error;
     } 
 }
 ?>