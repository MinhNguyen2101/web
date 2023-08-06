<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $suppliers = Supplier::orderBy('id', 'desc')->paginate(8);

        return view('admin.supplier.index', ['suppliers' => $suppliers]);
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
        DB::beginTransaction();

        try {
            //Validate data
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    ValidationRule::unique('suppliers', 'name')
                ],
                'email' => [
                    'required',
                    ValidationRule::unique('suppliers', 'email')
                ],
                'email' => [
                    'email',
                ],
                'telephone' => [
                    'required',
                    ValidationRule::unique('suppliers', 'telephone')
                ],
                'address' => [
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

            $supplier = Supplier::create([
                'name' => $request->name,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'address' => $request->address,
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!$supplier) {
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
                "document" => $supplier,
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
        $supplier = Supplier::find($id);
        if (!$supplier) {
            return json_encode(array(
                "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "message" => __('messages.data.not.exist')
            ), JSON_THROW_ON_ERROR);
        }

        return response()->json(
            compact(
                'supplier'
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
        $supplier = Supplier::find($id);
        // dd($supplier);
        //Validate data
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                ValidationRule::unique('suppliers')->ignore($supplier->id),
            ],
            'email' => [
                'required',
                ValidationRule::unique('suppliers')->ignore($supplier->id),
            ],
            'email' => [
                'email',
            ],
            'telephone' => [
                'required',
                ValidationRule::unique('suppliers', 'telephone')->ignore($supplier->id)
            ],
            'address' => [
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

        //Update department
        $status = $supplier->update([
            'name' => $request->name,
            'description' => $request->description,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'address' => $request->address,
        ]);

        if ($status) {
            DB::commit();

            $messages_update =  'Update Supplier ' . $id . ' successfully!';

            Session::flash('message', $messages_update);

            return json_encode(array(
                "statusCode" => Response::HTTP_OK,
                "document" => $supplier,
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
        $supplier = Supplier::find($id);
        $count_product = Product::where('supplier_id', $id)->count();
        if ($count_product >= 1) {
            $messages_delete =  'Delete Supplier ' . $id . ' fails. Because have product use category ';
            Session::flash('error', $messages_delete);
        } else {
            $check = Supplier::find($id)->delete();
            $messages_delete =  'Delete Supplier ' . $id . ' successfully';

            Session::flash('message', $messages_delete);
            if (!$check) {
                return json_encode(array(
                    "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                    "message" => "Delete fails"
                ), JSON_THROW_ON_ERROR);
            }
        }
    }
}
