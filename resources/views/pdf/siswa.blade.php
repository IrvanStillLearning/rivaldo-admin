<html>
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<style>
			@page {
				margin: 8px 40px;
			}
	
			* {
				font-family: Arial, Helvetica, sans-serif;
			}
			
			body{
				/* background-image: url("{{ asset('assets/img/project/background.png') }}");
				background-position: center;
				background-repeat: no-repeat;
				background-size: 50%; */
				width:100%;
				height:90%;
				padding: 10px 0px 10px 0px;
				margin:0;
			}
	
			p, label {
				font-size: 12px;
			}
	
			.table{
				font-size: 12px;
				text-align: justify;
			}
	
			.table th{
				padding: 2px 0px 2px 0px;
				line-height: 1.5;
				font-size: 12px;
			}
	
			.table td{
				padding: 1px 4px;
				line-height: 1.5;
				font-size: 12px;
				color: white;
			}
		</style>
	</head>	

	<body>
		<div id="tb" style="width: 90%; margin: 30px auto; background-color: #3b7cb2">
			<span style="margin-bottom: 20px"></span>
			<img src="{{ public_path('assets\img\project\logo-senopati.png') }}" width="50px" alt="" style="position: absolute; margin-left: 30px; margin-top: 15px">
			<h3 style="text-align: center; color: white; margin-top: 20px">KARTU PELAJAR<br>SMK SENOPATI</h3>
			<hr style="border: 2px solid white; margin: auto">
			<div style="padding: 20px 25px;">
				<table class="table" width="100%" style="border-collapse: collapse; margin-bottom: 30px" cellpadding="2">
					<tr>
						<td>
							<table class="table" width="80%" style="border-collapse: collapse;" cellpadding="2">
								<tr>
									<td style="font-size: 13px; vertical-align:middle">NIK</td>
									<td style="font-size: 13px; vertical-align:middle; width: 15px; text-align: center">:</td>
									<td style="font-size: 13px; vertical-align:middle;">{{ $siswa->nik }}</td>
								</tr>
								<tr>
									<td style="font-size: 13px; vertical-align:middle">Nama</td>
									<td style="font-size: 13px; vertical-align:middle; width: 15px; text-align: center">:</td>
									<td style="font-size: 13px; vertical-align:middle;">{{ $siswa->nama }}</td>
								</tr>
								<tr>
									<td style="font-size: 13px; vertical-align:middle">Jurusan</td>
									<td style="font-size: 13px; vertical-align:middle; width: 15px; text-align: center">:</td>
									<td style="font-size: 13px; vertical-align:middle;">{{ $siswa->jurusan }}</td>
								</tr>
								<tr>
									<td style="font-size: 13px; vertical-align:middle; white-space: nowrap">Asal Sekolah</td>
									<td style="font-size: 13px; vertical-align:middle; width: 15px; text-align: center">:</td>
									<td style="font-size: 13px; vertical-align:middle;">{{ $siswa->asal_sekolah }}</td>
								</tr>
								<tr>
									<td style="font-size: 13px; vertical-align:middle">Lahir</td>
									<td style="font-size: 13px; vertical-align:middle; width: 15px; text-align: center">:</td>
									<td style="font-size: 13px; vertical-align:middle;">{{ $siswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($siswa->tanggal_lahir)->format('d/m/Y')}}</td>
								</tr>
								<tr>
									<td style="font-size: 13px; vertical-align:middle">Alamat</td>
									<td style="font-size: 13px; vertical-align:middle; width: 15px; text-align: center">:</td>
									<td style="font-size: 13px; vertical-align:middle;">{{ $siswa->alamat }}</td>
								</tr>
							</table>
						</td>
						<td>
							<img src="{{ public_path($siswa->foto) }}" width="120px" alt="" srcset="">
						</td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>
