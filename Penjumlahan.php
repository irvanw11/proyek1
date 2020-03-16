<?php
$koneksi = mysqli_connect("localhost","root","","perhitungan"); 
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Perhitungan</title>
</head>
<body>

<form method="post" action="">
Nilai A<br>
<input type="number" name="a"><br>
Nilai B<br>
<input type="number" name="b"><br><br>
<button type="submit" name="Hitung">Hitung</button>
<br><br>
<?php

if (isset($_POST['Hitung'])) {
    $a             = $_POST['a'];
    $b              = $_POST['b'];
    $c              = $a+$b;
    echo $c;

if ($c >= 0 && $c <= 25) {
	$ket = "D";
}
elseif ($c >= 25 && $c <= 50) {
	$ket = "C";
}
elseif ($c >= 51 && $c <= 75) {
	$ket = "B";
}
elseif ($c >= 76 && $c <= 100) {
	$ket = "A";
}
echo $ket;

for ($i=1; $i < 10; $i++) { 
	$a = $b;
	$c = $a+$b;
	$b = $c;

if ($c >= 0 && $c <= 25) {
	$ket = "D";
}
elseif ($c >= 25 && $c <= 50) {
	$ket = "C";
}
elseif ($c >= 51 && $c <= 75) {
	$ket = "B";
}
elseif ($c >= 76 && $c <= 100) {
	$ket = "A";
}
echo $c;
}

$sql = mysqli_query($koneksi, "INSERT INTO penjumlahan VALUES('','$a', '$b', '$c','$ket')") or die(mysqli_error($koneksi));
}

?>
<br><br><br>
<table border="2">
	<tr>
		<th>No.</th>
		<th>Nilai A</th>
		<th>Nilai B</th>
		<th>Hasil</th>
		<th>Keterangan</th>
	</tr>
</tbody>

	<?php
		$sql = mysqli_query($koneksi, "SELECT * FROM penjumlahan");
		if(mysqli_num_rows($sql) > 0){
			$id = 1;
			while($data = mysqli_fetch_assoc($sql)){
				echo '
				<tr>
				<td>'.$data['id'].'</td>
				<td>'.$data['a'].'</td>
				<td>'.$data['b'].'</td>
				<td>'.$data['c'].'</td>
				<td>'.$data['ket'].'</td>
				
				</tr>
				';

				$id++;
				}
				//jika query menghasilkan nilai 0
				}else{
				echo '
				<tr>
				<td colspan="5">Tidak ada data.</td>
				</tr>
				';
				}
		?>

</form>
</body>
</html>