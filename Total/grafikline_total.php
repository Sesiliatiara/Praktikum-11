<?php
include('koneksicovid.php');
$negara = mysqli_query($koneksi,"select * from tb_country");
while($row = mysqli_fetch_array($negara)){
	$nama_negara    [] = $row['country'];
	
	$query = mysqli_query($koneksi,"SELECT total_cases, total_deaths, total_recovered FROM tb_total WHERE id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$totalcases[] = $row['total_cases'];
    $totaldeaths[] = $row['total_deaths'];
    $totalrecovered[] = $row['total_recovered'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Grafik Line Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 1000px;height: 1000px">
		<canvas id="myChart"></canvas>
	</div>


	<script>
		var ctx = document.getElementById("myChart").getContext('2d');
		var myChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode($nama_negara); ?>,
                datasets: [{
                    label: 'Total Cases',
                    data: <?php echo json_encode($totalcases); ?>,
                    backgroundColor: 'rgba(30, 233, 255, 0.75)',
                    borderWidth: 1
                },
                {
                    label: 'Total Death',
                    data: <?php echo json_encode($totaldeaths); ?>,
                    backgroundColor: 'rgba(255, 240, 0, 0.75)',
                    borderWidth: 1
                },
                {
                    label: 'Total Recovered',
                    data: <?php echo json_encode($totalrecovered); ?>,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderWidth: 1
                }]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero:true
						}
					}]
				}
			}
		});
	</script>
</body>
</html>