<?php


include "../vendor/autoload.php";
$command= "php child.php 'C:32:\"Opis\Closure\SerializableClosure\":161:{a:5:{s:3:\"use\";a:0:{}s:8:\"function\";s:38:\"function(){
    echo \Sum::sum(2,5);
}\";s:5:\"scope\";N;s:4:\"this\";N;s:4:\"self\";s:32:\"000000002cce3386000000001021eabe\";}}' > /dev/null 2>&1 & echo $!;";

//$pid = exec($command, $output);

$a = 'C:32:"Opis\Closure\SerializableClosure":181:{a:5:{s:3:"use";a:0:{}s:8:"function";s:58:"function(){\n    echo \AnthraxisBR\FwAsync\Sum::sum(2,5);\n}";s:5:"scope";N;s:4:"this";N;s:4:"self";s:32:"000000000147a83e00000000353487e7";}}' ;

//$d = new \Opis\Closure\SerializableClosure($a);

$closure = unserialize($a);

echo $closure();
//var_dump(unserialize($a));


//var_dump($pid);
//var_dump($output);