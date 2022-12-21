

<?php 
    include 'Connection.php';

    // Add Category
if (isset($_POST['addweight'])) {
    $weight = $_POST['weight'];
    $Book = $_POST['bookname'];
    $BookType = $_POST['booktype'];

    $InsertQuery = "insert into book_weight (weight, bookid, Booktype) values ('$weight','$Book','$BookType')";
    $Check = mysqli_query($con, $InsertQuery);
    if ($Check) {
        echo "
                <script>
                alert('Data has been Inserted');
                window.location.href = '../Booksweightmain.php';
                </script>";
    } else {
        echo "
                <script>
                alert('Data Insertion Failed !!!');
                window.location.href = '../Booksweightmain.php';
                </script>";
    }
}



    // Delete Category
    $DelID = $_GET['Delid'];
    $quer = "delete from book_weight where weightid = $DelID";
    $res = mysqli_query($con, $quer);
    echo $res;
    if ($res) {
    echo "
    <script>
    alert('Data Deleted!!');
    window.location.href = '../Booksweightmain.php';
    </script>";
    }
    mysqli_close($con);
?>