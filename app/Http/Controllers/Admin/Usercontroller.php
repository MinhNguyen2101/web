<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class Usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(8);

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
        try {
            //Validate data
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                ],
                'email' => [
                    'required',
                    'email',
                    ValidationRule::unique('users', 'email')
                ],
                'role' => [
                    'required',
                ],
            ]);

            //Validate errors
            if ($validator->fails()) {
                return json_encode(array(
                    "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                    "message" => $validator->errors()
                ), JSON_THROW_ON_ERROR);
            }

            $category = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!$category) {
                return json_encode(array(
                    "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                    "message" => __('messages.data.not.exist')
                ), JSON_THROW_ON_ERROR);
            }

            DB::commit();
            $messages_insert = 'Insert data successfully';

            Session::flash('message', $messages_insert);

            return json_encode(array(
                "statusCode" => Response::HTTP_OK,
                "document" => $category,
                "message" => __('document.created_success')
            ), JSON_THROW_ON_ERROR);

            DB::rollBack();
        } catch (\Exception $error) {
            DB::rollBack();
            throw $error;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        if (!$user) {
            return json_encode(array(
                "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "message" => __('messages.data.not.exist')
            ), JSON_THROW_ON_ERROR);
        }

        return response()->json(
            compact(
                'user'
            )
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        $array_role = str_split($request->role, 1);
        //Validate data
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
            ],
            'email' => [
                'required',
                'email',
                ValidationRule::unique('users', 'email')->ignore($user->id)
            ],
        ]);



        //Validate errors
        if ($validator->fails()) {
            return json_encode(array(
                "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "message" => $validator->errors()
            ), JSON_THROW_ON_ERROR);
        }

        //Update department
        $status = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $array_role[1],
        ]);

        if ($status) {
            DB::commit();

            $messages_update =  'Update User ' . $id . ' successfully!';

            Session::flash('message', $messages_update);

            return json_encode(array(
                "statusCode" => Response::HTTP_OK,
                "document" => $user,
                "message" => __('messages.updated_success')
            ), JSON_THROW_ON_ERROR);
        }

        DB::rollBack();

        return json_encode(array(
            "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
            "message" => __('messages.updated_success')
        ), JSON_THROW_ON_ERROR);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
