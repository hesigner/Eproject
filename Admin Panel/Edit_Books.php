<?php
session_start();
if ($_SESSION['DatabaseRole'] == 'Admin') {
} 
else {
    echo "<script>window.location.href = '../index.php'</script>";
}
include 'Layout/sidebar.php';
include 'Layout/header.php';
include 'Operations/Connection.php';

?>
<?php
$ID = $_GET['Updid'];
$query = "select * from books
INNER JOIN category on category.Catid = books.cat_id
where Bookid = $ID";
$GetData = mysqli_query($con, $query);
$catdata = mysqli_fetch_assoc($GetData); 
?>
<div class="pageMaterial" id="pageMaterial">
<form action="Operations/Books_Crud.php" method = "post" enctype="multipart/form-data">

    <div class="Box row m-0">

         <div class="col-6 photoupload">
         <img src="<?= $catdata['Image'] ?>" id="VisibleImage" alt="">
         <input type="file" class="choosefile" id="Image" name="Image">
       </div>
        <div class="classform col-lg-6 col-md-12">
            <div class="form-group">
                <label for="">NAME</label>
                <input type="txt" class="form-control"  value="<?= $catdata['Book_Name'] ?>" name="Name">
            </div>
            <div class="form-group">
                <label for="">AUTHOR NAME</label>
                <input type="txt" class="form-control" value="<?= $catdata['Author_Name'] ?>" name="AuthorName">
            </div>
            <div class="form-group">
                <label for="">EDITION</label>
                <input type="txt" class="form-control" value="<?= $catdata['Edition'] ?>" name="Edition">
            </div>
            <div class="form-group">
                <label for="">Price</label>
                <input type="txt" class="form-control" value="<?= $catdata['Price'] ?>" name="Price">
            </div>
            <div class="form-group">
                <label for="">Delivery Details</label>
                <input type="txt" class="form-control" value="<?= $catdata['Delivery_Details'] ?>" name="deliverydetails">
            </div>
            <div class="form-group">
                <label for="">Category</label>
                <select class="form-control" name="category" required>
                    <option value="<?= $catdata['cat_id'] ?>"><?= $catdata['category_name'] ?></option>
                    <?php
                    $fetchquery = "select * from category";
                    $query = mysqli_query($con, $fetchquery);
                    $output = "<option> Select Category </option>";
                    while($row = mysqli_fetch_assoc($query)){
                      
                        $output .= '<option name="'.$row['Catid'] .'" value="' .$row['Catid'] . '">'. $row['category_name'] . '</option>';
                    }
                    echo $output;
                ?>
                </select>
            </div>

            <div class="form-group">
                <label for="">Book Weight</label>
                <select class="form-control" name="bookweight" required>
                <option value="<?= $catdata['weight_in_Kg'] ?>"><?= $catdata['weight_in_Kg'] ?></option>

                    <?php 
                  $DeliveryWeight = "select * from book_weight";
                  $runquery = mysqli_query($con, $DeliveryWeight);

                  $output = "<option>Select Book weight</option>";
                  while($row = mysqli_fetch_assoc($runquery)){
                      $output .='<option value=" '. $row['weightid'] .'">'.$row['weight']. '</option>';
                  }

                  echo $output;
                  ?>
                </select>
            </div>
            <div class="row m-0 p-0">
                <div class="col-12 m-0 p-0">
                    <button type="submit" name="updatebook" class="btn submitbutton btn-primary m-1">Update BOOK</button>
                </div>
            </div>
        </div>
    </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script>
$(document).ready(function () {


$(".photoupload").click(function () {
   $("#Image").trigger('click');
})

$("#VisibleImage").click(function () {
    $("#Image").trigger('click');
})


$("#Image").change(function () {
    if (this.files && this.files[0]) {
        var fileReader = new FileReader();
        fileReader.readAsDataURL(this.files[0]);
        fileReader.onload = function (x) {

            $("#VisibleImage").attr('src', x.target.result);
        }
    }
})
})
</script>