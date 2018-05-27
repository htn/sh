<!DOCTYPE html>
<html dir="ltr" lang="en-US">
   <head>
      <meta charset="UTF-8" />
      <title>A date range picker for Bootstrap</title>

      <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />-->

      <link rel="stylesheet" type="text/css" media="all" href="daterangepicker.css" />

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>

      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.1/moment.min.js"></script>

      <script type="text/javascript" src="daterangepicker.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
   </head>
   <body style="margin: 60px 0">

      <div class="container">
<input type="text" name="datetimes" />

<script>
$(function() {
  $('input[name="datetimes"]').daterangepicker({
autoApply: true,
    timePicker: true,
	singleDatePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
      format: 'MM/DD/YYYY hh:mm A'
    }
  });
});
</script>
       </div>

   </body>
</html>
