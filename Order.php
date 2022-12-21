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

    <div class="col-5 p-2" style=" margin-top: 120px;">
        <div class="box">
            <h1 style="text-align:center; font-size: 25px;">ORDER SUMMARY</h1>
            <?php
        $CurrentCustomer = $_SESSION['DatabaseName']; 
        $query = "select * from cart
        INNER JOIN books on books.Bookid = cart.Bookid
        where Customer = '$CurrentCustomer'";
        $res = mysqli_query($con, $query);
             while ($data = mysqli_fetch_assoc($res)) { ?>
            <div class="cartproduct">
                <div class="cartproductimage col-2">
                    <img src="Material/Books/Book2.png" alt="">
                </div>
                <div class="col-6 cartproductDetails " style="line-height: 35px;">
                    <h1><?= $data['Book_Name'] ?></h1>
                    <h2><?= $data['Price'] ?></h2>
                </div>
                <div class="productQuantity col-2">
                    <H4><?= $data['Qty'] ?></H4>
                </div>

                <div class="cartproductdelete col-2">
                    <a href="Operations/Cart_Crud.php?Delid=<?= $data['Cartid'] ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" style="padding:15px;" width="100%"
                            height="100%" class="bi bi-trash" viewBox="0 0 16 16">
                            <path
                                d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                            <path fill-rule="evenodd"
                                d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                        </svg>
                    </a>
                </div>
            </div>
            <?php
        }?>
        </div>
    </div>
    <div class="col-7 p-2" style=" margin-top: 120px;">
        <div class="box">
            <h1 style="text-align:center; font-size: 25px;">ORDER DETAILS</h1>
            <div class="row p-4">

                <label for="" class="col-3">Customer Name:</label>
                <input type="text" disabled placeholder="Customer Name" class="form-control logininput col-9 mb-2"
                    value="<?php echo @$_SESSION['CustName']; ?>" name="<?php echo @$_SESSION['Cust_id'];?>">

                <label for="city" class="col-3">Select Book Name:</label>
                <select class="form-control logininput col-9 mb-2" id="BookName" name="bookname">
                    <option selected disabled>--Select Book Name--</option>
                    <?php while($row = mysqli_fetch_assoc($runbookquery)): ?>
                    <option value="<?php echo $row['Bookid']; ?>"><?php echo $row['Book_Name']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="" class="col-3">Quantity:</label>
                <input type="number" name="qty" id="EmpFName" placeholder="Qty of Books"
                    class="form-control logininput col-9 mb-2">

                <label for="photo" class="col-3">Order Date:</label>
                <input type="date" class="form-control logininput col-9 mb-2" id="orderdate" name="orderdate">

                <label for="" class="col-3">Payment_Method:</label>
                <select class="form-control logininput col-9 mb-2" name="payment" id="paymentmethod">
                    <option value="">--Select Payment Method--</option>
                    <?php while($row = mysqli_fetch_assoc($runpaymentquery)): ?>
                    <option value="<?php echo $row['PaymentId']; ?>"><?php echo $row['PaymentMethod']; ?></option>
                    <?php endwhile; ?>
                </select>

                <label for="city" class="col-3">Select BookType:</label>
                <select class="form-control logininput col-9 mb-2" id="Booktype" name="booktype">
                    <option selected disabled>--Select BookType--</option>
                    <?php while($row = mysqli_fetch_assoc($queryrun)): ?>
                    <option disabled value="<?php echo $row['Typeid']; ?>"></option>
                    <?php endwhile; ?>
                </select>


                <label for="city" class="col-3">Select Delivery Locations:</label>
                <select class="form-control logininput col-9 mb-2" require id="delivery" name="dellocation">
                    <option require selected disabled value="">--Select Delivery Locations--</option>
                </select>

                <label for="city" class="col-3">Select Delivery Charges (In Rs.):</label>
                <select class="form-control logininput col-9 mb-2" id="deliverychar" name="deliverycharges">
                    <option selected disabled value="">--Select Delivery Charges(In Rs.)--</option>
                </select>

                <label for="city" class="col-3">Select Book Weight(in KG):</label>
                <select class="form-control logininput col-9 mb-2" id="BookWeight" name="bookweight">
                    <option selected disabled value="">--Select Book Weight--</option>
                    <?php while($row = mysqli_fetch_assoc($runweight)): ?>
                    <option disabled value="<?php echo $row['weightid']?>"></option>
                    <?php endwhile; ?>
                </select>

                <label for="city" class="col-3">Delivery Charges on BookWeight(In Rs.):</label>
                <select class="form-control logininput col-9 mb-2" id="deliveryweight" name="deliverychargesweight">
                    <option selected disabled value="">--Delivery Charges on BookWeight(In Rs.)--</option>
                    <?php while($row = mysqli_fetch_assoc($rundelcharges)): ?>
                    <!-- <option value=""></option>  -->
                    <?php endwhile; ?>
                </select>

                <!-- Credit Card Modal Box start here -->
                <form action="" id="formsubmit">
                    <div class="modal fade" id="creditcard" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Credit Card Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <!-- alert result message -->
                                <div id="result-message" class="alert alert-success"></div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <?php echo @$_SESSION['CustName']; ?>
                                                    <label for="" class="mb-1">Card Number:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="789 456 123 698" id="cardnumber" name="cardnumber">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label for="" class="mb-1">Date of Expiry:</label>
                                                    <input type="date" class="form-control" id="dateofexpiry"
                                                        name="dateofexpiry">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label for="" class="mb-1">Title of Account:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Your A/c Name" id="titleofac"
                                                        name="titleofAc">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label for="" class="mb-1">Customer Name:</label>
                                                    <input type="text" class="form-control" placeholder="Customer Name"
                                                        disabled value="<?php echo @$_SESSION['CustName'];?>"
                                                        name="<?php echo @$_SESSION['Cust_id'];?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!--Footer-->
                                    <div class="modal-footer float-right">
                                        <button type="button" class="btn btn-dark"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" id="btncredit" value="" name=""
                                            class="btn btn-dark">Submit Payment Method</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Credit Card Modal Box End here -->

                <!-- Through Cash Modal Box Start here -->
                <form action="" id="submitcashform">
                    <div class="modal fade" id="cashmodal" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cash Details</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <!-- alert result message -->
                                <div id="result-msg" class="alert alert-success"></div>
                                <div class="modal-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label for="" class="mb-1">Customer Name:</label>
                                                    <input type="text" class="form-control" placeholder="Customer Name"
                                                        disabled value="<?php echo @$_SESSION['CustName'];?>"
                                                        name="<?php echo @$_SESSION['Cust_id'];?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group mt-2">
                                                    <label for="" class="mb-1">Contact No:</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Your Contact No" id="contactno"
                                                        name="contactno">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group mt-2">
                                                    <label for="" class="mb-1">Postal Address:</label>
                                                    <textarea id="postaladdress" name="PostalAddress"
                                                        class="form-control" cols="30" rows="10"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!--Footer-->
                                    <div class="modal-footer float-right">
                                        <button type="button" class="btn btn-dark"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" id="submitcash" class="btn btn-dark">Save Cash
                                            Details</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script>
        // BookType
        $('#BookName').on('change',function(){
            var booknameid = this.value;
            console.log(booknameid);
            $.ajax({
                url: 'Bookname.php',
                type: "POST",
                data:{
                    bname_id: booknameid
                },
                success:function(result){
                    console.log(result);
                    $('#Booktype').html(result);
                }
            })
        });

        // BookWeight
        $('#Booktype').on('change',function(){
            var booktype_id = this.value;
             console.log(booktype_id);
            $.ajax({
                url: 'BookWeight.php',
                type: "POST",
                data:{
                    type_id: booktype_id
                },
                success:function(result){
                    console.log(result);
                    $('#BookWeight').html(result);
                }
            })
        });


        // DeliveryLocation
        $('#Booktype').on('change',function(){
            var booktype_id = this.value;
             console.log(booktype_id);
            $.ajax({
                url: 'dropdown.php',
                type: "POST",
                data:{
                    type_id: booktype_id
                },
                success:function(result){
                    console.log(result);
                    $('#delivery').html(result);
                }
            })
        });

        //Delivery Charges
        $('#delivery').on('change',function(){
            var DeliveryLoc_id = this.value;
            $.ajax({
                url: 'delivery_charges.php',
                type: "POST",
                data:{
                    Location_id: DeliveryLoc_id
                },
                success:function(result){
                       console.log(result);
                     $('#deliverychar').html(result);
                }
            })
        });

        //Weight of the Book
        $('#BookWeight').click('change', function(){
            var weightid = this.value;
            console.log(weightid);
            $.ajax({
                url: 'ChargesonWeight.php',
                type: "POST",
                data:{
                    Weight_id : weightid
                },
                success:function(result){
                    console.log(result);
                    $('#deliveryweight').html(result);
                }
            })
        });

            //Credit  Card and Cash 
            $('#paymentmethod').change(function(){
                var paymethod = this.value;
                console.log(paymethod);
                    if(paymethod == 1){
                        $("#creditcard").modal('show');
                        $('#result-message').hide();
                                $('#btncredit').click(function(){
                                    $.ajax({
                                        url: 'CreditCard.php',
                                        type: "POST",
                                        data: $('#formsubmit').serialize(),
                                        success: function(result){
                                            $('#result-message').fadeIn();
                                            $('#formsubmit').trigger("reset");
                                            $('#result-message').html(result);
                                            console.log(result);
                                            setTimeout(function(){
                                            $('#result-message').fadeOut("slow");   
                                            }, 1000);
                                            
                                        }
                                    })
                                });
                            
                    }
                    else{
                        $("#cashmodal").modal('show');
                        $('#result-msg').hide();
                            $('#submitcash').click(function(){
                                $.ajax({
                                        url: 'Cash.php',
                                        type: "POST",
                                        data: $('#submitcashform').serialize(),
                                        success: function(result){
                                            $('#result-msg').fadeIn();
                                            $('#submitcashform').trigger("reset");
                                            $('#result-msg').html(result);
                                            console.log(result);
                                            setTimeout(function(){
                                            $('#result-msg').fadeOut("slow");   
                                            }, 1000);
                                            
                                        }
                                    })
                            });
                    }
                    

                    // OR

                // if($(this).val() == 1){
                //     $("#creditcard").modal('toggle');
                // }
                // else{
                //     $("#cashmodal").modal('toggle');
                // }
            });
        
    </script>