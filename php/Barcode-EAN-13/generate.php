<?php

include "./barcode.php";

if (empty($argv[1]) || empty($argv[2])){
    die('请输入正确的参数再运行 php generate.php [需要生成的开始 12位数字] [生成数量]');
}
empty($argv[3]) ? $scale = 4 : $scale = (int) $argv[3];
empty($argv[4]) ? $font = __DIR__.DIRECTORY_SEPARATOR."FreeSansBold.ttf" : $font = (string) $argv[4];

$start = $argv[1];//生成条码的开始
$count = $argv[2];//要生成条码的数量，增加的数量

$codes = range($start,$start + $count);

$dir = __DIR__.DIRECTORY_SEPARATOR.'export'.DIRECTORY_SEPARATOR.date('Y-m-d');

if (!is_dir($dir)){
    mkdir($dir,0777,true);
}

foreach ($codes as $code)
{
    $barcode = new Barcode($code, 8,  $font);
    $barcode->save($dir.DIRECTORY_SEPARATOR.$code.".png");
}