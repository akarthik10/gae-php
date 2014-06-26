<?php


import com.google.appengine.api.datastore;
import com.google.appengine.api.datastore.Entity;
import com.google.appengine.api.datastore.Query;
import com.google.appengine.api.datastore.DatastoreServiceFactory;


$num = $_REQUEST['myvar'];
$num=$num+3;

$entity = new Entity("ptest-v1"); 
$entity->setProperty($_REQUEST['name'],$num);
$dataService = DatastoreServiceFactory::getDatastoreService();
$dataService->put($entity);


$q = new Query('ptest-v1');
$q->addFilter('name','EQUAL' ,$_REQUEST['name']);
$dataService = DatastoreServiceFactory::getDatastoreService();
$prepared = $dataService->prepare($q);
foreach($prepared->asIterable() as $i) {
echo $field1 = $i->getProperty('name');

}
echo $num;


?>