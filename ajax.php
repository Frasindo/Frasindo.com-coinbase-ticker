<?php
require("./vendor/autoload.php");
use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;

$configuration = Configuration::apiKey("pwXvjJViEfzX47Ix", "Jpz87vMLPKi7EeGx9xIhLRNBHHBQclkw");
$client = Client::create($configuration);
$btc = $client->getExchangeRates("BTC");
//print_r($btc);
?>
<?php
$d = '~rate.txt';
$exist = file_exists($d);
if($exist)
{
    $dp = file_get_contents($d);
    $pd = explode(",",$dp);  
}else{
    fopen($d, "w");
}
?>
<?php 
if($pd[0] > $btc["rates"]["USD"])
{
    $icon_dollar = "fa fa-caret-up up";
}elseif($pd[0] == $btc["rates"]["USD"])
{
    $icon_dollar = "fa fa-minus";
}elseif($pd[0] < $btc["rates"]["USD"]){
    $icon_dollar = "fa fa-caret-down down";
}
if($pd[1] > $btc["rates"]["IDR"])
{
    $icon_idr = "fa fa-caret-up up";
}elseif($pd[1] == $btc["rates"]["IDR"])
{
    $icon_idr = "fa fa-minus";
}elseif($pd[1] < $btc["rates"]["IDR"]){
    $icon_idr = "fa fa-caret-down down";
}
$json = json_encode(array("IDR"=>array("icon"=>$icon_idr,"value"=>$btc["rates"]["IDR"]),"USD"=>array("icon"=>$icon_dollar,"value"=>$btc["rates"]["USD"])));
echo $json;
?>
<?php
$file = '~rate.txt';
$current = $btc["rates"]["USD"].",".$btc["rates"]["IDR"];
file_put_contents($file, $current);
?>