@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <p class="text-center">{{ __('You are logged in!') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        margin-top: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        font-size: 24px;
    }

    .card-body {
        font-size: 18px;
    }

    .alert {
        font-size: 16px;
        background-color: #4CAF50;
        color: white;
    }
</style>
@endsection