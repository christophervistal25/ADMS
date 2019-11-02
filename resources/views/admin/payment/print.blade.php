<html>
<head>
  <title>Receipt</title>
  <style>
    @page { margin: 100px 130px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px; height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .text-center { text-align:center; }
    .font-weight-bold { font-weight: bold; }
    .text-right { text-align: right; }
    .text-left { text-align: left; }
    .underline { 
    	width : 100%;
    	border-bottom : 1px solid black; 

    }

  </style>
</head>
<body>
  <header>
    <h3><center>SUBERI-APIT DENTAL CLINIC</center></h3>
    <div style='margin-top : -20px;'>
    	<center><small>Abarca Street, Mangagoy, Bislig City, Surigao del Sur</small></center>
    	<center><small>DR. ELVIE ANGELIE A. SUBERI - Dentist</small></center>
    	<center><small><span>LIC. NO.: 0035574</span> <span style='margin-left :20px;'>NON-VAT Reg. TIN:180-630-790-000</span></small></center>
    </div>
  </header>
  {{-- <footer>footer on each page</footer> --}}
  <main>
  	<br>
		<div>
			<h3 class="text-right">No 0428</h3>
  			<h3>OFFICIAL RECEIPT</h3>
		</div>
		<div class="text-right">
			<small>Date: <span style='text-decoration: underline;'>{{ date('m-d') }} &nbsp;&nbsp;</span>, &nbsp;<span style='text-decoration: underline;'>{{ date('Y') }}</span></small>
		</div>

		<table width="100%"  style="border-collapse: collapse;" cellpadding="0" cellspacing="0">
			<td width="80"><small>Received From:</small></td>
			<td style="border-bottom: 1px solid black;"><small>{{ $examination->patient->firstname }} {{ $examination->patient->middlename }} {{ $examination->patient->lastname }}</small></td>
		</table>

		<table width="100%"  style="border-collapse: collapse;">
			<tr>
				<td width="48"><small>TIN/SC-TIN: </small></td>
				<td width="90" style="border-bottom: 1px solid black;"><small>{{ request('sc_tin') }}</small></td>
				<td width="80">&nbsp;<small>OSCA/PWD ID No: </small></td>
				<td width="90" style="border-bottom: 1px solid black;"><small>{{ request('pwd_id') }}</small></td>
			</tr>
		</table>

		<table width="100%"  style="border-collapse: collapse;">
			<td width="42"><small>Address: </small></td>
			<td style="border-bottom: 1px solid black;"><small>{{ request('address') }}</small></td>
		</table>

		<table width="100%" style="border-collapse: collapse;">
			<td width="55"><small>The sum of: </small></td>
			<td style="border-bottom: 1px solid black;"><small>{{ request('sum_of') }}</small></td>
		</table>

		<table width="100%"  style="border-collapse: collapse;">
				<td style="border-bottom: 1px solid black;" class="text-center"><small>{{ request('in_settlement') }}</small></td>
				<td width="5">&nbsp;</td>
				<td style="border-bottom: 1px solid black;" width="55" class="text-center"><small>{{ request('in_settlement_price') }}</small></td>
		</table>

		<div class="text-center">
			<small>In settlement of the following</small>
		</div>
		
		<br>
		<table border="1" width="100%" style="border-collapse: collapse;">
			<thead>
				<tr>
					<th><small>QTY.</small></th>
					<th><small>SERVICES RENDERED</small></th>
					<th><small>UNIT PRICE</small></th>
					<th><small>AMOUNT</small></th>
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
		<div class="text-center">
			<small>THANK YOU-COME AGAIN</small>
		</div>
		
		<div class="text-right">
			<h4>By : ______________________________ <br><span style="margin-right : 52px;">Authorize signature</span></h4> 
		</div>
  </main>
</body>
</html>