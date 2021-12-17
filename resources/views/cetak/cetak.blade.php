<!DOCTYPE html>
<html>
<head>
	<title>SIA | Cetak Laporan</title>
	<style type="text/css">
		table{
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<div class="container">
		<div>
			<div>
			<h3 align="center" style="margin: 0;">Sistem Informasi Alumni</h3>
			<h2 align="center" style="margin: 0;">SMK TI Bali Global Karangasem</h2>	
			<p style="text-align: center; margin: 0;">Jln. Untung Surapati No. 99 Amlapura, Subagan, Kec. Karangasem, Kab. Karang Asem Prov. Bali</p><hr>
			<h2 align="center">Laporan Data Alumni</h2>
			<div style="margin-right: -15px; margin-left: -15px;">
			<table border="1" width="70%" align="center">
				<thead>
					<tr>
						<th scope="col" style="width: 80px; padding: 10px 5px 10px 5px;">NIS</th>
						<th scope="col" style="padding: 10px 5px 10px 5px;">Nama</th>
						<th scope="col" style="width: 200px;">Jurusan</th>
						<th scope="col" style="width: 100px;">Lulusan</th>
						<th scope="col" style="width: 100px;">Status</th>
					</tr>
				</thead>
				@foreach($alumni as $alu)
				<tbody>
					<tr align="center">
						<td style="padding: 10px 5px 10px 5px;">{{ $alu->nis }}</td>
						<td>{{ $alu->nama }}</td>
						<td>{{ $alu->jurusan }}</td>
						<td>{{ $alu->lulusan }}</td>
						<td>{{ $alu->status }}</td>
					</tr>
				</tbody>
				@endforeach
			</table>
			</div>
			</div>
		</div>
	</div>
</body>
</html>