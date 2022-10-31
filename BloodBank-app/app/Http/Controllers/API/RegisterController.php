<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
// use Illuminate\Support\Facades\Validator;
use App\Http\Resources\UserResource;



class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'position' => 'required',
            'phone' => 'required',
            'ghanaCard_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User registered successfully.');
    }

    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    
    


    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User login successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    
      /**
     * Logout api
     *
     * @return \Illuminate\Http\Response
     */
    

     public function logout(Request $request)
     {
         $request->user()->currentAccessToken()->delete();
         return $this->sendResponse([], 'User logout successfully.');
     }


        /**
     * Forgot Password api
     *
     * @return \Illuminate\Http\Response
     */

    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $input = $request->all();
        $user = User::where('email', $input['email'])->first();
        if($user){
            $user->password = bcrypt('123456');
            $user->save();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;

            return $this->sendResponse($success, 'User password reset successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    

    /**
     * Display all registered users
     */
    public function index()
    {
        $users = User::all();
        // return $this->sendResponse($UserResource, 'Users retrieved successfully.');
        return $this->sendResponse(UserResource::collection($users), 'Users retrieved successfully.');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return $this->sendError('User not found.');
        }
        return $this->sendResponse(new UserResource($user), 'User retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update($id, Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'position' => 'required',
            'phone' => 'required',
            'ghanaCard_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = User::find($id);
        if (is_null($user)) {
            return $this->sendError('User not found.');
        }

        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->position = $input['position'];
        $user->phone = $input['phone'];
        $user->ghanaCard_id = $input['ghanaCard_id'];
        $user->save();

        return $this->sendResponse(new UserResource($user), 'User updated successfully.');
    }


    /**
     * User profile
     */
    public function profile()
    {
        $user = Auth::user();
        return $this->sendResponse(new UserResource($user), 'User profile retrieved successfully.');
        
    }


    /**
     * Edit auth user profile
     */
    public function editProfile(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'position' => 'required',
            'phone' => 'required',
            'ghanaCard_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = Auth::user();
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->password = bcrypt($input['password']);
        $user->position = $input['position'];
        $user->phone = $input['phone'];
        $user->ghanaCard_id = $input['ghanaCard_id'];
        $user->save();

        return $this->sendResponse(new UserResource($user), 'User profile updated successfully.');
    }


    /**
     * Update the password for the user.
     */
    public function updatePassword(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'current_password' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $user = Auth::user();
        if(Hash::check($input['current_password'], $user->password)){
            $user->password = bcrypt($input['password']);
            $user->save();
            return $this->sendResponse(new UserResource($user), 'User password updated successfully.');
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return $this->sendError('User not found.');
        }
        $user->delete();
        return $this->sendResponse([], 'User deleted successfully.');
    }




}