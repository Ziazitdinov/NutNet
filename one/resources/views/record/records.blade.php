@extends('layouts.app')

@section('content')
@if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
@endif
<div class="container">
	<div class="row justify-content-center">
    	<div class="col-md-12 mt-5 bg-light rounded">
		    <div class="panel panel-default">
			  <!-- Содержание панели по умолчанию -->  
				<div class="panel-heading">Records</div>

			  <!-- Таблица -->  
  				<div class="table-responsive">
					<table class="table table-hover">
		    			<tr>
		    				<th class="bg-primary text-white">#</th>
		      				<th class="bg-primary text-white">Name</th>
		      				<th class="bg-primary text-white"></th>
		    			</tr>
		    			@foreach($records as $record)	
		    			<tr>
		    				<td>{{ $record->id }}</td>
					        <td><a href="records/edit/{{ $record->id }}">{{ $record->name }}</a></td>
					        <td>
					        	<form name="callback" method="post" action="/records/delete/{{ $record->id }}">
					        	{{ csrf_field() }}
					        	{{ method_field('DELETE') }}
					        	<img style="width: 20px; height: 20px; cursor: pointer;" src="{{asset('images/delete.png')}}" onclick="document.forms['callback'].submit();">	
					        	</form>
					        </td>
		    			</tr>
		    			@endforeach
					</table>
		  		</div>
			</div>
			<div class="container">
				{{ $records->links() }}
			</div>
		</div>
	</div>
</div>		
@endsection