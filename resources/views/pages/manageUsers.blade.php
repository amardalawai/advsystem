@extends('pages.layout.master')
@section('title', 'Manage Users')
@section('title-info', 'List of users')
@section('content')
@parent

<div class="box">
    <div class="box-header">
        <h3 class="box-title">Data Table With Full Features</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
    <!-- /.box-body -->
    @stop

    @section('include_js')
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
    @stop