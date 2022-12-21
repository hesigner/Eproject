<?php 
    include 'Connection.php';

 if (isset($_POST['AddBook'])) {


    $Name = $_POST['Name'];
    $AuthorName = $_POST['AuthorName'];
    $Edition = $_POST['Edition'];
    $Price = $_POST['Price'];
    $Category =$_POST['category'];
    $dealer =$_POST['category'];
    $Delivery_Details = $_POST['deliverydetails'];
    

        $InsertQuery = "insert into books ( Book_Name, Author_Name, Edition, Price, cat_id, DealersDetail, Delivery_Details) values ('$Name', '$AuthorName', '$Edition', '$Price' , '$Category', '$dealer','$Delivery_Details')";
        $asd = mysqli_query($con, $InsertQuery);
        if($asd){
            echo "<script>alert('Data has been Inserted');window.location.href = '../Books.php'</script>";
        }
        else{
            echo "<script>alert('Data Insertion Failed !!!');window.location.href = 'Books.php'</script>";
        }
} 

   
    // Delete Category
    $DelID = $_GET['Delid'];
    $quer = "delete from books where Bookid = $DelID";
    $res = mysqli_query($con, $quer);
    echo $res;
    if ($res) {
    echo "
    <script>
    alert('Data Deleted!!');
    window.location.href = '../Books.php';
    </script>";
    }
    mysqli_close($con);
?>