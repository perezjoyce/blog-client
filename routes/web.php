<?php
use GuzzleHttp\Client;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogPostController;


//PAGES
Route::get('/', 'BlogPostController@displayHomePage');

Route::get('dashboard', 'UserController@getDashboard');


//USER
Route::get('users', 'UserController@displayAllUsers');

Route::get('register', function () {
    return view('templates.register');
})->name('register');

Route::post('create-user', 'UserController@createUser');

Route::post('login-user', 'UserController@loginUser');

Route::post('logout' , 'UserController@logoutUser');

Route::post('delete-user', 'UserController@deleteUser');

Route::post('edit-user', 'UserController@editUser');


//BLOG POSTS
Route::get('write-blog-post', 'BlogPostController@writeBlogPostForm');

Route::post('create-blog-post', 'BlogPostController@createBlogPost');

Route::get('get-blogpost/{blogPostId}', 'BlogPostController@getBlogPost');

Route::get('blogpost-premium/{blogPostId}', 'BlogPostController@displayPremiumBlogPost');

Route::get('blogpost/{blogPostId}', 'BlogPostController@displayBlogPost');

Route::get('blogposts', 'BlogPostController@displayAllBlogPosts');

Route::post('delete-blogpost', 'BlogPostController@deleteBlogPost');

Route::get('edit-blogpost/{blogPostId}', 'BlogPostController@editBlogPostForm');

Route::post('save-blogpost-edits/{blogPostId}', 'BlogPostController@saveBlogPostEdits');


