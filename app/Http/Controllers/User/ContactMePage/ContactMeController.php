<?php

namespace App\Http\Controllers\User\ContactMePage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMe;

class ContactMeController extends Controller
{
    protected $modelNameContactMe;

    /**
     * Instantiate the variables that will be used to get the model.
     * 
     * @return Collection
     */
    public function __construct()
    {
        $this->modelNameContactMe = new ContactMe();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try 
        {
            $request->validate([
                'full_name'      => 'required|regex:/^[a-zA-Z_ ]+$/u|max:255',
                'email'          => 'required|email:filter|max:255',
                'message'        => 'required|min:60',
            ]);
            if (is_null($request->get('privacy_policy'))) 
            {
                $records = $this->modelNameContactMe->create([
                    'full_name'      => $request->get('full_name'),
                    'email'          => $request->get('email'),
                    'message'        => $request->get('message'),
                    'privacy_policy' => '0',
                ]);
            }
            else 
            {
                $records = $this->modelNameContactMe->create([
                    'full_name'      => $request->get('full_name'),
                    'email'          => $request->get('email'),
                    'message'        => $request->get('message'),
                    'privacy_policy' => '1',
                ]);
            }
            $apiInsertSingleRecord = [
                'full_name' => $records['full_name'],
                'email' => $records['email'],
                'message' => $request->get('message'),
                'privacy_policy' => $records['privacy_policy'],
            ];
            return response()->json($apiInsertSingleRecord);
        }
        catch  (\Illuminate\Database\QueryException $mysqlError)
        {
            if ($mysqlError->getCode() === '42S02') 
            {
                return response([], 500)->json();
            }
            if ($mysqlError->getCode() === '42S22') 
            {
                return response([], 500)->json();
            }
        }
    }
}