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
use DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        $query = Supplier::query();
        $search = $request->search;

        $suppliers = $query->when(!empty($search), function($q) use($search) {
            $q->where('name' , 'like', '%' .$search . '%');
        })->orderBy('id', 'desc')->get();

        return view('admin.supplier.index', ['suppliers' => $suppliers]);
    }

    public function getDataForTable()
    {
        return DataTables::of(Supplier::query   ())
        ->addColumn('delete', function ($supplier) {
            return '<a href="javascript:;" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Delete category">
                        <button type="button" class="btn btn-danger button-delete" data-id="' . $supplier->id . '" data-url="' . route('admin.supplier.destroy', $supplier->id) . '">Xóa</button>
                    </a>';
            })
            ->addColumn('update', function ($supplier) {
                // Tùy chỉnh để trả về dữ liệu tìm kiếm cho trường "update"
                return $supplier->updated_at->format('Y-m-d H:i:s');
            })
            ->addColumn('updated_at', function ($product) {
                // Tùy chỉnh để trả về dữ liệu tìm kiếm cho trường "update"
                return $product->updated_at->format('d/m/Y');
            })
            ->addColumn('created_at',function($product){
                return $product->created_at->format('d/m/Y');
            }) 
        ->make(true);

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

            $messages_update =  'Cập nhật nhà cung cấp ' . $id . ' thành công!';

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
            $messages_delete =  'Xóa nhà cung cấp ' . $id . ' thất bại. ';
            Session::flash('error', $messages_delete);
        } else {
            $check = Supplier::find($id)->delete();
            $messages_delete =  'Xóa nhà cung cấp ' . $id . ' thành công';

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
