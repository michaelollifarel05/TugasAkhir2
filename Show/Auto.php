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
    $coun = count($key->actuator_pin);
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
            <!--         <span style="color:#fff";>Selamat Datang, <?php echo $sesi['username'];?></span> -->
                    <a href="../logout.php" class="btn btn-danger btn-md float-right"><span class="fa fa-sign-out"></span> Logout</a>
                    <!-- <br/><br/> -->
                    <a href="../" class="btn btn-success btn-md"><span class="fa fa-home"></span> Home</a>
                    <br/><br/>
                    <div class="card">
                        <div class="card-header">
                            <table >
                                <tr>
                                    <td>Nama Sistem </td>
                                    <td>:</td>
                                    <td><?php echo $key->agent; ?></td>
                                </tr>
                                <tr>
                                    <td>ID </td>
                                    <td>:</td>
                                    <td><?php echo $key->id; ?></td>
                                </tr>
                                <tr>
                                    <td>IP Sensor </td>
                                    <td>:</td>
                                    <td><?php echo $key->agent_ip; ?></td>
                                </tr>
                                <tr>
                                    <td>IP Controller </td>
                                    <td>:</td>
                                    <td><?php echo $key->controller_ip; ?></td>
                                </tr>

                            </table>

                            <p></p>
                        </div>
                        <div class="card-body">
                            <h4>Sensor</h4>
                            <hr>
                            <table class="table table-hover table-bordered" id="mytable1" style="margin-top: 10px">
                                <thead>
                                    <tr>
                                        <th width="50px">No</th>
                                        <!-- <th>ID</th> -->
                                        <th width="250px">Desc Sensor</th>
                                        <th>Pin Sensor</th>
                                        <th width="250px">Pin Aktuator</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
                                  // echo "$con";
                                    for ($a=0; $a < $coun ; $a++) { 
                                        echo "<tr>";
                                        echo "<td>".($a+1)."</td>";
                                        echo "<td>".$key->desc_sensor[$a]."</td>";
                                        echo "<td>".$key->sensor_pin[$a]."</td>";
                                        echo "<td>".$key->actuator_pin[$a]."</td>";
                                        echo "<td>".$key->status[$a]."</td>";
                                        if ($key->status[$a] == 'active') {
                                            echo "<td> <center> <a href='../deleterow.php?tipe=deact&job=deact&id=".$key->id."&row=".$a."'><button type='button' class='btn btn-danger'>Deactivate</button></a></center></td>";
                                        }else{
                                            echo "<td> <center> <a href='../deleterow.php?tipe=deact&job=activ&id=".$key->id."&row=".$a."'><button type='button' class='btn btn-success'>Activate</button></a></center></td>";
                                        }
                                        echo "</tr>";
                                    }

                                   ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="card">
                        <div class="card-header">
                            
                        </div>
                        <div class="card-body">

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
