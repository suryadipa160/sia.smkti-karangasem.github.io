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
			<h2 align="center">Laporan Data Lamaran</h2>
			<h5 style="margin: 0 0 5px 0;">Result : {{ \Carbon\Carbon::parse($tanggal_awal)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d-m-Y') }}</h5>
			
			<table border="1" width="100%">
				<thead>
					<tr>
						<th scope="col" style="padding: 10px 5px 10px 5px;">Nama Alumni</th>
						<th scope="col" style="width: 80px;">Lulusan</th>
						<th scope="col">Lowongan</th>
						<th scope="col">Perusahaan</th>
						<th scope="col" style="padding: 10px 5px 10px 5px;">Tanggal Upload</th>
					</tr>
				</thead>
				<tbody>
					@foreach($lamaran as $data)
					<tr align="center">
						<td style="padding: 10px 5px 10px 5px;">{{ $data->alumni }}</td>
						<td>{{ $data->lulusan }}</td>
						<td>{{ $data->lowongan }}</td>
						<td>{{ $data->perusahaan }}</td>
						<td>{{ \Carbon\Carbon::parse($data->upload)->format('d-m-Y') }}</td>
					</tr>
					@endforeach
				</tbody>
			</table><br><br>

			<table border="1" width="30%" align="left">
				<tr>
					<th colspan="2" style="padding: 10px 0 10px 0;">Alumni</th>
				</tr>
				<thead>
					<tr>
						<th scope="col" style="padding: 10px 0 10px 0;">Nama</th>
						<th scope="col">Lulusan</th>
					</tr>
				</thead>
				<tbody>
				@foreach($alumni as $alu)
					<tr align="center">
						<td style="padding: 5px 0 5px 0;">{{ $alu->alumni }}</td>
						<td>{{ $alu->lulusan }}</td>
					</tr>
				@endforeach
					<tr>
						<th colspan="1" style="padding: 10px 0 10px 0;">Total</th>
						<td align="center">{{ $t_alumni }}</td>
					</tr>
				</tbody>
			</table>

			<table border="1" width="40%" align="right">
				<tr>
					<th colspan="2" style="padding: 10px 0 10px 0;">Lowongan</th>
				</tr>
				<thead>
					<tr>
						<th scope="col" style="padding: 10px 0 10px 0;">Nama Lowongan</th>
						<th scope="col">Perusahaan</th>
					</tr>
				</thead>
				<tbody>
				@foreach($lowongan as $lowo)
					<tr align="center">
						<td style="padding: 5px 0 5px 0;">{{ $lowo->lowongan }}</td>
						<td>{{ $lowo->perusahaan }}</td>
					</tr>
				@endforeach
					<tr>
						<th colspan="1" style="padding: 10px 0 10px 0;">Total</th>
						<td align="center">{{ $t_lowongan }}</td>
					</tr>
				</tbody>
			</table><br>
			</div>
		</div>
	</div>
</body>
</html>