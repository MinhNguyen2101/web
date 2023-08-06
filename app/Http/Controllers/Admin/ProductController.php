<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products = Product::orderBy('id', 'desc')->paginate(8);
        $categories = Category::all();
        $suppliers = Supplier::all();

        return view('admin.product.index', compact('products', 'categories', 'suppliers'));
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
                'quantity' => [
                    'required',
                ],
                'price_new' => [
                    'required',
                ],
                'image' => [
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
            $pathImage = $request->file('image')->store('public/product');
            $array = explode('/', $pathImage);
            array_shift($array);
            $image = implode('/', $array);

            $product = Product::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price_old' => $request->price_old,
                'price_new' => $request->price_new,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'image' => $image,
                'description' => $request->description,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if (!$product) {
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
                "document" => $product,
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
        $product = Product::find($id);
        if (!$product) {
            return json_encode(array(
                "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "message" => __('messages.data.not.exist')
            ), JSON_THROW_ON_ERROR);
        }

        return response()->json(
            compact(
                'product'
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
        $product = Product::find($id);
        //Validate data
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
            ],
            'quantity' => [
                'required',
            ],
            'price_new' => [
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
        if ($request->file('image')) {
            $pathImage = $request->file('image')->store('public/product');
            $array = explode('/', $pathImage);
            array_shift($array);
            $image = implode('/', $array);
            $status = $product->update([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price_old' => $request->price_old,
                'price_new' => $request->price_new,
                'category_id' => $request->category_id,
                'supplier_id' => $request->supplier_id,
                'image' => $image,
                'description' => $request->description,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        $status = $product->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price_old' => $request->price_old,
            'price_new' => $request->price_new,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        //Update department


        if ($status) {
            DB::commit();

            $messages_update =  'Update Product ' . $id . ' successfully!';

            Session::flash('message', $messages_update);

            return json_encode(array(
                "statusCode" => Response::HTTP_OK,
                "document" => $product,
                "message" => __('messages.updated_success')
            ), JSON_THROW_ON_ERROR);
        }

        DB::rollBack();

        return json_encode(array(
            "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
            "message" => __('messages.updated_success')
        ), JSON_THROW_ON_ERROR);
    }

    public function changeStatus(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->status = $request->status;
        $product->save();

        $messages_update =  'Update Status product ' . $request->product_id . ' successfully!';
        Session::flash('message', $messages_update);

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
