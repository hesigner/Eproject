<?php include 'Connection.php'; ?>
<?php session_start(); ?>

<!-- Login -->
<?php if (isset($_POST['LoginButton'])) {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    $CheckEmail = "select * from customer where Email =  '$Email'";

    $query = mysqli_query($con, $CheckEmail);
    $EmailFound = mysqli_num_rows($query);

    if ($EmailFound) {
        $res = mysqli_fetch_assoc($query);
        $DatabasePassword = $res['Password'];
        $DatabaseEmail = $res['Email'];
        $Role = $res['Role'];

        if($DatabasePassword == $Password){
            $_SESSION['DatabaseName'] = $res['Name'];
            $_SESSION['DatabaseRole'] = $res['Role'];
            if($Role == "Admin"){
                echo "<script>alert('Login Successfully');window.location.href = '../Admin Panel/index.php'</script>";
            }
            if($Role == "Customer"){
                echo "<script>alert('Login Successfully');window.location.href = '../index.php'</script>";
            }
            if($Role == "Member"){
                echo "<script>alert('Login Successfully');window.location.href = '../index.php'</script>";
            }
        }
        else{
            echo "<script>alert('Password is Incorrect'); window.location.href = '../index.php'</script>";
        }
    }
    else{
        echo "<script>alert('Email is Incorrect'); window.location.href = '../index.php'</script>";
    }
} 
?>

<!-- Register -->
<?php if (isset($_POST['RegisterButton'])) {
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Contact = $_POST['Contact'];
    $Address = $_POST['Address'];

    $EncreptedPassword = password_hash($Password, PASSWORD_BCRYPT);

    $CheckEmail = "select * from customer where Email = '$Email'";

    $query = mysqli_query($con, $CheckEmail);
    $EmailFound = mysqli_num_rows($query);

    if($EmailFound){
        echo "<script>alert('Email Already Exist')</script>";
    }
    else{
        $Date = date("d/m/Y");
        $Role = "Customer";
        $InsertQuery = "insert into customer (Name, Email, Password, Contact, Address, Role, dateofregistration) values ('$Name','$Email','$Password','$Contact','$Address', '$Role', '$Date')";
        $Check = mysqli_query($con, $InsertQuery);
        if($Check){
            echo "<script>alert('Data has been Inserted');window.location.href = '../index.php'</script>";
        }
        else{
            echo "<script>alert('Data Insertion Failed !!!');window.location.href = '../index.php'</script>";
        }
    }

} ?>


<?php if (isset($_POST['Logout'])) {
    session_destroy();
    echo "<script>window.location.href = '../index.php';</script>";
}
?>