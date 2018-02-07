<?php
include_once '../dbManager/dbManager.php';
include_once 'customer_creation.php';

class Order
{
    function getOrder()
    {
        $sql = "SELECT 
                  o.id, o.order_no, o.date, c.nic, c.id cus_id, c.name, c.address, c.phone_no, o.sales_officer_id, o.recovery_officer_id, o.payment, o.payment_date, o.no_of_terms
                FROM 
                  orders o, 
                  customer_details c 
                WHERE 
                  c.id = o.customer_id
                  AND o.order_no = '". $_POST["order_no"] . "'";

        $DbManager = new DbManager();
        $data = $DbManager->select($sql);
        if(isset($data[0])) {
            $sql = "SELECT 
                  i.code, i.description, o.price , o.quantity
                FROM 
                  order_items o, 
                  items i 
                WHERE 
                  i.id = o.item_id 
                  AND o.status = 1
                  AND o.order_id = '" . $data[0]["id"] . "'";
            $data['items'] = $DbManager->select($sql);
        }
        return ($data);
    }

    function addOrder()
    {

        $DbManager = new DbManager();
        $date = '';
        $items = '';
        $order_no = '';
        $recovery_officer_id = '';
        $sales_officer_id = '';
        $payment = '';
        $payment_date = '';
        $no_of_terms = '';

        if($_POST["customer_id"] == ''){
            $cus = new createCustomer();
            $cus->addCustomer();
            $customer_id = $DbManager->getLastInsertId();
        }else{
            $customer_id = $_POST["customer_id"];
        }

        if($_POST["date"] != '')
            $date = $_POST['date'];
        if($_POST["items"] != '')
            $items = $_POST['items'];
        if($_POST["order_no"] != '')
            $order_no = $_POST['order_no'];
        if($_POST["recovery_officer_id"] != '')
            $recovery_officer_id = $_POST['recovery_officer_id'];
        if($_POST["sales_officer_id"] != '')
            $sales_officer_id = $_POST['sales_officer_id'];
        if($_POST["payment"] != '')
            $payment = $_POST['payment'];
        if($_POST["payment_date"] != '')
            $payment_date = $_POST['payment_date'];
        if($_POST["no_of_terms"] != '')
            $no_of_terms = $_POST['no_of_terms'];

        $sql = "INSERT INTO orders(`id`,`order_no`,`date`,`customer_id`,`sales_officer_id`,`recovery_officer_id`,`payment`, `payment_date`, `no_of_terms`)
                VALUES('','$order_no','$date','$customer_id','$sales_officer_id','$recovery_officer_id','$payment','$payment_date','$no_of_terms')";
        $data = $DbManager->save($sql);
        $order_id = $DbManager->getLastInsertId();

        $total = 0;
        foreach ($items as $key => $value){
            $sql = "INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `price`, `quantity` )
                    VALUES('','$order_id',(SELECT id FROM `items` WHERE `code`= $value[1]),'$value[4]','$value[3]')";
            $data = $DbManager->save($sql);
            $total = $total + ($value[4] * $value[3]);
        }

        $payment_amount = $total / $no_of_terms;
        for($i = 1; $i <= $no_of_terms; $i++) {
            $sql = "INSERT INTO `payment_plan` (`id`,`payment_date`, `payment_amount`, `term`, `order_id`)
                VALUES ('', '$payment_date', '$payment_amount','$i','$order_id' )";
            $data = $DbManager->save($sql);
        }

        $payment_amount = $total / $no_of_terms;

        $sql = "INSERT INTO  `payment_plan` (`id`, `payment_date`, `payment_amount`, `term`, `order_id`)
                VALUES ('', '$payment_date', '$payment_amount','1','$order_id' )";
        $data = $DbManager->save($sql);

        $d = date_parse_from_format("Y-m-d", $payment_date);
        $month = $d["month"];
        $year = $d["year"];
        $day = $d["day"];
        for($i = 0; $i < $no_of_terms; $i++){
            $month++;
            if($month > 12) {
                $month = $month - 12;
                $year++;
            }
            $next_mnth_days = cal_days_in_month(CAL_GREGORIAN,$month, $year);
            if($next_mnth_days < $day)
                $day = $next_mnth_days;
            else
                $day = $d["day"];
            $payment_date = $year .'-'.$month .'-'.$day ;

            $sql = "INSERT INTO  `payment_plan` (`id`, `payment_date`, `payment_amount`, `term`, `order_id`)
                VALUES ('', '$payment_date', '$payment_amount',$i+2,'$order_id' )";
            $data = $DbManager->save($sql);
        }
        return ($data);
    }

    function updateOrder()
    {
        $payment = '';
        $payment_date = '';
        $no_of_terms = '';
        $date = '';
        $order_id = '';
        $order_no = '';
        $customer_id = '';
        $recovery_officer_id = '';
        $sales_officer_id = '';

        if($_POST["date"] != '')
            $date = $_POST['date'];
        if($_POST["items"] != '')
            $items = $_POST['items'];
        if($_POST["order_id"] != '')
            $order_id = $_POST['order_id'];
        if($_POST["order_no"] != '')
            $order_no = $_POST['order_no'];
        if($_POST["customer_id"] != '')
            $customer_id = $_POST['customer_id'];
        if($_POST["payment"] != '')
            $payment = $_POST['payment'];
        if($_POST["payment_date"] != '')
            $payment_date = $_POST['payment_date'];
        if($_POST["no_of_terms"] != '')
            $no_of_terms = $_POST['no_of_terms'];
        if($_POST["recovery_officer_id"] != '')
            $recovery_officer_id = $_POST['recovery_officer_id'];
        if($_POST["sales_officer_id"] != '')
            $sales_officer_id = $_POST['sales_officer_id'];

        $cus = new createCustomer();
        $cus->updateCustomer();

        $DbManager = new DbManager();

        $sql = "UPDATE orders SET order_no='$order_no', date='$date', customer_id ='$customer_id' , sales_officer_id = '$sales_officer_id', recovery_officer_id='$recovery_officer_id',payment='$payment',payment_date='$payment_date',no_of_terms='$no_of_terms' WHERE id='$order_id'";
        $data = $DbManager->update($sql);

        $sql = "UPDATE `order_items` SET status=0 WHERE order_id=$order_id";
        $data = $DbManager->update($sql);

        $total = 0;
        foreach ($items as $key => $value){
            $sql = "INSERT INTO `order_items` (`id`, `order_id`, `item_id`, `price`, `quantity` )
                    VALUES('','$order_id',(SELECT id FROM `items` WHERE `code`= $value[1]),'$value[4]','$value[3]')";
            $data = $DbManager->save($sql);
            $total = $total + ($value[4] * $value[3]);
        }

        $sql = "UPDATE `payment_plan` SET status=0 WHERE order_id=$order_id";
        $data = $DbManager->update($sql);

        $payment_amount = $total / $no_of_terms;

        $sql = "INSERT INTO  `payment_plan` (`id`, `payment_date`, `payment_amount`, `term`, `order_id`)
                VALUES ('', '$payment_date', '$payment_amount','1','$order_id' )";
        $data = $DbManager->save($sql);

        $d = date_parse_from_format("Y-m-d", $payment_date);
        $month = $d["month"];
        $year = $d["year"];
        $day = $d["day"];
        for($i = 0; $i < $no_of_terms; $i++){
            $month++;
            if($month > 12) {
                $month = $month - 12;
                $year++;
            }
            $next_mnth_days = cal_days_in_month(CAL_GREGORIAN,$month, $year);
            if($next_mnth_days < $day)
                $day = $next_mnth_days;
            else
                $day = $d["day"];
            $payment_date = $year .'-'.$month .'-'.$day ;

            $sql = "INSERT INTO  `payment_plan` (`id`, `payment_date`, `payment_amount`, `term`, `order_id`)
                VALUES ('', '$payment_date', '$payment_amount',$i+2,'$order_id' )";
            $data = $DbManager->save($sql);
        }
        return ($data);
    }

}