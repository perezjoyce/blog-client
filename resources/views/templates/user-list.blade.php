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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Plan</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($blogUsers as $blogUser)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucwords($blogUser->name) }}</td>
                        <td>{{ $blogUser->email }}</td>
                        <td>{{ $blogUser->isAdmin === true ? "Admin" : "User" }}</td>
                        <td>{{ ucfirst($blogUser->status) }}</td>
                        <td>{{ ucfirst($blogUser->plan) }}</td>
                        <td>{{ date('F j, Y', strtotime($blogUser->createdAt)) }}</td>
                        <td>
                            <a class="waves-effect waves-light btn modal-trigger" 
                                id='editUserTrigger' 
                                href="#editProfileForm" 
                                data-id='{{ $blogUser->_id }}'
                                data-name="{{ $blogUser->name }}"
                                data-role="{{ $blogUser->isAdmin }}"
                                data-plan="{{ $blogUser->plan }}"
                                >EDIT</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    @endif
@stop


    <!-- Modal Structure -->
<div id="editProfileForm" class="modal">
    <div class="modal-content">
	  <h4>Edit Profile</h4>
        <form action="edit-user" method="post">
		
		   	<label>Username</label>
			<input type="text" name="edit_name" id="edit_name">
            <input type="text" name="userId" id="userId">
            
            <label>Role</label>
			<select class="browser-default" name="edit_role" id="edit_role">
			</select>
            <br>
            
			<label>Subscription Plan</label>
			<select class="browser-default" name="edit_plan" id="edit_plan">
            </select>
            
			<br>
            <input type="submit" value="Apply Changes" class='btn' id="saveUserChanges">
        </form>
    </div>
  </div>

