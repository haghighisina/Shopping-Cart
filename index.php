<?php
require_once ("DB.php");
session_start(); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product</title>
    <link rel="stylesheet" href="all.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="all.js" ></script>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Titillium+Web&display=swap');

        *{
            font-family = 'Titillium Web', sans-serif;
        }
        .product{
            border: 1px solid #eaeaec;
            margin: -1px 19px 3px 1px;
            padding: 10px;
            float: right;
            text-align: center;
            background-color: #efefef;
        }
        table, th, tr{
            text-align: center;
        }
        .title2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        h2{
            text-align: center;
            color: #66afe9;
            background-color: #efefef;
            padding: 2%;
        }
        table th{
            background-color: #efefef;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Shop</h3>
        <?php
        CreateDb();

        $query  = "SELECT * FROM stuff ORDER BY id ASC";
        $result = mysqli_query($GLOBALS['con'], $query);
        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_array($result)) {?>

<div class="col-md-3" style="margin: 0 auto; float: right">
    <form method="post" action="Todo.php?action=add&id=<?php echo $row['id']; ?>">
        <div class="product">
            <img style="width: 100%" src="  <?php   echo  $row['Image']; ?>" >
            <h5 class="text-info">  <?php   echo  $row['Pname']; ?></h5>
            <h5 class="text-danger"><?php echo  $row['Price']; ?></h5>
            <input type="text" name="quantity" value="1" class="form-control">
            <input type="hidden" name="hidden_name" value="<?php echo $row['Pname']; ?>">
            <input type="hidden" name="hidden_price" value="<?php echo $row['Price']; ?>">
            <input type="submit" name="add" style="margin-top: 5px" class="btn btn-success" value="Add">
        </div>
    </form>
</div>
<?php }
} ?>

<div style="clear: both"></div>
<h4 class="title2">Shop</h4>
<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th class="30%">Name</th>
            <th class="10%">Quantity</th>
            <th class="13%">Price</th>
            <th class="10%">Total Price</th>
            <th class="17%">Remove Item</th>
        </tr>

<?php
    if (!empty($_SESSION['cart'])){
        $total = 0;
        foreach ($_SESSION['cart'] as $key => $value) {
            ?>

            <tr>
                <td><?php echo $value['item_name']; ?></td>
                <td><?php echo $value['item_quantity']; ?></td>
                <td>$ <?php echo $value['product_price']; ?></td>
                <td>
                    $ <?php echo number_format($value['item_quantity'] * $value['product_price'], 2); ?></td>
                <td><a href="index.php?action=delete&id=<?php echo $value['product_id']; ?>">
                        <span class="text-danger">Remove</span>
                    </a>
                </td>
            </tr>

            <?php
            $total = $total + ($value['item_quantity'] * $value['product_price']);
                }
            ?>

            <tr>
                <td colspan="3" align="right">Total</td>
                <th align="right">$ <?php echo number_format($total, 2); ?></th>
                <td></td>
            </tr>
            <?php
        }
?>
    </table>
 </div>
</div>
</body>
</html>
