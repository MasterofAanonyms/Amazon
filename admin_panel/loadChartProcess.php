<?php

include "connection.php";

$rs = Database::search("SELECT * FROM invoice INNER JOIN products ON 
invoice.products_id=products.id GROUP BY products.id, products.product_name
ORDER BY total DESC LIMIT 5");


$num = $rs->num_rows;

$labels = array();
$data = array();

for ($i=0; $i < $num; $i++) { 
    $d = $rs->fetch_assoc();

    $labels[] = $d["product_id"];
    $data[] = $d["total"];
}

$json = array();
$json["labels"] = $labels;
$json["data"] = $data;

echo json_encode($json);

?>