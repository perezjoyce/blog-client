@extends('../layouts/template')

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

    @if($user->isAdmin)
      <div class="container">
          <br><br>
        <div class="row">
          <table>
            <thead>
              <tr>
                  <th>#</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Created At</th>
                  <th>Updated At</th>
                  <th>Status</th>
                  <th>Action</th>
              </tr>
            </thead>

            <tbody>
              @foreach($blogPosts as $blogPost)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $blogPost->title }}</td>
                    <td>{{ $blogPost->author }}</td>
                    <td>{{ date('F j, Y', strtotime($blogPost->createdAt)) }}</td>
                    <td>{{ date('F j, Y', strtotime($blogPost->updatedAt)) }}</td>
                    <td>{{ $blogPost->status }}</td>
                    <td>
                        <a class="waves-effect waves-light btn" 
                            href="{{ url('get-blogpost/' . $blogPost->_id) }}">EDIT</a>

                        <a class="waves-effect waves-light btn modal-trigger" 
                            id='deleteBlogTrigger' 
                            href="#deleteBlog" 
                            data-id='{{ $blogPost->_id }}'
                            data-title="{{ $blogPost->title }}">DELETE</a>
                    </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endif
@stop

<!-- DELETE BLOG -->
@if($user->isAdmin)
  <div id="deleteBlog" class="modal">
    <div class="modal-content">
	  <h4>Delete Blog Post</h4>
	  	<p>Do you want to delete this blog article? This action cannot be undone.</p>
        <form action="{{ url('delete-blogpost') }}" method="post" id='deleteBlogForm'>
           @csrf
            <input type="hidden" id="deleteBlogId" name='deleteBlogId'>
            <input type="hidden" id="deleteBlogTitle" name='deleteBlogTitle'>
            <input type="submit" value="Delete Now" class='btn'>
        </form>
    </div>
  </div>
@endif

