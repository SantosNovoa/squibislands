@extends('admin.layout')
@section('admin-title') Expeditions @endsection
@section('admin-content')
{!! breadcrumbs(['Admin Panel' => 'admin', 'Expeditions' => 'admin/data/expeditions']) !!}
<h1>Expeditions</h1>
<p>This is a list of expeditions that users can send characters on.</p>
<div class="text-right mb-3"><a class="btn btn-primary" href="{{ url('admin/data/expeditions/create') }}"><i class="fas fa-plus"></i> Create New Expedition</a></div>
@if(!count($expeditions))
    <p>No expeditions found.</p>
@else
    <table class="table table-sm expedition-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Difficulty</th>
                <th>Duration</th>
                <th>Success Rate</th>
                <th>Active</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($expeditions as $expedition)
                <tr>
                    <td>{{ $expedition->name }}</td>
                    <td>{{ $expedition->difficulty }}</td>
                    <td>{{ $expedition->duration_hours }}h</td>
                    <td>{{ $expedition->success_rate }}%</td>
                    <td>@if($expedition->is_active)<i class="fas fa-check text-success"></i>@else<i class="fas fa-times text-danger"></i>@endif</td>
                    <td class="text-right">
                        <a href="{{ url('admin/data/expeditions/edit/'.$expedition->id) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection