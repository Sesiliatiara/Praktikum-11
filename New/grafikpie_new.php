<?php
include('koneksicovid.php');
$negara = mysqli_query($koneksi,"select * from tb_country");
while($row = mysqli_fetch_array($negara)){
	$nama_negara    [] = $row['country'];
	
	$query = mysqli_query($koneksi,"SELECT new_cases, new_deaths, new_recovered FROM tb_new WHERE id_country='".$row['id_country']."'");
	$row = $query->fetch_array();
	$newcases[] = $row['new_cases'];
    $newdeaths[] = $row['new_deaths'];
    $newrecovered[] = $row['new_recovered'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Membuat Grafik Pie Menggunakan Chart JS</title>
	<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
	<div style="width: 1000px;height: 1000px">
		<canvas id="BarChart"></canvas>
	</div>


	<script>
		var ctx = document.getElementById("BarChart").getContext('2d');
		var BarChart = new Chart(ctx, {
			type: 'pie',
			data: {
				labels: <?php echo json_encode($nama_negara); ?>,
                datasets: [{
                    label: 'New Cases',
                    data: <?php echo json_encode($newcases); ?>,
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
                    label: 'New Death',
                    data: <?php echo json_encode($newdeaths); ?>,
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
                    label: 'New Recovered',
                    data: <?php echo json_encode($newrecovered); ?>,
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