<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reminder Email</title>
  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">

  <!-- plugin css -->
  <link href="{{ asset('libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />

  <!-- preloader css -->
  <link rel="stylesheet" href="{{ asset('css/preloader.min.css') }}" type="text/css" />

  <!-- Bootstrap Css -->
  <link href="{{ asset('css/bootstrap-rtl.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
  <!-- Icons Css -->
  <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- App Css-->
  <link href="{{ asset('css/app-rtl.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
  <link href="{{  asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

   {{-- calender  --}}

   <link href="{{ asset('libs/@fullcalendar/core/main.min.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('libs/@fullcalendar/daygrid/main.min.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('libs/@fullcalendar/bootstrap/main.min.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('libs/@fullcalendar/timegrid/main.min.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{  asset('libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
   <link rel="stylesheet" href="{{asset('plugins/toastr/toastr.css')}}">

   <link href="{{ asset('libs/choices.js/public/assets/styles/choices.min.css')}}" rel="stylesheet" type="text/css" />

   <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">

   <!-- color picker css -->
   <link rel="stylesheet" href="{{ asset('libs/%40simonwep/pickr/themes/classic.min.css')}}"/> <!-- 'classic' theme -->
   <link rel="stylesheet" href="{{ asset('libs/%40simonwep/pickr/themes/monolith.min.css')}}"/> <!-- 'monolith' theme -->
   <link rel="stylesheet" href="{{asset('libs/%40simonwep/pickr/themes/nano.min.css')}}"/> <!-- 'nano' theme -->

<!-- flatpickr css -->
<link href="{{ asset('libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css">
<!-- DataTables -->
<link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{asset('css/icons.min.css')}}" rel="stylesheet" type="text/css" />
</head>
<body bgcolor="#0f3462" style="margin-top:20px;margin-bottom:20px">
  <!-- Main table -->
  <table border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="white" width="650">
    <tr>
      <td>
        <!-- Child table -->
        <table border="0" cellspacing="0" cellpadding="0" style="color:#0f3462; font-family: sans-serif;">
          <tr>
            <td>
              <h2 style="text-align:center; margin: 0px; padding-bottom: 25px; margin-top: 25px;">
                <i>Sanad </i><span style="color:lightcoral">Office</span></h2>
            </td>
          </tr>
          {{-- <tr>
            <td>
              <img src="https://image.flaticon.com/icons/svg/149/149314.svg" height="50px" style="display:block; margin:auto;padding-bottom: 25px; ">
            </td>
          </tr> --}}
          <tr>
            <td style="text-align: center;">
              <h1 style="margin: 0px;padding-bottom: 25px; text-transform: uppercase;">Document Expiry Reminder</h1>
              <h2 style="margin: 0px;padding-bottom: 25px;font-size:22px;"> Please renew your Document</h2>
              <h2 style="margin: 0px;padding-bottom: 25px;font-size:22px;"> Hey {{ $userName }} </h2>
              <p style=" margin: 0px 40px;padding-bottom: 25px;line-height: 2; font-size: 15px;">{{ $emailText }}
              </p>
               
              {{-- <h2 style="margin: 0px; padding-bottom: 25px;">Expire: 05 November</h2> --}}
            </td>
          </tr>
          <tr>
            <td>
              <a href="{{ url ('show_expired_docs') }}" target="_blank" style="background-color:#36b445; color:white; padding:15px 97px; outline: none; display: block; margin: auto; border-radius: 31px;
                                font-weight: bold; margin-top: 25px; margin-bottom: 25px; border: none; text-transform:uppercase; " class="btn">Renew</a>
            </td>
          </tr>
          <tr>
            <td style="text-align:center;">
              <h2 style="padding-top: 25px; line-height: 1; margin:0px;">Thank You</h2>
              {{-- <div style="margin-bottom: 25px; font-size: 15px;margin-top:7px;">Give us a Missed call Sample-1800
              </div> --}}
            </td>
          </tr>
        </table>
        <!-- /Child table -->
      </td>
    </tr>
  </table>
  <!-- / Main table -->
</body>

</html>