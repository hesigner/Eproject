<?php 
include 'Operations/Connection.php';
include 'Layout/header.php';
include 'Layout/cart.php';
?>
<?php
$query = "select * from booktype";
$queryrun = mysqli_query($con, $query);

$bookquery = "select * from books";
$runbookquery = mysqli_query($con, $bookquery);

$creditquery = "select * from credit_card";
$runcreditquery = mysqli_query($con, $creditquery);

$cashquery = "select * from cash_on_delivery";
$runcashquery = mysqli_query($con, $cashquery);

$custquery = "select * from customer";
$runcustquery =mysqli_query($con, $custquery);
$row = mysqli_fetch_assoc($runcustquery);


$weightquery = "select * from book_weight";
$runweight = mysqli_query($con, $weightquery);

$paymentquery = "select * from payment_method";
$runpaymentquery = mysqli_query($con, $paymentquery);

$delcharges = "select * from charge_on_weight";
$rundelcharges = mysqli_query($con, $delcharges);

?>
<div class="row page">

    <div class="col-12 p-2" style=" margin-top: 120px;">
        <div class="box">
            <h1 style="text-align:center; font-size: 25px;">ORDER SUMMARY</h1>
            <div class="categoryTable">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Book Id</th>
                            <th scope="col">Book Image</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $CurrentCustomer = $_SESSION['DatabaseName']; 
                            $query = "select * from cart
                            INNER JOIN books on books.Bookid = cart.Bookid
                            where Customer = '$CurrentCustomer'";
                            $res = mysqli_query($con, $query);
                                 while ($data = mysqli_fetch_assoc($res)) { 
                                 echo '<tr>';
                                 ?>
                        <td><?= $data['Bookid'] ?></td>
                        <td></td>
                        <td><?= $data['Book_Name'] ?></td>
                        <td><?= $data['Price'] ?></td>
                        <td><?= $data['Qty'] ?></td>
                        <td><a href="Operations/Cart_Crud.php?Delid=<?= $data['Cartid'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path
                                        d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                </svg></a>
                        </td>
                        <?php
                            echo '</tr>';
                                 }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-4 p-2" style=" margin-top: 10px;">
        <div class="box">
            <h1 style="text-align:center; font-size: 25px;">BOOK DETAILS</h1>
            <div class="row p-4">
                <?php
                    $CurrentCustomer = $_SESSION['DatabaseName']; 
                    $query = "select * from cart
                    INNER JOIN books on books.Bookid = cart.Bookid
                    where Customer = '$CurrentCustomer'";
                    $res = mysqli_query($con, $query);
                while ($data = mysqli_fetch_assoc($res)) {
                ?>
                <div class="col-12" style="background-color: rgba(233, 233, 233, 0.534); width: 100%; height:auto; border-radius: 5px; margin-bottom: 25px;">
                    <div class="row m-0 p-2">
                        <h1 class="" style="text-align: left; font-size: 12px; background-color: grey; width: 170px; padding-left: 20px; border-radius: 5px; height: 25px;color:white; line-height: 25px; position: absolute; margin-top: -20px;">For Book - <span><?= $data['Book_Name'] ?></span></h1>
                        <input type="hidden" value="<?= $data['Bookid'] ?>" name="bookid">
                        <select id="Booktype" name="booktype" class="form-control logininput col-12 mt-3" style="height: 35px;">
                            <option value="Select Book Type"></option>
                            <?php
                                $query = "select * from booktype";
                                $queryrun = mysqli_query($con, $query);
                                while($row = mysqli_fetch_assoc($queryrun)):?>
                            <option value="<?= $row['Typeid']?>"><?= $row['Type']?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <?php
                }?>
            </div>
        </div>
    </div>
    <div class="col-8 p-2" style=" margin-top: 10px;">
        <div class="box">
            <h1 style="text-align:center; font-size: 25px;">ORDER DETAILS</h1>
            <div class="row p-4">
                <h1 class="" style="font-size:20px;">Delivery Area</h1>
                        <input type="hidden" value="<?= $data['Bookid'] ?>" name="bookid">
                        <select id="Booktype" name="booktype" class="form-control logininput col-12 mt-3" style="height: 35px;">
                            <option value="Select Book Type"></option>
                            <?php
                                $query = "select * from booktype";
                                $queryrun = mysqli_query($con, $query);
                                while($row = mysqli_fetch_assoc($queryrun)):?>
                            <option value="<?= $row['Typeid']?>"><?= $row['Type']?></option>
                            <?php endwhile; ?>
                        </select>
            </div>
        </div>
    </div>
</div>