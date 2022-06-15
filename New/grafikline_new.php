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
                    label: 'New Cases',
                    data: <?php echo json_encode($newcases); ?>,
                    backgroundColor: 'rgba(30, 233, 255, 0.75)',
                    borderWidth: 1
                },
                {
                    label: 'New Death',
                    data: <?php echo json_encode($newdeaths); ?>,
                    backgroundColor: 'rgba(255, 240, 0, 0.75)',
                    borderWidth: 1
                },
                {
                    label: 'New Recovered',
                    data: <?php echo json_encode($newrecovered); ?>,
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