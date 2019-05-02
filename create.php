<!DOCTYPE html>
<html>
    <head>
        <title>Add Product</title>
    
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
        <?php 
            require_once 'connection.php';
            $sql = "SELECT * FROM tab_cat";
            $result = $conn->query($sql);
        ?>
        <fieldset>
            <legend>Add Product</legend>
        
            <form action="create.php" method="post">
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <th>Product Name</th>
                        <td><input type="text" name="pname" placeholder="Product Name" /></td>
                    </tr>     
                    <tr>
                        <th>Category Name</th>
                        <td>
                            <select name="cname">
                                <option>Select Prtoduct Category</option>
                                <?PHP
                                    while($row = $result->fetch_assoc()) {?>
                                        <option value="<?php echo $row['id'];?>"><?php echo $row['cat_name']; ?></option>
                                    <?php
                                    } 
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><button type="submit">Save Changes</button></td>
                        <td><a href="index.php"><button type="button">Back</button></a></td>
                    </tr>
                </table>
            </form>
        
        </fieldset>
        <?php        
        if($_POST) {
            $pname = $_POST['pname'];
            $cname = $_POST['cname'];
        
            $sql = "INSERT INTO product (product_name, cat_id) VALUES ('$pname', '$cname')";
            if($conn->query($sql) === TRUE) {
                echo "<p>New Record Successfully Created</p>";
                echo "<a href='../create.php'><button type='button'>Back</button></a>";
                echo "<a href='../index.php'><button type='button'>Home</button></a>";
            } else {
                echo "Error " . $sql . ' ' . $conn->connect_error;
            }
        }
        ?>
    </body>
</html>