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
			<h2 align="center">Laporan Data Lowongan Pekerjaan</h2>
			<h5 style="margin: 0 0 5px 0;">Result : {{ \Carbon\Carbon::parse($tanggal_awal)->format('d-m-Y') }} - {{ \Carbon\Carbon::parse($tanggal_akhir)->format('d-m-Y') }}</h5>

			<table border="1" width="100%">
				<thead>
					<tr>
						<th scope="col" style="padding: 10px 0 10px 0;">Perusahaan</th>
						<th scope="col">Nama Lowongan</th>
						<th scope="col">Kategori</th>
						<th scope="col">Tanggal Upload</th>
					</tr>
				</thead>
				<tbody>
				@foreach($lowongan as $data)
					<tr align="center">
						<td style="padding: 5px 0 5px 0;">{{ $data->perusahaan }}</td>
						<td>{{ $data->nama }}</td>
						<td>{{ $data->kategori }}</td>
						<td>{{ \Carbon\Carbon::parse($data->upload)->format('d-m-Y') }}</td>
					</tr>
				@endforeach
				@foreach($total as $ttl)
					<tr>
						<th colspan="3" style="padding: 10px 0 10px 0;">Total</th>
						<td align="center">{{ $ttl->total }}</td>
					</tr>
					@endforeach
				</tbody>
			</table><br>
			</div>
		</div>
	</div>
</body>
</html>