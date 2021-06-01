<?php
    // session start
    if(!empty($_SESSION)){ }else{ session_start(); }
    require '../proses/panggil.php';
    include_once '../conf.php';
    $db = $con->TugasAkhir;
    $collection = $db->informasiperangkat;
    $collectionData = $db->dataperangkat;
    $id = $_GET['id'];
    $filter = ['id' => $id];
    $options = [];
    $datas=$collection->findOne($filter,$options);
    $key = $datas;
?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Tutorial Membuat CRUD PHP OOP dengan PDO MySQL</title>
		<!-- BOOTSTRAP 4-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
        <!-- DATATABLES BS 4-->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- jQuery -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
        <!-- DATATABLES BS 4-->
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <!-- BOOTSTRAP 4-->
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

	</head>
    <body style="background:#586df5;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">

                    <?php if(!empty($_SESSION['ADMIN'])){?>
                    <br/>
                    <span style="color:#fff";>Selamat Datang, <?php echo $sesi['username'];?></span>
                    <a href="../logout.php" class="btn btn-danger btn-md float-right"><span class="fa fa-sign-out"></span> Logout</a>
                    <br/><br/>
                    <a href="../tambah.php" class="btn btn-success btn-md"><span class="fa fa-plus"></span> Tambah</a>
                    <br/><br/>
                    <div class="card">
                        <div class="card-header">
                            <p><h4 class="card-title">Nama Agent :<?php echo $datas->agent; ?></h4></p>
                            <p></p>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover table-bordered" id="mytable1" style="margin-top: 10px">
                                <thead>
                                    <tr>
                                        <th width="50px">No</th>
                                        <th>ID</th>
                                        <th width="250px">Nama Sistem Hidoponik</th>
                                        <th>IP Address</th>
                                        <th width="250px">Jumlah Pin dan Aktuator</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php $db = $con->TugasAkhir;
                                    $collection = $db->informasiperangkat;

                                    $filter = ['id' => $id];
                                    $options = ['sort' => ['agent' => 1]];
                                    $datas=$collection->find($filter,$options);
                                    $num=1;
                                    foreach ($datas as $key ) {
                                      echo "<tr>";
                                      echo "<td>".$num."</td>";
                                      echo "<td>".$key->id."</td>";
                                      echo "<td><a href='show.php?id=".$key->id."'>".$key->agent."</a></td>";
                                      echo "<td>".$key->agent_ip."</td>";
                                      echo "<td>".count($key->sensor_pin)." Sensor | ".count($key->actuator_pin)."Actuator</td>";
                                      echo "<td> <a href= 'proses/crud.php?hapus=true&id=".$key->id."' >hapus</a></td>";
                                      echo "</tr>";
                                      $num+=1;
                                    }
                                   ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>

                    <?php }else{?>
                        <br/>
                        <center>
                        <div class="alert alert-info">
                            <h3> IoT Monitoring Control System</h3>
                            <hr/>
                            <p><a href="../login.php">Login Disini</a></p>
                        </div>
                        </center>
                    <?php }?>
			    </div>
			</div>
		</div>
        <script>
            $('#mytable').dataTable();

                $('#mytable1').dataTable();
        </script>
	</body>
</html>