<?php
function get_yahoo_finance_curl_request(  $url, $params ){

        $curl = curl_init();
       
        $send_url = $url."?".http_build_query( $params );
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $send_url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: apidojo-yahoo-finance-v1.p.rapidapi.com",
            "x-rapidapi-key: 192881900fmsh83b21139b9eda59p108ca9jsnefb28bb236fa"
          ),
        ));

        $response = curl_exec($curl);
        
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {

          // echo "cURL Error #:" . $err;
        return array('error' => $err);
        } else {
          return json_decode($response);
        }
}
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST']; 

 

$interval = "1d";
$symbol = trim( $_REQUEST['symbol'] ); 
$range =  trim( $_REQUEST['range'] );
if(isset( $_REQUEST['interval']) && ( trim(  $_REQUEST['interval'] ) != '' ) ){
            $interval =  trim(  $_REQUEST['interval']) ;
        }else{
            $interval = "1d" ;
 }
 $params = array("region" => "US",
            "lang" => "en",
            "symbol" => $symbol,
            "interval" => $interval,
            "range" => $range
        );
 $url = 'https://apidojo-yahoo-finance-v1.p.rapidapi.com/stock/v2/get-chart';
 $APPPATH = dirname(__FILE__);
 // Create CSV file  //
$chartCSVFile = $APPPATH.'/chartCSV_'.trim( $symbol ).'_'.trim( $range ).'_'.trim( $interval ).'.csv';
 
$chart_csv_file_url = $link.'/tradeapi/chartCSV_'.trim( $symbol ).'_'.trim( $range ).'_'.trim( $interval ).'.csv';
$myCsvFile = fopen($chartCSVFile, "w");
// save the column headers
fputcsv( $myCsvFile, array('Date', 'Open', 'High', 'Low', 'Close', 'Adj Close', 'Volume'));
$output_data_tt = get_yahoo_finance_curl_request( $url, $params  );
$csv_data_array = array();
 
 
if( isset($output_data_tt->chart->result[0]->timestamp)){
    $timZone = $output_data_tt->chart->result[0]->meta->exchangeTimezoneName;
	    date_default_timezone_set($timZone);
		foreach ( $output_data_tt->chart->result[0]->timestamp as $key => $val_data ) {
			$temp = array();
			array_push( $temp,  date("Y-m-d",$val_data) ); // timestap
			array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->open[$key] ); // open
			array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->high[$key] ); // high
			array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->low[$key] ); // low
			array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->close[$key] ); // close
			if( isset( $output_data_tt->chart->result[0]->indicators->adjclose[0]->adjclose ) ){
            array_push( $temp, $output_data_tt->chart->result[0]->indicators->adjclose[0]->adjclose[$key] ); //Adj Close
        }else{
            array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->close[$key] ); //Adj Close

        }
			
			array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->volume[$key] ); // volume
			array_push( $csv_data_array , $temp);
		  
		}

		// save each row of the data
    foreach ($csv_data_array as $row)
    {
    fputcsv($myCsvFile, $row);
    }
    // Close the file
    fclose($myCsvFile);

}
 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1 minimum-scale=1 user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trade Chart</title>
</head>
<link rel="stylesheet" href="stylesheet.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<style>
body{
    margin: 0 !important;
}
</style>
<body>
    <!-- <script src="https://d3js.org/d3.v5.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script> -->
    <script src="d3.v5.min.js"></script>
    <script type="text/javascript" src="lodash.min.js"></script>
     <script type="text/javascript">var chart_file_path = "<?php echo $chart_csv_file_url;?>"</script>

    <script src="script.js"></script>
    <svg id="container"></svg>
    
</body>
</html>
