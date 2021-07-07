<?php
include("connection.php");
// $orderid = $_POST['orderid'];
// $useraddressid = $_POST['useraddressid'];
// $userid = $_POST['userid'];
// $courierid = $_POST['courierid'];
$orderid = $_GET['orderid'];
$useraddressid = $_GET['useraddressid'];
$userid = $_GET['userid'];
$courierid = $_GET['courierid'];
?>
<html>
<head>
<title>Printing</title>
<style>
body {
    background-color: #101820FF;
    color: #F2AA4CFF;
}

#table1 {
    border-collapse: collapse;
}

</style>
</head>

<body>
    <?php
    $sql = "SELECT * FROM orders o LEFT JOIN orderitems oi on o.orderid = oi.orderid LEFT JOIN items i ON i.itemid = oi.itemid LEFT JOIN couriers c on o.courierid = c.courierid LEFT JOIN orderstatus os on o.statusid = os.statusid LEFT JOIN users u on u.userid = o.userid LEFT JOIN useraddresses ua on ua.userid = u.userid WHERE o.orderid = ".$orderid." GROUP BY o.orderid";
    $qry = mysqli_query($conn, $sql);
    if($qry){
        // echo "<script language='javascript'>alert('The data has been fetched successfully.');</script>";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
    }
    $d = mysqli_fetch_assoc($qry);
    ?>
    <div id="section-to-print">
    <center>
        <table border="3" id="table1">
            <tr>
                <td colspan="5" align="center"><b>Receipt</b></td>
            </tr>
            <tr>
                <th>#No</th>
                <th>Item Flavour</th>
                <th>Price per Unit</th>
                <th>Quantity</th>
                <th>Total Price</th>
            </tr>
            <?php
                $sqlReceipt = "SELECT * FROM orders o LEFT JOIN orderitems oi on o.orderid = oi.orderid LEFT JOIN items i ON i.itemid = oi.itemid WHERE o.orderid = ".$orderid." ORDER BY i.itemflavour ASC";
                $qryReceipt = mysqli_query($conn, $sqlReceipt);
                $rowReceipt = mysqli_num_rows($qryReceipt);

                if($rowReceipt > 0)
                {
                    $counterReceipt = 1;
                    while($dReceipt = mysqli_fetch_assoc($qryReceipt))
                    {
            ?>
            <tr>
                <td><?php echo $counterReceipt; ?></td>
                <td><?php echo $dReceipt['itemflavour']; ?></td>
                <td><?php echo "RM ". number_format($dReceipt['sellingprice'],2); ?></td>
                <td><?php echo $dReceipt['quantity']; ?></td>
                <td><?php $totalprice = $dReceipt['sellingprice'] * $dReceipt['quantity']; echo "RM ". number_format($totalprice,2);?></td>
            </tr>
            <?php
                        $counterReceipt++;
                    } //close while() @ line #57
                } //close if($row > 0) @ line #54
            ?>

            <tr>
                <td colspan="4"><b>Rate</b></td>
                <td><?php 
                        $sqladdress = "SELECT * FROM useraddresses ua LEFT JOIN users u on u.userid = ua.userid LEFT JOIN regions r on r.regionid = ua.regionid WHERE ua.userid = ".$userid." AND ua.useraddressid = ".$useraddressid."";
                        $qryaddress = mysqli_query($conn, $sqladdress);
                        $rowaddress = mysqli_num_rows($qryaddress);

                        if ($rowaddress > 0) {
                            while ($ra = mysqli_fetch_assoc($qryaddress)) {
                                $regionid = $ra['regionid'];
                            }
                        } else {
                            echo "<script language='javascript'>alert('No Address Selected! Please select an address.');window.location='cart.php';</script>";
                        }

                        $sqlRate = "SELECT * FROM couriers WHERE courierid = ".$courierid."";
                        $qryRate = mysqli_query($conn, $sqlRate);

                        $dr = mysqli_fetch_assoc($qryRate);
                        $ssrate = $dr['ssrate'];
                        $smrate = $dr['smrate'];

                        if(strcasecmp("SBH","$regionid") == 0 || strcasecmp("SWK","$regionid") == 0) {
                            $rate = $ssrate;
                        } else {
                            $rate = $smrate;
                        }
                        echo "RM ".number_format($rate, 2);
                    ?></td>
            </tr>
            <tr>
                <td colspan="3"><b>Sub Total</b></td>
                <td><?php 
                $sqlQty = "SELECT SUM(oi.quantity) AS sum FROM orders o LEFT JOIN orderitems oi on o.orderid = oi.orderid LEFT JOIN items i ON i.itemid = oi.itemid WHERE o.orderid = ".$orderid." ORDER BY i.itemflavour ASC";
                $qryQty = mysqli_query($conn, $sqlQty);
                $rowQty = mysqli_num_rows($qryQty);
                $dQty = mysqli_fetch_assoc($qryQty);
                echo $dQty['sum'];
                ?></td>
                <td><?php 
                $sqlPrice = "SELECT SUM(oi.quantity * i.sellingprice) AS sum FROM orders o LEFT JOIN orderitems oi on o.orderid = oi.orderid LEFT JOIN items i ON i.itemid = oi.itemid WHERE o.orderid = ".$orderid." ORDER BY i.itemflavour ASC";
                $qryPrice = mysqli_query($conn, $sqlPrice);
                $rowPrice = mysqli_num_rows($qryPrice);
                $dPrice = mysqli_fetch_assoc($qryPrice);
                echo "RM ". number_format((($dPrice['sum']) + $rate),2);
                ?></td>
            </tr>
        </table>
    </center>
    </div>
</body>
</html>