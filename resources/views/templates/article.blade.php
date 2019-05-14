@extends('../layouts/template')

@section('title', 'Dashboard')

@section('user_body')

	@if(Session::has("successMessage"))
	<div class="alert alert-success">
		{{ Session::get('successMessage') }}
	</div>
	@elseif(Session::has("errorMessage"))
	<div class="alert alert-danger">
		{{ Session::get('errorMessage') }}
	</div>
	@endif

    @if($blogPost->isFree || $blogPost->isFeatured)
			<div class="container">
				<div class="row">
					<div class="col">
							{!! $blogPost->body !!}  
					</div>
				</div>
			</div>
		@endif
@endsection   