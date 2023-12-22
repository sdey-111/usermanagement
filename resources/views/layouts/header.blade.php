<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Management</title>
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2-bootstrap4.min.css')}}">


    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/main.min.css')}}">
    {{--<link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/')}}../plugins/fullcalendar-interaction/main.min.css">--}}
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/day_grid_main.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/time_main.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/fullcalendar-bootstrap_main.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/adminlte.min.css')}}">


    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style type="text/css">
        button.dt-button, div.dt-button, a.dt-button{
            margin-left: 5px;
            padding: 0.3em 1em;
        }
    </style>

</head>
<body class="sidebar-mini">

<div class="wrapper">
