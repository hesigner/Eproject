<?php 
    include 'Connection.php';

    // Add Category
if (isset($_POST['addbooktype'])) {
    $Type = $_POST['type'];
    $Book = $_POST['bookname'];

    $InsertQuery = "insert into booktype (Type, booksName) values ('$Type','$Book')";
    $Check = mysqli_query($con, $InsertQuery);
    if ($Check) {
        echo "
                <script>
                alert('Data has been Inserted');
                window.location.href = '../Booktype.php';
                </script>";
    } else {
        echo "
                <script>
                alert('Data Insertion Failed !!!');
                window.location.href = '../Booktype.php';
                </script>";
    }
}



    // Delete Category
    $DelID = $_GET['Delid'];
    $quer = "delete from booktype where Typeid = $DelID";
    $res = mysqli_query($con, $quer);
    echo $res;
    if ($res) {
    echo "
    <script>
    alert('Data Deleted!!');
    window.location.href = '../Booktype.php';
    </script>";
    }
    mysqli_close($con);
?>