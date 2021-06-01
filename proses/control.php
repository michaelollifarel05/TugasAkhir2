<?php
  if(!empty($_SESSION)){ }else{ session_start(); }
  require 'panggil.php';
  include_once '../conf.php';
  $db = $con->TugasAkhir;
  $collection = $db->informasiperangkat;
  $collectionData = $db->dataperangkat;
  $id = $_GET['id'];
  $command = $_GET['command'];
  $pin = $_GET['pin'];
  $ip= $_GET['ip'];
  $index = $_GET['index'];
  $filter = ['id' => $id , 'agent_ip' => $ip];
  if ($command == "Mati") {
    $options = ['$set' => ['status.'.$index => 'mati']];
  }elseif ($command == "Hidup") {
    $options = ['$set' => ['status.'.$index => 'hidup']];
  }
  $datas=$collection->updateOne($filter,$options);
  echo $ip;
  if ($command == "Mati") {
    echo "death";
  }else {
    echo "alive";
  }
 ?>
