@extends('layouts.template')

@section('title', 'ME | Data Devices')

@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Visitor Statistics</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Total Visits</h5>
            <p class="card-text">{{ $totalVisits }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Unique Visits</h5>
            <p class="card-text">{{ $uniqueVisits }}</p>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Visits Per Day (Last 30 Days)</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Number of Visits</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visitsPerDay as $visit)
                    <tr>
                        <td>{{ $visit->date }}</td>
                        <td>{{ $visit->visits }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<p>Total Site Visits: {{ $visitorCount }}</p>

@endsection
