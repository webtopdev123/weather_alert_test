// resources/views/dashboard.blade.php
@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Weather Alerts</h1>
    <form method="POST" action="{{ route('weather-alerts.store') }}">
        @csrf
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" class="form-control" name="city" required>
        </div>
        <div class="form-group">
            <label for="precipitation_threshold">Precipitation Threshold</label>
            <input type="number" class="form-control" name="precipitation_threshold" step="0.1" required>
        </div>
        <div class="form-group">
            <label for="uv_index_threshold">UV Index Threshold</label>
            <input type="number" class="form-control" name="uv_index_threshold" step="0.1" required>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
