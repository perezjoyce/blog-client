<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use Session;
use Illuminate\Validation\Validator;
use BlogPostController;

class UserController extends Controller
{   
    //DISPLAY DASHBOARD
    public function getDashboard() {
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1Y2Q4ZTk0NDUwNjM4MDI3YjAzOWIwYWQiLCJpYXQiOjE1NTc3MTkzNjR9.GgLecg32XQxU5dzo6zIGLfFAJN8NGbelb7YI4qx8Wm0';
  
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];

        $client = new Client([
            'base_uri' => 'http://127.0.0.1:3000',
            'timeout'  => 2.0,
            'headers' => $headers
        ]);

        $userId = Session::get('_id');
        // dd($userId);

        $response = $client->get('/users/'. $userId);
        // dd($response);


        $user = json_decode($response->getBody());
        $response2 = $client->get('/finalBlogPosts');
        $blogPosts = json_decode($response2->getBody());

        return view('user.dashboard')->with(compact('user', 'blogPosts'));
    }

    public function displayAllUsers(){
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1Y2Q4ZTk0NDUwNjM4MDI3YjAzOWIwYWQiLCJpYXQiOjE1NTc3MTkzNjR9.GgLecg32XQxU5dzo6zIGLfFAJN8NGbelb7YI4qx8Wm0';
    
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];

        $client = new Client([
            'base_uri' => 'http://127.0.0.1:3000',
            'timeout'  =>2.0,
            'headers' => $headers
        ]);

        $userId = Session::get('_id');

        if(isset($userId)) {
            $response2 = $client->get('/users/'. $userId);
            $user = json_decode($response2->getBody());
            $response = $client->get('/allUsers');
            $blogUsers = json_decode($response->getBody());
            return view('templates.user-list')->with(compact('user', 'blogUsers'));
        } 
    }

    //CREATE AND LOGIN USER
    public function createUser(Request $request) {

        $userData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1Y2Q4ZTk0NDUwNjM4MDI3YjAzOWIwYWQiLCJpYXQiOjE1NTc3MTkzNjR9.GgLecg32XQxU5dzo6zIGLfFAJN8NGbelb7YI4qx8Wm0';
    
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];

        $client = new Client([
            'base_uri' => 'http://127.0.0.1:3000',
            'timeout'  => 2.0,
            'headers' => $headers
        ]);
        
        $response = $client->post('users', [
            'json' => $userData
        ]);

        return redirect('/');
    }    

    //LOGIN USER
    public function loginUser(Request $request) {
        $userData = [
            'email' => $request->input('login-email'),
            'password' => $request->input('login-password')
        ];

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1Y2Q4ZTk0NDUwNjM4MDI3YjAzOWIwYWQiLCJpYXQiOjE1NTc3MTkzNjR9.GgLecg32XQxU5dzo6zIGLfFAJN8NGbelb7YI4qx8Wm0';
    
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];

        $client = new Client([
            'base_uri' => 'http://127.0.0.1:3000',
            'timeout'  => 2.0,
            'headers' => $headers
        ]);
        
        try {
            $response = $client->post('/users/login', [
                'json' => $userData
            ]);
 
            //DISPLAY PROFILE
            $userResponse = json_decode($response->getBody());

            if ($userResponse) {
                $userToken = $userResponse->token;
                $userId = $userResponse->user->_id;
                $request->session()->put('token', $userToken);
                $request->session()->put('_id', $userId);
                Session::flash("successMessage", "Hello, " . $userResponse->user->name);
                return redirect('/dashboard');
            }

            Session::flash("errorMessage", "Invalid user credentials.");
            return redirect('/');
        } catch (\Exception $e) {
            Session::flash("errorMessage", "Invalid user credentials.");
            return redirect('/');
        }
    }

    //LOGOUT 
    public function logoutUser(Request $request) {

        $userId = Session::get('_id');

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1Y2Q4ZTk0NDUwNjM4MDI3YjAzOWIwYWQiLCJpYXQiOjE1NTc3MTkzNjR9.GgLecg32XQxU5dzo6zIGLfFAJN8NGbelb7YI4qx8Wm0';
    
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];

        $client = new Client([
            'base_uri' => 'http://127.0.0.1:3000',
            'timeout'  => 2.0,
            'headers' => $headers
        ]);
        
      
        $response = $client->post('/users/logout/' . $userId);
        $request->session()->forget(['token','_id']); 
        Session::flash("successMessage", "You are now logged out!");
        return redirect('/');
    }

    //DEACTIVATE 
    public function deleteUser(Request $request) {

        $userData = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

                $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1Y2Q4ZTk0NDUwNjM4MDI3YjAzOWIwYWQiLCJpYXQiOjE1NTc3MTkzNjR9.GgLecg32XQxU5dzo6zIGLfFAJN8NGbelb7YI4qx8Wm0';
        
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];

        $client = new Client([
            'base_uri' => 'http://127.0.0.1:3000',
            'timeout'  => 2.0,
            'headers' => $headers
        ]);

        try {
            $response = $client->put('/users/me', [
                'json' => $userData
            ]);
            $request->session()->forget(['token','_id']);
            Session::flash("successMessage", "Your account has been deactivated.");
            return redirect('/');
        } catch (\Exception $e) {
            $response = $client->get('/users/me');
            $user = json_decode($response->getBody());
            Session::flash("errorMessage", "Invalid user credentials.");
            return redirect('/dashboard');
        }
    }

    //EDIT USER
    public function editUser(Request $request) {

        $userData = [
            'name' => $request->input('edit_name'),
            '_id' => $request->input('userId'),
            'plan' => $request->input('edit_plan'),
            'isAdmin' => $request->input('edit_role')
        ];


        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJfaWQiOiI1Y2Q4ZTk0NDUwNjM4MDI3YjAzOWIwYWQiLCJpYXQiOjE1NTc3MTkzNjR9.GgLecg32XQxU5dzo6zIGLfFAJN8NGbelb7YI4qx8Wm0';
        
        $headers = [
            'Authorization' => 'Bearer ' . $token,
            'Accept' => 'application/json'
        ];

        $client = new Client([
            'base_uri' => 'http://127.0.0.1:3000',
            'timeout'  => 2.0,
            'headers' => $headers
        ]);

        // dd($userData['_id']);

        try {
            $response = $client->patch('/users/'. $userData['_id'], [
                'json' => $userData
            ]);

         

            $userId = Session::get('_id');

            if($userData['_id'] === $userId){
                Session::flash("successMessage", "Your account has been successfully updated.");
                return redirect('/dashboard');
            }
            
            Session::flash("successMessage", $userData['_id'] . "'s account has been successfully updated.");
            return redirect('/dashboard');

        } catch (\Exception $e) {
            $response = $client->get('/users/me');
            Session::flash("errorMessage", "Invalid user credentials.");
            return redirect('/dashboard');
        }
    }
}
