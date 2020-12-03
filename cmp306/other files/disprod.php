<!--

-->

<?php
session_start();
require_once("scripts/productdbcontroller.php");
$db_handle = new DBController();
include("scripts/header.php");
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM products WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["code"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;

    case "checkout":
        //Cookie Variables
        $cookie_name = "user";
        $cookie_guest = "guest";

        $current_date = date("Y-m-d H:i:s");

        //variables that hold the database username and password
        $user="root";
        $pass="";

        // Connect to the MySQL database
        $db = new PDO('mysql:host=localhost;dbname=my_ecommerce_db', $user, $pass);

        //Check for any connection errors
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if(!empty($_SESSION["cart_item"])){
            foreach($_SESSION["cart_item"] as $item){
                if(isset($_COOKIE[$cookie_name])) {
                    $userinfo = explode(",", $_COOKIE[$cookie_name]);
                    $userid = $userinfo[1];
                }

                else{
                    $userinfo = explode(",", $_COOKIE[$cookie_guest]);
                    $userid = $userinfo[1];
                }

                $item_price =$item["quantity"]*$item["price"];
                $item_name =$item["name"];

                $stmt =$db->prepare("INSERT INTO orders (Customerid, OrderTotal, OrderedProducts, OrderDate) values (:bb, :cc, :dd, :ee)");

                $stmt->execute(array(
                    ":bb" => $userid,
                    ":cc" => $item_price,
                    ":dd" => $item_name,
                    ":ee" => $current_date
                    ));
            }
        }

        $db = null;

        unset($_SESSION["cart_item"]);

        break;
}
}
?>
<div class="st-xlarge st-text-grey">
    Products
</div><br>

<!-- Style for product page. This is in a different stylesheet as some styles conflict with each other and break. -->
<link href="prodpagestyle.css" type="text/css" rel="stylesheet" />

<div id="shopping-cart">
<div class="st-large st-text-grey">Shopping Cart</div>

<a id="btnEmpty" class="st-red" href="disprod.php?action=empty">Empty Cart</a>
<a id="btnEmpty" class="st-black st-border-black" href="disprod.php?action=checkout">Checkout</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart st-medium" cellpadding="15" cellspacing="1">
<tbody>
<tr>
<th class="st-left-align">Name</th>
<th class="st-left-align">Code</th>
<th class="st-right-align" width="5%">Quantity</th>
<th class="st-right-align" width="10%">Unit Price</th>
<th class="st-center" width="10%">Price</th>
<th class="st-center" width="5%">Remove</th>
</tr>

<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
				<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "£".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "£". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="disprod.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "£".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>
    <?php
} else {
?>
<div class="no-records st-medium">Your Cart is Empty</div>
<?php 
}
?>
</div>
<div class="st-row">
    <div id="product-grid">
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM products ORDER BY id ASC");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
	?><div class="product-item st-grayscale">
            <form method="post" action="disprod.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                <div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>" width="200" height="200"></div>
                <div class="product-tile-footer">
                    <div class="product-title st-medium"><?php echo $product_array[$key]["name"]; ?></div>
                    <div class="product-price st-medium"><?php echo "£".$product_array[$key]["price"]; ?></div>
                    <div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction st-black" /></div>
                </div>
            </form>
            </div>
	<?php
		}
	}
?>

    </div>
</div>

<?php
include("scripts/footer.php");
?>

