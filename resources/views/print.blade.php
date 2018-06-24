{{-- @extends('layout.app') --}}
{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>sdfsdf</title>
  </head>
  <body>
    <div class="print-area">
      <p>sdfsdafasdfsafasdf</p>
    </div>
    <button type="button" name="button" onClick="window.print()">Print</button>
    <script type="text/javascript">
      function print() {
        $('body').css('overflow', 'hidden');
        $('html').animate({ scrollTop: 0 }, 'fast', 'swing', function () {
          var printContents = document.getElementById("print-area").innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
          return false;
        })
      }
    </script>
  </body>
</html>
{{-- @endsection --}}
{{-- @section('scripts') --}}

{{-- @endsection --}}
