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

    <div class="container">
        <div class="row">
            <div class="col"> 
                <form action="{{ url('save-blogpost-edits/' . $blogPost->_id) }}" method="post" id="save-form">
					@csrf
						<div class="form-group">
							<input type="text" name="author" id="author" value="{{ $blogPost->author }}" required>
							<input type="text" name="title" id="title" placeholder="Title" value="{{ $blogPost->title }}" required>
							<select class="browser-default" name="category" id="category" required>
								<option value="category 1" {{ $blogPost->category === "category 1" ? "selected" : "" }}>Category 1</option>
								<option value="category 2" {{ $blogPost->category === "category 2" ? "selected" : "" }}>Category 2</option>
								<option value="category 3" {{ $blogPost->category === "category 3" ? "selected" : "" }}>Category 3</option>
								<option value="category 4" {{ $blogPost->category === "category 4" ? "selected" : "" }}>Category 4</option>
							</select>

							<br>
							<p>Set as Featured Article?</p>
							<label>
								<input type="checkbox" name="isFeatured" {{ $blogPost->isFeatured ? "checked" : "" }}/>
								<span>Yes</span>
							</label>

							<br><br>
							<p>Choose A Plan</p>
							<label>
								<input class="with-gap" name="isFree" type="radio" value="true" {{ $blogPost->isFree === true ? "checked" : "" }}/>
								<span>Free</span>
							</label>
							<br>
							<label>
								<input class="with-gap" name="isFree" type="radio" value="false" {{ $blogPost->isFree === false ? "checked" : "" }}/>
								<span>Paid</span>
							</label>

							<br><br>
							<p>Choose A Status</p>
							<label>
								<input class="with-gap" name="status" type="radio" value="draft" {{ $blogPost->status === "draft" ? "checked" : "" }}/>
								<span>Draft</span>
							</label>
							<br>
							<label>
								<input class="with-gap" name="status" type="radio" value="final" {{ $blogPost->status === "final" ? "checked" : "" }}/>
								<span>Final</span>
							</label>
							
							<br><br>
							<textarea name="synopsis" id="synopsis" cols="30" rows="300">{{ $blogPost->synopsis }}</textarea>
							
							<br><br>
							<div class='dfree-body' id='body' name="body">

                                {!! $blogPost->body !!}
                            
                            </div>
								
						</div>
						<textarea name="body" style="display:none" id="postBody"></textarea>
					</form>
                    <a id="submitBlogPostEdits" class='btn modal-trigger' href="#saveBlogPostEdits">Save Changes</a>
                </form>
            </div>
        </div>
    </div>
@endsection   


<!-- Modal Structure -->
<div id="saveBlogPostEdits" class="modal">
    <div class="modal-content">
	  <h4>Save Edits</h4>
          <p>Do you want to save the changes you made to {{$blogPost->title}}?</p>
          <a href="#" class="waves-effect waves-light btn saveEditsBtn">Save</a>
          <a href="#" class="waves-effect waves-light btn cancelEditsBtn">Cancel</a>
    </div>
  </div>