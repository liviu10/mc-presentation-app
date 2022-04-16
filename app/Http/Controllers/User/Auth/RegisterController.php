<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $modelNameUser;
    protected $tableNameUser;


    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->modelNameUser = new User();
        $this->tableNameUser = $this->modelNameUser->getTable();
    }

    /**
     * The user has been registered.
     */
    protected function registered(Request $request, User $user)
    {
        if ($user instanceof MustVerifyEmail) {
            return response()->json(['status' => trans('verification.sent')]);
        }

        return response()->json($user);
    }

    /**
     * Get a validator for an incoming registration request.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'nickname' => 'required|max:255',
            'email' => 'required|email:filter|max:255|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     */
    protected function create(array $data): User
    {
        $registerUser = User::create([
            'name' => $data['name'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'user_role_type_id' => 6,
        ]);
        // $this->modelNameUser->find($this->modelNameUser->select('id')->latest('id')->first()->id)->log()->create([ 
        //     'status'  => 'User registered',
        //     'details' => __('error_and_notification_system.store.info_00002_notify.user_has_rights.message_super_admin', [
        //         'record'         => $data['name'] . ' (id ' . $this->modelNameUser->select('id')->latest('id')->first()->id . ')',
        //         'databaseName'   => config('database.connections.mysql.database'),
        //         'tableName'      => $this->tableNameUser
        //     ])
        // ]);
        return $registerUser;
    }
}
