
$a = new Commands();
$a->addCommand((new Assync(function(){
    return \AnthraxisBR\FwAsync\Sum::sum(2,5);
})));
$a->boot();
