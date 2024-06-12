<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    //
    public function index()
    {

    }

    public function store(Request $request)
    {
        // validations
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'first_name' => 'required|string|max:50',
                    'last_name' => 'required|string|max:50',
                    'email' => 'required|email|max:50',
                    'message' => 'required|string|max:255'
                ],
                [
                    'first_name.required' => 'The first name is required.',
                    'last_name.required' => 'The last name is required.',
                    'first_name.alpha' => 'The first name may only contain letters',
                    'last_name.alpha' => 'The last name may only contain letters',
                    'email.required' => 'The email address is required',
                    'message.required' => 'The message address is required',
                    'email.email' => 'Please provide a valid email address.',
                    'message.max' => 'The message may not be greater than 255 characters.'
                ]
            );
            if ($validator->fails()) {
                throw new \Exception($validator->errors()->first(), 500);
            }
            $validated = $validator->validated();
            Contact::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'email' => $validated['email'],
                'message' => $validated['message'],
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Query reached successfully!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

}
