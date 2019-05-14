@extends('../layouts/template')

@section('title', 'Dashboard')

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


	@if($user->isAdmin)
		<div class="container">
			<div class="row">
				<div class="col">
					<form action="create-blog-post" method="post" id="post-form">
					@csrf
						<div class="form-group">
							<input type="text" name="author" id="author" placeholder="Author" required>
							<input type="text" name="title" id="title" placeholder="Title" required>
							<select class="browser-default" name="category" id="category" required>
								<option value="category 1" selected disabled>Choose A Category</option>
								<option value="category 1">Category 1</option>
								<option value="category 2">Category 2</option>
								<option value="category 3">Category 3</option>
								<option value="category 4">Category 4</option>
							</select>

							<br>
							<p>Set as Featured Article?</p>
							<label>
								<input type="checkbox" id="isFeatured" name="isFeatured"/>
								<span>Yes</span>
							</label>

							<br><br>
							<p>Choose A Plan</p>
							<label>
								<input class="with-gap" name="isFree" type="radio" value="true" checked/>
								<span>Free</span>
							</label>
							<br>
							<label>
								<input class="with-gap" name="isFree" type="radio" value="false" />
								<span>Paid</span>
							</label>

							<br><br>
							<p>Choose A Status</p>
							<label>
								<input class="with-gap" name="status" type="radio" value="draft" checked/>
								<span>Draft</span>
							</label>
							<br>
							<label>
								<input class="with-gap" name="status" type="radio" value="final" />
								<span>Final</span>
							</label>
							
							<br><br>
							<textarea name="synopsis" id="synopsis" cols="30" rows="300">Synopsis</textarea>
							
							<br><br>
							<div class='demo-dfree' id='body' name="body">
								<h2 class="dfree-header mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false">
									The latest and greatest from TinyMCE
								</h2>
								<br/>
								<div class="dfree-body mce-content-body" contenteditable="true" style="position: relative;" spellcheck="false">
									<p><img src="https://tiny.cloud/images/medium-pic.jpg" style="display: block; margin-left: auto; margin-right: auto; width: 100%;" data-mce-style="display: block; margin-left: auto; margin-right: auto;" data-mce-selected="1"></p>
									<br/>
									<h2>The world’s first rich text editor in the cloud</h2>

									<p>
									Have you heard about Tiny Cloud? 
									It’s the first step in our journey to help you deliver great content creation experiences, no matter your level of expertise. 
									50,000 developers already agree. 
									They get free access to our global CDN, image proxy services and auto updates to the TinyMCE editor. 
									They’re also ready for some exciting updates coming soon.
									</p>
								
								
									<p>
									One of these enhancements is <strong>Tiny Drive</strong>: imagine file management for TinyMCE, in the cloud, made super easy. 
									Learn more at <a href='https://www.tiny.cloud/tinydrive/'>tiny.cloud/tinydrive</a>, where you’ll find a working demo and an opportunity to provide feedback to the product team.
									</p>
								
									<h3>An editor for every project</h3>
								
									<p>
									Here are some of our customer’s most common use cases for TinyMCE:
									<ul>
										<li>Content Management Systems (<em>e.g. WordPress, Umbraco</em>)</li>
										<li>Learning Management Systems (<em>e.g. Blackboard</em>)</li>
										<li>Customer Relationship Management and marketing automation (<em>e.g. Marketo</em>)</li>
										<li>Email marketing (<em>e.g. Constant Contact</em>)</li>
										<li>Content creation in SaaS systems (<em>e.g. Eventbrite, Evernote, GoFundMe, Zendesk</em>)</li>
									</ul>
									</p>
								
									<p>
									And those use cases are just the start. 
									TinyMCE is incredibly flexible, and with hundreds of APIs there’s likely a solution for your editor project. 
									If you haven’t experienced Tiny Cloud, get started today. 
									You’ll even get a free trial of our premium plugins – no credit card required!
									</p>
								</div>
							</div>

						</div>
						<textarea name="body" style="display:none" id="postBody"></textarea>
						<input type="button" value="Save" class='btn' id='submitHandler'>
					</form>
				</div>
			</div>
		</div>
	@else
	<div class="container">
    	<div class="row">
			@foreach($blogPosts as $blogPost)
				@if($blogPost->isFree)
				<div class="col s12 m4 l4">
					<br><br>
					<div class="card">
						<div class="card-image">
							<img src="images/sample-1.jpg">
							<span class="card-title">{{ $blogPost->title }}</span>
						</div>
						<div class="card-content">
							<p>{{ $blogPost->isFree }}</p>
							<p>{{ $blogPost->synopsis }}</p>
						</div>
						<a href="get-blogpost/{{ $blogPost->_id }}" class='btn'>Read</a>
					</div>
				</div>
				@else
				<div class="col s12 m4 l4">
					<br><br>
					<div class="card">
						<div class="card-image">
							<img src="images/sample-1.jpg">
							<span class="card-title">{{ $blogPost->title }}</span>
						</div>
						<div class="card-content">
							<p>PREMIUM</p>
							<p>{{ $blogPost->synopsis }}</p>
						</div>
						<a href="blogpost-premium/{{ $blogPost->_id }}" class='btn'>Read</a>
					</div>
				</div>
				@endif
			@endforeach
		</div>
    </div>
	@endif
@endsection


  