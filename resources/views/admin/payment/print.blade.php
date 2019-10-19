<html>
<head>
  <title>Receipt</title>
  <style>
    @page { margin: 100px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px; height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .text-center { text-align:center; }
    .font-weight-bold { font-weight: bold; }
  </style>
</head>
<body>
  <header>
    <h2><center>SUBERI-APIT DENTAL CLINIC</center></h2>
    <center>Abarca Street, Mangagoy, Bislig City, Surigao del Sur</center>
    <center>DR. ELVIE ANGELIE A. SUBERI - Dentist</center>
    <hr>
  </header>
  {{-- <footer>footer on each page</footer> --}}
  <main>
  	<br>
  	<br>
		<h4>Received From : {{ $examination->patient->firstname }} {{ $examination->patient->middlename }} {{ $examination->patient->lastname }}</h4>	
		<h4>Date : {{ date('m-d-Y') }}</h4>	
		<h4>TIN/SC-TIN : {{ request('sc_tin') }}</h4>
		<h4>OSCA/PWD ID No : {{ request('pwd_id') }}</h4>
		<h4>Address : {{ request('address') }}</h4>
		<h4>The sum of : {{ request('sum_of') }}</h4>
		<h4>In settlement of the following : {{ request('in_settlement') }}</h4>
		<h4>In settlement price : {{ request('in_settlement_price') }}</h4>
		<table border="1" width="100%" style="border-collapse: collapse;">
			<thead>
				<tr>
					<th>QTY.</th>
					<th>SERVICES RENDERED</th>
					<th>UNIT PRICE</th>
					<th>AMOUNT</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td></td>
					<td>{{ $payment->service_rendered }}</td>
					<td></td>
					<td class="text-center">{{ $payment->fee }}</td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td class="font-weight-bold">TOTAL P</td>
					<td class="text-center">{{ $payment->fee }}</td>
				</tr>
			</tbody>
		</table>

		<h4>By : ______________________________ <br><span class="text-center" style="margin-left :80px;">Authorize signature</span></h4>
  </main>
</body>
</html>