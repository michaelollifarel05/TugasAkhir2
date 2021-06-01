<?php
require 'vendor/autoload.php';
$con = new MongoDB\Client("mongodb://localhost:27017");
$db = $con->TugasAkhir;
$collection = $db->informasiperangkat;
$id= $_GET['id'];
$row= $_GET['row'];
$filter = ['id' => $id];


$delSensorVal = $collection->updateMany( $filter, ['$unset' => ['sensor_pin.'.$row =>1]]);
$delSensorVal1 = $collection->updateMany( $filter, ['$unset' => ['sensor_value.'.$row =>1]]);
$delSensorVal2 = $collection->updateMany( $filter, ['$unset' => ['actuator_pin.'.$row =>1]]);
$delSensorVal2 = $collection->updateMany( $filter, ['$unset' => ['desc_sensor.'.$row =>1]]);

$final = $collection->updateMany($filter, ['$pull' => ['sensor_pin' => null]]);
$final1 = $collection->updateMany($filter, ['$pull' => ['sensor_value' => null]]);
$final2= $collection->updateMany($filter, ['$pull' => ['actuator_pin' => null]]);
$final3 = $collection->updateMany($filter, ['$pull' => ['desc_sensor' => null]]);
header('Location: http://localhost/TA/TA/edit.php?id='.$id);
 ?>

<!-- <?php
  require 'vendor/autoload.php';
  $con = new MongoDB\Client("mongodb://localhost:27017");
  $db = $con->jahaha;
  $collection = $db->emailDeliveryActive;
  $filter = ['id' => '121'];
  $datasaurus = $collection->updateMany( $filter,['$unset' => ['nama' => 1]]);
  // printf("sudah %d", $datasaurus->getMatchedCount());
 ?> -->
