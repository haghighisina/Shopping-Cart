<?php
require_once ("DB.php");
session_start();
if (isset($_POST['add'])){
    if (isset($_SESSION['cart'])){
        $item_id = array_column($_SESSION['cart'], 'product_id');
        if (!in_array($_GET['id'], $item_id)){
            $count      = count($_SESSION['cart']);
            $item_array = array(
                'product_id'    => $_GET['id'],
                'item_name'     => $_POST['hidden_name'],
                'product_price' => $_POST['hidden_price'],
                'item_quantity' => $_POST['quantity']
            );
            $_SESSION['cart'][$count] = $item_array;
            echo '<script>window.location="index.php"</script>';
        }else{
            echo "<script>alert('Product is added already')</script>";
            echo '<script>window.location="index.php"</script>';
        }
    }else{
        $item_array = array(
            'product_id'    => $_GET['id'],
            'item_name'     => $_POST['hidden_name'],
            'product_price' => $_POST['hidden_price'],
            'item_quantity' => $_POST['quantity']
        );
        $_SESSION['cart'][0] = $item_array;

    }
}

if (isset($_GET['action'])){
    if ($_GET['action'] == "delete"){
        foreach ($_SESSION['cart'] as $keys => $value){
            if ($value['product_id'] == $_GET['id']){
                unset($_SESSION['cart'][$keys]);
                echo "<script>alert('Product is deleted')</script>";
                echo '<script>window.location="index.php"</script>';
            }
        }
    }
}
?>