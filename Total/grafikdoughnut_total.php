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
	<title>Membuat Grafik Doughnut Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 1000px;height: 1000px">
		<canvas id="BarChart"></canvas>
	</div>


	<script>
		var ctx = document.getElementById("BarChart").getContext('2d');
		var BarChart = new Chart(ctx, {
			type: 'doughnut',
			data: {
				labels: <?php echo json_encode($nama_negara); ?>,
                datasets: [{
                    label: 'Total Cases',
                    data: <?php echo json_encode($totalcases); ?>,
                    backgroundColor: [
					'rgba(137, 31, 85, 1)',
					'rgba(248, 251, 0, 1)',
					'rgba(255, 99, 71, 1)',
                    'rgba(150, 300, 82, 1)',
                    'rgba( 165, 42, 42, 1)',
                    'rgba(0, 153, 14, 1)',
                    'rgba( 255, 0, 0, 1)',
                    'rgba(0, 180, 208, 1)',
                    'rgba(229, 15, 124, 1)',
                    'rgba(107, 23, 255, 1)'
					],
                    hoverOffset: 4
                },
                {
                    label: 'Total Death',
                    data: <?php echo json_encode($totaldeaths); ?>,
                    backgroundColor: [
					'rgba(137, 31, 85, 1)',
					'rgba(248, 251, 0, 1)',
					'rgba(255, 99, 71, 1)',
                    'rgba(150, 300, 82, 1)',
                    'rgba( 165, 42, 42, 1)',
                    'rgba(0, 153, 14, 1)',
                    'rgba(255, 0, 0, 1)',
                    'rgba(0, 180, 208, 1)',
                    'rgba(229, 15, 124, 1)',
                    'rgba(107, 23, 255, 1)'
					],
                    hoverOffset: 4
                },
                {
                    label: 'Total Recovered',
                    data: <?php echo json_encode($totalrecovered); ?>,
                    backgroundColor: [
					'rgba(137, 31, 85, 1)',
					'rgba(248, 251, 0, 1)',
					'rgba(255, 99, 71, 1)',
                    'rgba(150, 300, 82, 1)',
                    'rgba( 165, 42, 42, 1)',
                    'rgba(0, 153, 14, 1)',
                    'rgba( 255, 0, 0, 1)',
                    'rgba(0, 180, 208, 1)',
                    'rgba(229, 15, 124, 1)',
                    'rgba(107, 23, 255, 1)'
					],
                    hoverOffset: 4
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