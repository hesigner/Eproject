<?php 
    include 'Connection.php';

    // Add Category
    if (isset($_POST['AddWinner'])) {
        $Compitition =  $_POST['winnercompititon'];
        $Winner =  $_POST['winnerCustomer'];
        $Price =  $_POST['winnerprice'];


        $CheckCategory = "select * from winners where compid = '$Compitition'";

        $query = mysqli_query($con, $CheckCategory);
        $Catrgories = mysqli_num_rows($query);

        if($Catrgories){
            echo "
            <script>
            alert('Competition Winner Already Exist');
            window.location.href = '../CompititionWinner.php';
            </script>";
        }
        else{
            $InsertQuery = "insert into winners ( compid, prizes, custid) VALUES ( '$Compitition', '$Price','$Winner')";
            $Check = mysqli_query($con, $InsertQuery);
            if($Check){
                echo "
                <script>
                alert('Data has been Inserted');
                window.location.href = '../CompititionWinner.php';
                </script>";
            }
            else{
                echo "
                <script>
                alert('Data Insertion Failed !!!');
                window.location.href = '../CompititionWinner.php''
                </script>";
            }
        }
    }

    // Update Category
    if (isset($_POST['UpdateWinner'])) {
        $Id =  $_POST['winnerid'];
        $Compitition =  $_POST['winnercompititon'];
        $Winner =  $_POST['winnerCustomer'];
        $Price =  $_POST['winnerprice'];
        $query = "update winners set compid='$Compitition', prizes='$Price', custid='$Winner where winid = '$Id'";
       
        $res = mysqli_query($con, $query) or die("Query Failed");
        if ($res) {
            echo "
            <script> alert('Data Updated');
            window.location.href='../CompititionWinner.php';
            </script>";
        }
         else {
            echo "<script> alert('Data Insertion Failed');            
            window.location.href='../CompititionWinner.php';
            </script>";
        }
    }

    // Delete Category
    $DelID = $_GET['Delid'];
    $quer = "delete from winners where winid = $DelID";
    $res = mysqli_query($con, $quer);
    echo $res;
    if ($res) {
    echo "
    <script>
    alert('Data Deleted!!');
    window.location.href = '../CompititionWinner.php';
    </script>";
    }
    mysqli_close($con);
?>