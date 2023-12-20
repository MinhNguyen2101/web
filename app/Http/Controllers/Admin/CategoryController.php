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
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $query = Category::query();
        $search = $request->search;

        $categories = $query->when(!empty($search), function($q) use($search) {
            $q->where('name' , 'like', '%' .$search . '%');
        })->orderBy('id', 'desc')->paginate(8);

        return view('admin.category.index', ['categories' => $categories]);
    }

    public function getDataForTable()
    {
        return DataTables::of(Category::query   ())
        ->addColumn('delete', function ($category) {
            return '<a href="javascript:;" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Delete category">
                        <button type="button" class="btn btn-danger button-delete" data-id="' . $category->id . '" data-url="' . route('admin.category.destroy', $category->id) . '">Xóa</button>
                    </a>';
            })
        ->addColumn('update', function ($category) {
                // Tùy chỉnh để trả về dữ liệu tìm kiếm cho trường "update"
                return $category->updated_at->format('Y-m-d H:i:s');
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

            $messages_update =  'Cập nhật danh mục '.$id.' thành công!';

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
            $messages_delete =  'Xóa danh mục ' . $id . ' thất bại. Bởi vì sản phẩm sử dụng danh mục ';
            Session::flash('error', $messages_delete);
        } else {
            $check = Category::find($id)->delete();
            $messages_delete =  'Xóa danh mục ' . $id . ' thành công';

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
