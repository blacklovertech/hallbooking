@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header"></section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box-header">

                    <h1>Welcome to your Dashboard, {{ auth()->user()->name }}</h1>

                </div>
                <div class="box box-primary box-solid ">

                    <div class="box-header">
                        <h3 class="box-title">Notifications</h3>
                    </div>
                    <div class="box-body" style="    background: #009688;color:#fff;">
                        <marquee onmouseover="this.stop();" onmouseout="this.start();">

                            Even semester:2024-25 registration opened -


                            University reopening date 10.12.2024



                        </marquee>
                    </div>
                </div>
            </div>
        </div>


    </section>
    <!-- /.content -->
</div>
@endsection