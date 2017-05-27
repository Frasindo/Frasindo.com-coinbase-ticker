<?php
require("vendor/autoload.php");
use Coinbase\Wallet\Client;
use Coinbase\Wallet\Configuration;

$configuration = Configuration::apiKey("", "");
$client = Client::create($configuration);
$btc = $client->getExchangeRates("BTC");
print_r($btc);
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
<!DOCTYPE html>
<html>
<head>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li section {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li section:hover:not(.active) {
    background-color: #111;
}
.up {
    color: #709A31;
}
.down{
    color: #DE5F66;
}
    
</style>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<?php 
if($pd[0] > $btc["rates"]["USD"])
{
    $icon_dollar = "fa fa-caret-up up";
}elseif($pd[0] == $btc["rates"]["USD"])
{
    $icon_dollar = "fa fa-minus";
}else{
    $icon_dollar = "fa fa-caret-down down";
}
?>
<?php 
if($pd[1] > $btc["rates"]["IDR"])
{
    $icon_idr = "fa fa-caret-up up";
}elseif($pd[1] == $btc["rates"]["IDR"])
{
    $icon_idr = "fa fa-minus";
}else{
    $icon_idr = "fa fa-caret-down down";
}
?>
<ul>
    <li><section><span class="<?= (isset($icon_dollar))?$icon_dollar:"fa fa-minus" ?>"></span><p><b>BTC/USD</b></p><p>$ <?= number_format($btc["rates"]["USD"]) ?></p></section></li>
    <li><section><span class="<?= (isset($icon_idr))?$icon_idr:"fa fa-minus" ?>"></span><p><b>BTC/IDR</b></p><p>Rp. <?= number_format($btc["rates"]["IDR"]) ?></p></section></li>
</ul>

</body>
</html>
<?php
$file = '~rate.txt';
$current = $btc["rates"]["USD"].",".$btc["rates"]["IDR"];
file_put_contents($file, $current);
?>