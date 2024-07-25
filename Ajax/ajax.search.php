<?php
session_start();
include "../config/Database.php";
include "../models/Items.php";
include '../config/class.validation.php';
include "../config/function.php"; 
//Instantiate Database & Connect
$database = new Database();
$db = $database->Connect();

//Instantiate User Object
$user = new Item($db);

if (isset($_POST['search_keyword'])) {
    if (empty($_SESSION['invoice'])) {
        $_SESSION['invoice']='RS-'.createRandomPassword();
    }else{
        $invoice = $_SESSION['invoice'];
    }
            
            $search_keyword = $_POST['search_keyword'];


            $query = "SELECT * FROM items WHERE item_name LIKE '%$search_keyword%' AND hand_qty > 0";
            $stmt = $db->prepare($query);

            $stmt->execute();?>
            <ul class="nav flex-column">
           <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $url = base64_encode($row['item_id'].','.$invoice.','.$row['reg_price']);
            ?>
                
                  <li class="nav-item">
                    <a href="/items_cart/<?php echo $url; ?>" class="nav-link">
                      <strong><?php echo $row['item_name']; ?></strong>
                      <span class="float-right badge bg-primary">&#8358; <?php echo number_format($row['reg_price'],2) ?></span>
                    </a>
                  </li>
                
            <?php }?>
            </ul>

<?php } ?>

