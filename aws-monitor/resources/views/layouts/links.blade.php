<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AWS Monitor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('main.css') }}" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,300,400,600,700,900,400italic' rel='stylesheet'>

        <link href="{{ asset('css/bootstrap-reset.css') }}" rel="stylesheet">

        <!--Animation css-->
        <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

        <!--Icon-fonts css-->
        <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/ionicon/css/ionicons.min.css') }}" rel="stylesheet" />

        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{ asset('assets/morris/morris.css') }}">

        <!-- sweet alerts -->
        <link href="{{ asset('assets/sweet-alert/sweet-alert.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/form-wizard/jquery.steps.css') }}" />

        <link href="{{ asset('assets/modal-effect/css/component.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/toggles/toggles.css') }}" rel="stylesheet" />


        <!-- Custom styles for this template -->
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('css/helper.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style-responsive.css') }}" rel="stylesheet" />

        <link href="{{ asset('assets/timepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />

        <!-- DataTables -->
        <link href="{{ asset('assets/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('assets/dygraph/dygraph.css') }}" rel="stylesheet" />

        <style>
            .nopadding {
                padding: 0 !important;
                margin: 0 !important;
            }

            .tile {
                background-color: #ffffff;
                padding: .5em 1em;
            }

            .mr-1 {
                margin-right: .5rem !important;
            }
            .mr-2 {
                margin-right: 1rem !important;
            }
            .mr-3 {
                margin-right: 1.5rem !important;
            }

            .grid {
                display: grid;
                grid-gap: 1em;
            }

            .grid::before {
                display: none;
            }

            .status-grid {
                grid-template-rows: 1fr;
                grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
            }
        </style>

        @yield("page_specific_css_files")