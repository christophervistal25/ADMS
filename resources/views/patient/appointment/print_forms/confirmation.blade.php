<html>
<head>
  <title>Appointment Confirmation</title>
  <style  type="text/css" media="all">
    @page { margin: 100px 25px; }
    header { position: fixed; top: -100px; left: 0px; right: 0px; height: 50px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .text-center { text-align: center; }
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
    <p>
      <br>
      <span style="font-size : 25px; font-weight: bold;"><center>Appointment Confirmation Letter</center></span>
      <span style="font-size:18px;">
        <br>
        <br>
        Dear <b>{{ Auth::user()->firstname . ' ' . Auth::user()->middlename . ' ' . Auth::user()->lastname  }}</b>,
        <br>
        <br>
        <span class="text-center">
          This letter is to confirm your appointment with <b>{{$appointment->doctor->title}} {{ $appointment->doctor->fullname }}</b> on <b>{{ $appointment->start_date->format('l jS \\of F Y h:i:s A') . ' to ' . $appointment->end_date->format('h:i:s A') }}</b>.Your service is <b>{{ $appointment->service->name }}</b> if you need assistance in finding the location, then kindly contact <b>{{ $mobile_no }}</b>.
          I appreciate a response from your side confirming the same and don't forget to tell at the clinic that your patient number is {{ Auth::user()->patient_number }}.
        </span>
        <br>
        <br>
        <b> _______________<br> <span style="margin-left : 20px;">Signature</span> <br> Best Regards</b>
      </span>
    </p>
  </main>
</body>
</html>