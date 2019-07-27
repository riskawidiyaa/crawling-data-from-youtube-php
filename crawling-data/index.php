<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Crawling Data From Youtube</title>
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="assets/css/styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
	<!--/.navbar-->
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Riska</span> Widiya</a>
			</div>
		</div>
	</nav>
	<!--/.end-of-navbar-->
	<!--/.main-->	
	<div class="main">

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="large">
							<p align="center" class="sp">Let's see how <span>it works</span></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-body easypiechart-panel">
							<h4>Pengguna</h4>
							<?php
							$conn = new mysqli("localhost", "root", "", "db_yutub");
							if ($conn->connect_errno) {
								echo "Failed to connect to MySQL: " . $conn->connect_error;
							}
							$res = $conn->query("SELECT COUNT(id) FROM livedata_komentar");
							while($row = $res->fetch_assoc()){
							?>
							<div class="easypiechart" id="easypiechart-orange" data-percent="100" ><span class="percent"><?php echo $row['COUNT(id)']; ?></span></div>
							<?php 
								}
							?>
						</div>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="panel panel-default">
						<div class="panel-body easypiechart-panel">
							<h4>Jumlah Komentar</h4>
							<?php
							$conn = new mysqli("localhost", "root", "", "db_yutub");
							if ($conn->connect_errno) {
								echo "Failed to connect to MySQL: " . $conn->connect_error;
							}
							$res = $conn->query("SELECT COUNT(komentar) FROM livedata_komentar");
							while($row = $res->fetch_assoc()){
							?>
							<div class="easypiechart" id="easypiechart-blue" data-percent="100" ><span class="percent" style="color:#30a5ff;"><?php echo $row['COUNT(komentar)']; ?></span></div>
							<?php 
								}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
            <div class="col-sm-2">
                <!-- blank -->
            </div>
			<div class="col-sm-8">
				<div class="panel panel-default">
					<div class="panel-body">
                        <br><br>
                        <form class="form-horizontal" method="post" action="crawling.php">
                            <div class="form-group">
                              <label class="control-label col-sm-2">URL YOUTUBE</label>
                                <div class="col-sm-8">
      								<input type="text" name="inputkuy" class="form-control" placeholder="For Example: https://youtube.com/1Ha618jO9Yxx">
                                </div>
                                <div class="col-sm-2">
									<button type="submit" name="submit" class="btn btn-warning">CRAWLING</button>
                                </div>
                            </div>
                        </form>
						<br>
						<form>
							<div class="form-group">
								<div class="col-sm-6"></div>
								<div class="col-sm-6">
									<a align="center" class="fa fa-refresh" href="<?php $_SERVER['PHP_SELF']; ?>"></a>
								</div>
							</div>
						</form>
					</div>
				</div>
            </div>
            <div class="col-sm-2">
                <!-- blank -->
            </div>
            
        <div class="row">
			<div class="col-sm-12">
				<div class="panel panel-default">
					<div class="panel-body">    
                    <br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th align="center">No.</th>
                                    <th align="center">Nama Pengguna</th>
                                    <th align="center">Waktu</th>
                                    <th align="center">Komentar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    include 'koneksi.php';
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * from livedata_komentar");
                                    foreach ($data as $row) {
                                        echo "<tr>
                                                <td>".$no."</td>
                                                <td>".$row['nama_user']."</td>
                                                <td>".$row['timepublish']."</td>
                                                <td>".$row['komentar']."</td>
                                            </tr>";
                                            $no++;
                                    }
                                ?>
                            </tbody>
                        </table><br>
                    </div>
                </div>
            </div> 
        </div>

		<div class="row">
			<div class="col-sm-2">
				<!-- blank -->
			</div>
			<div class="col-sm-8">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="col-sm-4">
							<!-- blank -->
						</div>
						<?php
							if(isset($_GET['submit']))
							{
								include 'koneksi.php';
								$sql = mysqli_query($koneksi, "TRUNCATE TABLE livedata_komentar");
								mysqli_query($koneksi, $sql); 
							}
						?>
						<form class="col-sm-4">
							<input type="submit" name="submit" class="button btn btn-warning" value="Try Again With Another Data?">
						</form>
						<div class="col-sm-4">
							<!-- blank -->
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-2">
				<!-- blank -->
			</div>
		</div>

	</div>	<!--/.end-of-main-->
	
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/easypiechart.js"></script>
	<script src="assets/js/easypiechart-data.js"></script>
	<script src="assets/js/custom.js"></script>
		
</body>
</html>