@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    <h3>Here are the stuff</h3>
										@forelse($all_things as $things)
											<h5>{{$things->title}}	</h5> 
											<p>{{$things->body}}</p>
										@empty
											<h4>There aint nothing here bitch </h4>
										@endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
