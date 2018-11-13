<?php

require 'connectDb.php';

$conn = getDbConnection();

$xmlPath = 'xml/products_1927a13ce63d227pl(1).xml';
$xmlFile = simplexml_load_file($xmlPath);

$items = $xmlFile->xpath('item');
foreach ($items as $item) {
    $objectForDb = [];

    $objectForDb['prod_name'] = $item->prod_name;
    $objectForDb['prod_id'] = $item->prod_id;
    $objectForDb['prod_price'] = $item->prod_price;
    $objectForDb['prod_tax_id'] = $item->prod_tax_id;
    $objectForDb['taxpercent'] = $item->taxpercent;
    $objectForDb['prod_oldprice'] = $item->prod_oldprice;
    $objectForDb['prod_buy_price_net'] = $item->prod_buy_price_net;
    $objectForDb['prod_amount'] = $item->prod_amount;
    $objectForDb['prod_hidden'] = $item->prod_hidden;
    $objectForDb['prod_symbol'] = $item->prod_symbol;
    $objectForDb['prod_weight'] = $item->prod_weight;
    $objectForDb['prd_name'] = $item->prd_name;
    $objectForDb['prod_pkwiu'] = $item->prod_pkwiu;
    $objectForDb['prod_ean'] = $item->prod_ean;
    $objectForDb['prod_isbn'] = $item->prod_isbn;
    $objectForDb['prod_barcode'] = $item->prod_barcode;
    $objectForDb['prod_ship_days'] = $item->prod_ship_days;
    $objectForDb['prod_desc'] = $item->prod_desc;
    $objectForDb['prod_shortdesc'] = $item->prod_shortdesc;
    $objectForDb['prod_info1_pl'] = $item->prod_info1_pl;
    $objectForDb['prod_info2_pl'] = $item->prod_info2_pl;
    $objectForDb['prod_info3_pl'] = $item->prod_info3_pl;
    $objectForDb['prod_info4_pl'] = $item->prod_info4_pl;
    $objectForDb['prod_info5_pl'] = $item->prod_info5_pl;
    $objectForDb['prod_note'] = $item->prod_note;
    $objectForDb['prod_seotitle_pl'] = $item->prod_seotitle_pl;
    $objectForDb['prod_seodesc_pl'] = $item->prod_seodesc_pl;
    $objectForDb['prod_keywords_pl'] = $item->prod_keywords_pl;
    $objectForDb['prod_sales_gain'] = $item->prod_sales_gain;
    $objectForDb['prod_link'] = $item->prod_link;
    $objectForDb['prod_price_base'] = $item->prod_price_base;
    $objectForDb['prod_price_net_base'] = $item->prod_price_net_base;
    $objectForDb['prod_price_net'] = $item->prod_price_net;
    $objectForDb['cat_path'] = $item->cat_path;

    foreach ($item->prod_img as $img) {
        $objectForDb['prod_img'][] = $img->img;
    }

    $jsonObjectForDb = json_encode($objectForDb);

    $statement = $conn->prepare("INSERT INTO item (id, object) VALUES (null, ?)");
    $statement->bind_param("s", $jsonObjectForDb);
    $statement->execute();
}

$conn->close();


