<html>
<head>
  <title>Examination Records</title>
  <style>
    /* @page { margin: 100px 25px; } */
    header { position: fixed; top: -100px; left: 0px; right: 0px; height: 60px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px; background-color: lightblue; height: 50px; }
    p { page-break-after: always; }
    p:last-child { page-break-after: never; }
    .center { text-align:center; }
  </style>
</head>
<body>
{{--   <header>
    <h2><center>SUBERI-APIT DENTAL CLINIC</center></h2>
    <center>Abarca Street, Mangagoy, Bislig City, Surigao del Sur</center>
    <center>DR. ELVIE ANGELIE A. SUBERI - Dentist</center>
    <hr>
  </header> --}}
  {{-- <footer>footer on each page</footer> --}}
  <main>
      <div>Chief Complaint ________________________________________________________________</div>
      <div>Other Findings &nbsp;&nbsp;&nbsp;________________________________________________________________</div>
      <br>
      <table border="1" width="100%" style="border-collapse: collapse;">
        <thead>
          <tr>
            <th class="center">Date</th>
            <th class="center">Tooth</th>
            <th class="center">Surface</th>
            <th class="center">Treatment Record</th>
            <th class="center">Free</th>
            <th class="center">Paid</th>
            <th class="center">Balance</th>
          </tr>
        </thead>
        <tbody>
          @foreach($records as $record)
          <tr>
                  <td class="center">{{ $record->created_at->format(' jS \\of M h:i A Y') }}</td>
                  <td class="center">{{ $record->teeths->pluck('tooth_description')->implode(', ') }}</td>
                  <td class="center">{{ $record->teeths->pluck('surface')->implode(', ') }}</td>
                  <td class="center">{{ $record->teeths->pluck('treatment')->implode(', ') }}</td>
                  <td class="center">(Free)</td>
                  <td class="center">(Paid)</td>
                  <td class="center">(Balance)</td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </main>
  <script type="text/php">
    if (isset($pdf)) {
        $x = 250;
        $y = 810;
        $text = "Page {PAGE_NUM} of {PAGE_COUNT}";
        $font = null;
        $size = 14;
        $color = array(0,0,0);
        $word_space = 0.0;  //  default
        $char_space = 0.0;  //  default
        $angle = 0.0;   //  default
        $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);
    }
</script>
</body>
</html>