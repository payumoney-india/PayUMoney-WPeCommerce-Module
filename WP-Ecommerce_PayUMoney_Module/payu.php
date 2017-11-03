<?php

$nzshpcrt_gateways[$num]['name'] = 'PayU';
$nzshpcrt_gateways[$num]['internalname'] = 'PayU';
$nzshpcrt_gateways[$num]['function'] = 'gateway_PayU';
$nzshpcrt_gateways[$num]['form'] = "form_PayU";
$nzshpcrt_gateways[$num]['submit_function'] = "submit_PayU";
$nzshpcrt_gateways[$num]['payment_type'] = "credit_card";

function gateway_PayU($seperator, $sessionid) {
  global $wpdb;

  $countryarray = array("IN" => "IND", "DE" => "DEU", "BR" => "BRA", "DE" => "DEU", "AT" => "AUT", "BE" => "BEL", "CA" => "CAN", "CN" => "CHN", "ES" => "ESP", "FI" => "FIN", "FR" => "FRA", "GR" => "GRC", "IT" => "ITA", "JP" => "JPN", "LU" => "LUX", "NL" => "NLD", "PL" => "POL", "PT" => "PRT", "CZ" => "CZE", "GB" => "GBR", "SE" => "SWE", "CH" => "CHE", "DK" => "DNK", "US" => "USA", "HK" => "HKG", "NO" => "NOR", "AU" => "AUS", "SG" => "SGP", "IE" => "IRL", "NZ" => "NZL", "KR" => "KOR", "IL" => "ISR", "ZA" => "ZAF", "NG" => "NGA", "CI" => "CIV", "TG" => "TGO", "BO" => "BOL", "MU" => "MUS", "RO" => "ROU", "SK" => "SVK", "DZ" => "DZA", "AS" => "ASM", "AD" => "AND", "AO" => "AGO", "AI" => "AIA", "AG" => "ATG", "AR" => "ARG", "AM" => "ARM", "AW" => "ARW", "AZ" => "AZE", "BS" => "BHS", "BH" => "BHR", "BD" => "BGD", "BB" => "BRB", "BY" => "BLR", "BZ" => "BLZ", "BJ" => "BEN", "BM" => "BMU", "BT" => "BTN", "BW" => "BWA", "BN" => "BRN", "BF" => "BFA", "MM" => "MMR", "BI" => "BDI", "KH" => "KHM", "CM" => "CMR", "CV" => "CPV", "CF" => "CAF", "TD" => "TCD", "CL" => "CHL", "CO" => "COL", "KM" => "COM", "CD" => "COD", "CG" => "COG", "CR" => "CRI", "HR" => "HRV", "CU" => "CUB", "CY" => "CYP", "DJ" => "DJI", "DM" => "DMA", "DO" => "DOM", "TL" => "TLS", "EC" => "ECU", "EG" => "EGY", "SV" => "SLV", "GQ" => "GNQ", "ER" => "ERI", "EE" => "EST", "ET" => "ETH", "FK" => "FLK", "FO" => "FRO", "FJ" => "FJI", "GA" => "GAB", "GM" => "GMB", "GE" => "GEO", "GH" => "GHA", "GD" => "GRD", "GL" => "GRL", "GI" => "GIB", "GP" => "GLP", "GU" => "GUM", "GT" => "GTM", "GG" => "GGY", "GN" => "GIN", "GP" => "GLP", "GW" => "GNB", "GY" => "GUY", "HT" => "HTI", "HM" => "HMD", "VA" => "VAT", "HN" => "HND", "IS" => "ISL", "ID" => "IDN", "IR" => "IRN", "IQ" => "IRQ", "IM" => "IMN", "JM" => "JAM", "JE" => "JEY", "JO" => "JOR", "KZ" => "KAZ", "KE" => "KEN", "KI" => "KIR", "KP" => "PRK", "KW" => "KWT", "KG" => "KGZ", "LA" => "LAO", "LV" => "LVA", "LB" => "LBN", "LS" => "LSO", "LR" => "LBR", "LS" => "LSO", "LR" => "LBR", "LY" => "LBY", "LI" => "LIE", "LT" => "LTU", "MO" => "MAC", "MK" => "MKD", "MG" => "MDG", "MW" => "MWI", "MY" => "MYS", "MV" => "MDV", "ML" => "MLI", "MT" => "MLT", "MH" => "MHL", "MQ" => "MTQ", "MR" => "MRT", "HU" => "HUN", "YT" => "MYT", "MX" => "MEX", "FM" => "FSM", "MD" => "MDA", "MC" => "MCO", "MN" => "MNG", "ME" => "MNE", "MS" => "MSR", "MA" => "MAR", "MZ" => "MOZ", "NA" => "NAM", "NR" => "NRU", "NP" => "NPL", "AN" => "ANT", "NC" => "NCL", "NI" => "NIC", "NE" => "NER", "NU" => "NIU", "NF" => "NFK", "MP" => "MNP", "OM" => "OMN", "PK" => "PAK", "PW" => "PLW", "PS" => "PSE", "PA" => "PAN", "PG" => "PNG", "PY" => "PRY", "PE" => "PER", "PH" => "PHL", "PN" => "PCN", "PR" => "PRI", "QA" => "QAT", "RE" => "REU", "RU" => "RUS", "RW" => "RWA", "BL" => "BLM", "KN" => "KNA", "LC" => "LCA", "MF" => "MAF", "PM" => "SPM", "VC" => "VCT", "WS" => "WSM",
      "SM" => "SMR", "ST" => "STP", "SA" => "SAU", "SN" => "SEN", "RS" => "SRB", "SC" => "SYC",
      "SL" => "SLE", "SI" => "SVN", "SB" => "SLB", "SO" => "SOM", "GS" => "SGS", "LK" => "LKA", "SD" => "SDN", "SR" => "SUR", "SJ" => "SJM", "SZ" => "SWZ", "SY" => "SYR", "TW" => "TWN", "TJ" => "TJK", "TZ" => "TZA", "TH" => "THA", "TK" => "TKL", "TO" => "TON", "TT" => "TTO", "TN" => "TUN", "TR" => "TUR", "TM" => "TKM", "TC" => "TCA", "TV" => "TUV", "UG" => "UGA", "UA" => "UKR", "AE" => "ARE", "UY" => "URY", "UZ" => "UZB", "VU" => "VUT", "VE" => "VEN", "VN" => "VNM", "VG" => "VGB", "VI" => "VIR", "WF" => "WLF", "EH" => "ESH", "YE" => "YEM", "ZM" => "ZMB", "ZW" => "ZWE", "AL" => "ALB", "AF" => "AFG", "AQ" => "ATA", "BA" => "BIH", "BV" => "BVT", "IO" => "IOT", "BG" => "BGR", "KY" => "CYM", "CX" => "CXR", "CC" => "CCK", "CK" => "COK", "GF" => "GUF", "PF" => "PYF", "TF" => "ATF", "AX" => "ALA");


  $purchase_log_sql = "SELECT * FROM `" . WPSC_TABLE_PURCHASE_LOGS . "` WHERE `sessionid`= " . $sessionid . " LIMIT 1";
  $purchase_log = $wpdb->get_results($purchase_log_sql, ARRAY_A);
  
  
  
  $cart_sql = "SELECT * FROM `" . WPSC_TABLE_CART_CONTENTS . "` WHERE `purchaseid`='" . $purchase_log[0]['id'] . "'";
  $cart = $wpdb->get_results($cart_sql, ARRAY_A);
  $PayUdata = $_POST['collected_data'];
  
  $len=  sizeof($cart);
  
  $products='';
  for($i=0;$i<$len;$i++)
  {
      $products.=$cart[$i]['name'];
      $products.=', ';
  }
  
  $products=  substr($products,0,-2);
  $products=  substr($products,0,100);
  
  
  
  
  
  $country_iso3 = $countryarray[$PayUdata[7][0]];
  $ship_country_iso3 = $countryarray[$PayUdata[16][0]];
 $mode = (get_option('PayU_Mode') == 1) ? 'TEST' : 'LIVE';
  if ($mode == 'TEST')
    $PayU_url = 'https://test.payu.in/_payment';
  else
    $PayU_url = 'https://secure.payu.in/_payment';
  $data['key'] = get_option('key');
 $data['surl'] = 'http://localhost/wordpress/?attachment_id=5&DR={DR}&PayU_callback=true';
  $data['furl'] = 'http://localhost/wordpress/?attachment_id=5&DR={DR}&PayU_callback=true/';
  $data['mode'] = (get_option('PayU_Mode') == 1) ? 'TEST' : 'LIVE';
  $data['txnid'] = $sessionid;
  $data['service_provider'] = 'payu_paisa';
  $data['firstname'] = $PayUdata[2] . $PayUdata[3];
  $data['address'] = $PayUdata[4];
  $data['city'] = $PayUdata[5];
  $data['state'] = $PayUdata[18];
  $data['postal_code'] = $PayUdata[8];
  $data['country'] = $country_iso3;
  $data['email'] = $PayUdata[9];
  $data['phone'] = $PayUdata[18];
  $salt = get_option('salt');

  $currency_code = $wpdb->get_results("SELECT `code` FROM `" . WPSC_TABLE_CURRENCY_LIST . "` WHERE `id`='" . get_option('currency_type') . "' LIMIT 1", ARRAY_A);
  $local_currency_code = $currency_code[0]['code'];
  $PayU_currency_code = get_option('PayU_curcode');

  $curr = new CURRENCYCONVERTER();
  $decimal_places = 2;
  $total_price = 0;
  $i = 1;
  $all_donations = true;
  $all_no_shipping = true;
  foreach ($cart as $item) {
    $product_data = $wpdb->get_results("SELECT * FROM `" . WPSC_TABLE_PRODUCT_LIST . "` WHERE `id`='" . $item['prodid'] . "' LIMIT 1", ARRAY_A);
    
    $variation_count = count($product_variations);
    $variation_sql = "SELECT * FROM `" . WPSC_TABLE_CART_ITEM_VARIATIONS . "` WHERE `cart_id`='" . $item['id'] . "'";
    $variation_data = $wpdb->get_results($variation_sql, ARRAY_A);
    $variation_count = count($variation_data);
    if ($variation_count >= 1) {
      $variation_list = " (";
      $j = 0;
      foreach ($variation_data as $variation) {
        if ($j > 0) {
          $variation_list .= ", ";
       }
        $value_id = $variation['venue_id'];
        $value_data = $wpdb->get_results("SELECT * FROM `" . WPSC_TABLE_VARIATION_VALUES . "` WHERE `id`='" . $value_id . "' LIMIT 1", ARRAY_A);
        $variation_list .= $value_data[0]['name'];
        $j++;
     }
      $variation_list .= ")";
    } else {
      $variation_list = '';
    }
    $local_currency_productprice = $item['price'];
    $local_currency_shipping = $item['pnp'] * $item['quantity'];
    $PayU_currency_productprice = $local_currency_productprice;
    $PayU_currency_shipping = $local_currency_shipping;
    $data['productinfo'] = $products; //$product_data['name'].$variation_list;	
    $data['item_name_' . $i] = $product_data['name'] . $variation_list;
    $data['amount_' . $i] = number_format(sprintf("%01.2f", $PayU_currency_productprice), $decimal_places, '.', '');
    $data['quantity_'.$i] = $item['quantity'];
    $data['item_number_' . $i] = $product_data['id'];
    if ($item['donation'] != 1) {
      $all_donations = false;
      $data['shipping_' . $i] = number_format($PayU_currency_shipping, $decimal_places, '.', '');
      $data['shipping2_' . $i] = number_format($PayU_currency_shipping, $decimal_places, '.', '');
    } else {
      $data['shipping_' . $i] = number_format(0, $decimal_places, '.', '');
      $data['shipping2_' . $i] = number_format(0, $decimal_places, '.', '');
    }
    if ($product_data['no_shipping'] != 1) {
      $all_no_shipping = false;
    }
    $total_price = $total_price + ($data['amount_' . $i] * $data['quantity_' . $i]);
    if ($all_no_shipping != false)
      $total_price = $total_price + $data['shipping_' . $i] + $data['shipping2_' . $i];
    $i++;
  }
  $base_shipping = $purchase_log[0]['base_shipping'];
  if (($base_shipping > 0) && ($all_donations == false) && ($all_no_shipping == false)) {
    $data['handling_cart'] = number_format($base_shipping, $decimal_places, '.', '');
    $total_price += number_format($base_shipping, $decimal_places, '.', '');
  }
  
 

  $total_price=$purchase_log[0]['totalprice'];
  
  
 $data['product_price'] = $total_price;
 $amount=$data['amount'] = $total_price;
  //include hash validation 
  $key = $data['key'];
  $txnid = $data['txnid'];
  $productInfo = $products; //$data['productinfo'];
  $firstname = $data['firstname'];
  $email = $data['email'];
  $hash_string = $request = $key . '|' . $txnid . '|' . $amount . '|' . $productInfo . '|' . $firstname . '|' . $email . '|||||||||||' . $salt;
  $Hash = hash('sha512', $hash_string);
  $data['hash'] = $Hash;
  if (WPSC_GATEWAY_DEBUG == true) {
    exit("<pre>" . print_r($data, true) . "</pre>");
  }
  // Create Form to post to PayU
  $output = "

		<form id=\"PayU_form\" name=\"PayU_form\" method=\"post\" action=\"$PayU_url\">\n";



  foreach ($data as $n => $v) {

    $output .= "			<input type=\"hidden\" name=\"$n\" value=\"$v\" />\n";
  }



 $output .= "	</form> "
			."<script type=\"text/javascript\">".
                          "function myfunc () {".
                          "var frm = document.getElementById(\"PayU_form\");"
                          ."frm.submit();"
                          ."}".
                     " window.onload = myfunc;".
                   "</script></body></html>

	";
  // echo form.. 
  if (get_option('PayU_debug') == 1) {
    echo ("DEBUG MODE ON!!<br/>");
    echo("The following form is created and would be posted to PayU for processing.  Press submit to continue:<br/>");
    echo("<pre>" . htmlspecialchars($output) . "</pre>");
  }
  echo($output);
  if (get_option('PayU_debug') == 0) {
    echo "<script language=\"javascript\" type=\"text/javascript\">document.getElementById('PayU_form').submit();</script>";
  }
  exit();
}
function nzshpcrt_PayU_callback() {

  global $wpdb;
  
  

  // needs to execute on page start
  // look at page 36
  if ($_GET['PayU_callback'] == 'true') {
    $response = array();
    $response = $_POST;
    $key = $response['key'];
    $txnid = $response['txnid'];
    $status = $response['status'];
    $unmappedstatus = $response['unmappedstatus'];
    $amount = $response['amount'];
    $productInfo = $response['productinfo'];
    $firstname = $response['firstname'];
    $email = $response['email'];
    $salt = get_option('salt');
    $resp_hash = $response['hash'];
    $keyString = $key . '|' . $txnid . '|' . $amount . '|' . $productInfo . '|' . $firstname . '|' . $email . '||||||||||';
    $keyArray = explode("|", $keyString);
    $reverseKeyArray = array_reverse($keyArray);
    $reverseKeyString = implode("|", $reverseKeyArray);
    $saltString = $salt . '|' . $response['status'] . '|' . $reverseKeyString;
    $sentHashString = strtolower(hash('sha512', $saltString));
    $responseHashString = $resp_hash;
    if ($status == 'success' && $responseHashString==$sentHashString) {
      //redirect to  transaction page and store in DB as a order with accepted payment
      $wpdb->query("UPDATE `" . WPSC_TABLE_PURCHASE_LOGS . "` SET 

										`processed` = '2', 

										`transactid` = '" . $response['txnid'] . "', 

										`date` = '" . time() . "'

									WHERE `sessionid` = " . $txnid . " LIMIT 1");
      transaction_results($txnid, false, $response['txnid']);
	  
      header("Location:" . get_option('transact_url') . "&sessionid=" . $response['txnid']);
      exit();
    } else {
      //Failed- Delete the details corresponding to the session id 
      $log_id = $wpdb->get_var("SELECT `id` FROM `" . WPSC_TABLE_PURCHASE_LOGS . "` WHERE `sessionid`='$sessionid' LIMIT 1");
      $delete_log_form_sql = "SELECT * FROM `" . WPSC_TABLE_CART_CONTENTS . "` WHERE `purchaseid`='$log_id'";
      $cart_content = $wpdb->get_results($delete_log_form_sql, ARRAY_A);
      foreach ((array) $cart_content as $cart_item) {
        $cart_item_variations = $wpdb->query("DELETE FROM `" . WPSC_TABLE_CART_ITEM_VARIATIONS . "` WHERE `cart_id` = '" . $cart_item['id'] . "'", ARRAY_A);
      }
      $wpdb->query("DELETE FROM `" . WPSC_TABLE_CART_CONTENTS . "` WHERE `purchaseid`='$log_id'");
      $wpdb->query("DELETE FROM `" . WPSC_TABLE_SUBMITED_FORM_DATA . "` WHERE `log_id` IN ('$log_id')");
      $wpdb->query("DELETE FROM `" . WPSC_TABLE_PURCHASE_LOGS . "` WHERE `id`='$log_id' LIMIT 1");
	  
      header("Location:" . get_option('checkout_url') . "&sessionid=" . $response['txnid']);
      exit();
    }
  }
}
function submit_PayU() {
  if ($_POST['key'] != null) {
    update_option('key', $_POST['key']);
  }
  if ($_POST['PayU_Mode'] != null) {
    update_option('PayU_Mode', $_POST['PayU_Mode'] == 'on' ? 1 : 0);
  }
  if ($_POST['salt'] != null) {
    update_option('salt', $_POST['salt']);
  }
  return true;
}
function form_PayU() {
  $PayU_Mode = get_option('PayU_Mode');
  switch ($PayU_Mode) {
    case 1:
      $PayU_TEST = "checked ='checked'";
      break;
  }
  $output = "

		<tr>

			<td>Account ID</td>

			<td><input type='text' size='40' value='" . get_option('key') . "' name='key' /></td>

		</tr>

		<tr>

			<td>&nbsp;</td>

			<td><small>PayU Merchant Account ID is a Unique Id given by PayU to Merchant</small></td>

		</tr>

						

		

		<tr>

			<td>Secret Key</td>

			<td><input type='text' size='40' value='" . get_option('salt') . "' name='salt' /></td>

		</tr>

		<tr>

			<td>&nbsp;</td>

			<td><small>A secret key generated by PayU is a complex value that uniquely identifies a merchantâ€™s payment gateway account. It is similar to an account password. Secret keys are used to authenticate requests submitted to PayU, and can be obtained in the Merchant Interface.



</small></td>

		</tr>

		<tr>

			<td>Test Mode</td>

			<td>

				<input type='checkbox' name='PayU_Mode' id='PayU_Mode' " . $PayU_TEST . " />  &nbsp;



			</td>

		</tr>



		<tr>

			<td>&nbsp;</td>

			<td><small>Please choose TEST mode.It is mandatory to check the payment gateway Integration in TEST </small></td>

		</tr>		
	";

  return $output;
}

add_action('init', 'nzshpcrt_PayU_callback');
?>
