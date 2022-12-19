<?php 
    include 'Connection.php';

    // Add Category
    if (isset($_POST['addCategoryName'])) {
        $Name = $_POST['CategoryName'];

        $CheckCategory = "select * from category where category_name = '$Name'";

        $query = mysqli_query($con, $CheckCategory);
        $Catrgories = mysqli_num_rows($query);

        if($Catrgories){
            echo "  
            <script>
            alert('Category Already Exist');
            window.location.href = '../Category.php';
            </script>";
        }
        else{
            $InsertQuery = "insert into category (category_name) values ('$Name')";
            $Check = mysqli_query($con, $InsertQuery);
            if($Check){
                echo "
                <script>
                alert('Data has been Inserted');
                window.location.href = '../Category.php';
                </script>";
            }
            else{
                echo "
                <script>
                alert('Data Insertion Failed !!!');
                window.location.href = '../Category.php';
                </script>";
            }
        }
    }

    // Update Category
    if (isset($_POST['updateCategoryName'])) {
        $Id = $_POST['CategoryId'];
        $Name = $_POST['CategoryName'];

        $query = "update category set category_name = '$Name' where catid = '$Id'";
    
        $res = mysqli_query($con, $query) or die("Query Failed");
        if ($res) {
            echo "
            <script> alert('Data Inserted');
            window.location.href='../Category.php';
            </script>";
        }
         else {
            echo "<script> alert('Data Insertion Failed');            
            window.location.href='../Category.php';
            </script>";
        }
    }

    // Delete Category
    $DelID = $_GET['Delid'];
    $quer = "delete from category where Catid = $DelID";
    $res = mysqli_query($con, $quer);
    echo $res;
    if ($res) {
    echo "
    <script>
    alert('Data Deleted!!');
    window.location.href = '../Category.php';
    </script>";
    }
    mysqli_close($con);
?>