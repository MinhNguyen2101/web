<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule as ValidationRule;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::orderBy('id', 'desc')->paginate(8);

        return view('admin.category.index', ['categories' => $categories]);
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
        DB::beginTransaction();

        try {
            //Validate data
            $validator = Validator::make($request->all(), [
                'name' => [
                    'required',
                    ValidationRule::unique('categories', 'name')
                ],
            ]);

            //Validate errors
            if ($validator->fails()) {
                return json_encode(array(
                    "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                    "message" => $validator->errors()
                ), JSON_THROW_ON_ERROR);
            }

            $category = Category::create([
                'name' => $request->name,
                'description' => $request->description,
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
        $category = Category::find($id, ['id', 'name', 'description']);
        if (!$category) {
            return json_encode(array(
                "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
                "message" => __('messages.data.not.exist')
            ), JSON_THROW_ON_ERROR);
        }

        return response()->json(
            compact(
                'category'
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
        $category = Category::find($id);
        //Validate data
        $validator = Validator::make($request->all(), [
            'name' => [
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
        $status = $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if ($status) {
            DB::commit();

            $messages_update =  'Update category '.$id.' successfully!';

            Session::flash('message', $messages_update);

            return json_encode(array(
                "statusCode" => Response::HTTP_OK,
                "document" => $category,
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
        $category = Category::find($id);
        $count_product = Product::where('category_id', $id)->count();
        if ($count_product >= 1) {
            $messages_delete =  'Delete Category ' . $id . ' fails. Because have product use category ';
            Session::flash('error', $messages_delete);
        } else {
            $check = Category::find($id)->delete();
            $messages_delete =  'Delete Category ' . $id . ' successfully';

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
