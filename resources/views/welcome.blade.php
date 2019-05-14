@extends('../layouts/template')

@section('user_body')

<br><br>
	<div class="container">
		<div class="row">
			<div class="col">
				@if(Session::has("successMessage"))
				<div class="alert alert-success">
					{{ Session::get('successMessage') }}
				</div>
				@elseif(Session::has("errorMessage"))
				<div class="alert alert-danger">
					{{ Session::get('errorMessage') }}
				</div>
				@endif
			</div>
		</div>
	</div>
  @foreach($blogPosts as $blogPost)
    @if($blogPost->isFeatured)
      <div class="section no-pad-bot" id="index-banner">
        <div class="container">
          <br><br>
          <h1 class="header center orange-text">{{ $blogPost->title }}</h1>
          <div class="row center">
            <h5 class="header col s12 light">{{ $blogPost->author }} | {{ date('F j, Y', strtotime($blogPost->createdAt)) }}</h5>
          </div>
          <div class="row center">
            <a href="get-blogpost/{{ $blogPost->_id }}" id="download-button" class="btn-large waves-effect waves-light orange">Read for FREE</a>
          </div>
          <br><br>
        </div>
      </div>
    @endif
  @endforeach

  <div class="container">
    <div class="row">
      @foreach($blogPosts as $blogPost)
        @if($blogPost->isFree && !$blogPost->isFeatured)
          <div class="col s12 m4 l4">
          <br><br>
              <div class="card">
                  <div class="card-image">
                      <img src="images/sample-1.jpg">
                      <span class="card-title">{{ $blogPost->title }}</span>
                  </div>
                  <div class="card-content">
                      <p>{{ $blogPost->synopsis }}</p>
                  </div>
                  <a href="get-blogpost/{{ $blogPost->_id }}" class='btn'>Read</a>
              </div>
          </div>
        @endif
      @endforeach
    </div>
  </div>
@stop