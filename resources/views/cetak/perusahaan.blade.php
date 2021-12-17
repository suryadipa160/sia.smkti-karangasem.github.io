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
		<div class="row">
			<div class="col-md-12">
			<h3 align="center" style="margin: 0;">Sistem Informasi Alumni</h3>
			<h2 align="center" style="margin: 0;">SMK TI Bali Global Karangasem</h2>	
			<p style="text-align: center; margin: 0;">Jln. Untung Surapati No. 99 Amlapura, Subagan, Kec. Karangasem, Kab. Karang Asem Prov. Bali</p><hr>
			<h2 align="center">Laporan Data Perusahaan</h2>
			<table border="1" width="100%">
				<thead>
					<tr>
						<th scope="col" style="padding: 10px 5px 10px 5px;">Nama Perusahaan</th>
						<th scope="col" style="padding: 10px 5px 10px 5px;">Alamat</th>
						<th scope="col" style="">Website</th>
						<th scope="col">No Telepon</th>
						<th scope="col">Tgl Register</th>
					</tr>
				</thead>
				<tbody>
				@foreach($perusahaan as $data)
					<tr align="center">
						<td style="padding: 10px 5px 10px 5px;">{{ $data->nama }}</td>
						<td>{{ $data->alamat }}</td>
						<td>{{ $data->website }}</td>
						<td>{{ $data->no_telp }}</td>
						<td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}</td>
					</tr>
				@endforeach
					<tr>
						<th colspan="4" style="padding: 10px 5px 10px 5px;">Total Perusahaan</th>
						<td align="center">{{ $total }}</td>
					</tr>
				</tbody>
			</table>
			</div>
		</div>
	</div>
</body>
</html>