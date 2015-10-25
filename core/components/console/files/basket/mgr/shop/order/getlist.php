<?php 
/*
    Выводим данные заказов для страницы управления заказами
*/
print '<pre>';
ini_set('display_errors', 1);
$modx->switchContext('web');
$modx->setLogLevel(3);
$modx->setLogTarget('HTML');
 
$namespace = 'basket';        // Неймспейс комопонента

$params = array(  
    "json"  => false,
    // "order_id"  => 1,    // ID конкретного заказа
);

if(!$response = $modx->runProcessor('mgr/shop/order/getlist',
$params
, array(
'processors_path' => $modx->getObject('modNamespace', $namespace)->getCorePath().'processors/',
))){
print "Не удалось выполнить процессор";
return;
}
 
$memory = round(memory_get_usage(true)/1024/1024, 4).' Mb';
print "<div>Memory: {$memory}</div>";
$totalTime= (microtime(true) - $modx->startTime);
$queryTime= $modx->queryTime;
$queryTime= sprintf("%2.4f s", $queryTime);
$queries= isset ($modx->executedQueries) ? $modx->executedQueries : 0;
$totalTime= sprintf("%2.4f s", $totalTime);
$phpTime= $totalTime - $queryTime;
$phpTime= sprintf("%2.4f s", $phpTime);
print "<div>TotalTime: {$totalTime}</div>";

print_r($response->getResponse());

// $objects = $response->getObject();
// foreach($objects as $object){
// }