<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\Type;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Carbon;

use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allowedOrders = ['desc', 'asc'];
        $orderBy = (in_array($request->input('order_by'), $allowedOrders)) ? $request->input('order_by') : 'desc';

        $allowedSorts = array_keys(__('dbcolumns.products'));
        $sortBy = (in_array($request->input('sort_by'), $allowedSorts)) ? $request->input('sort_by') : 'created_at';

        $limit = (int) $request->input('limit') ?: 15;

        $products = Product::orderBy($sortBy, $orderBy)
            ->paginate($limit);

        $queryParams = Input::except('page');

        return view('products.index', compact('products', 'queryParams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = Attribute::orderBy('id', 'desc')->get();
        $types = Type::orderBy('id', 'desc')->get();

        return view('products.create', compact('attributes', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productData = $request->all();

        $validator = Validator::make($productData, [
            'name' => 'required|max:255',
            'description' => 'nullable|max:255',
            'image' => 'nullable|file'
        ]);

        if ($validator->fails())
        {
            return redirect()
                ->route('products.create')
                ->withErrors($validator, 'store')
                ->withInput();
        }

        if ($request->hasFile('image'))
        {
            $productData['image'] = Storage::disk('public')->putFile('products', $request->file('image'));
        }

        $newProduct = Product::create($productData);

        $responseMessages = [];

        if($request->has('attributes'))
        {
            $attributes = $request->input('attributes');

            foreach($attributes as $attribute)
            {
                $validator = Validator::make($attribute, [
                    'id' => 'integer',
                    'value' => 'max:255'
                ]);

                if ($validator->fails())
                {
                    $responseMessages[] = [
                        'status' => 'warning',
                        'message' => __('products.some_attributes_not_added')
                    ];

                }else{
                    DB::table('products_attributes')->insert([
                        'product_id' => $newProduct->id,
                        'attribute_id' => $attribute['id'],
                        'value' => $attribute['value']
                    ]);
                }
            }
        }

        $responseMessages[] = [
            'status' => 'success',
            'message' => __('products.successful_added')
        ];

        Session::flash('responseMessages', $responseMessages);

        return redirect()->route('products.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $attributes = Attribute::orderBy('id', 'desc')->get();
        $types = Type::orderBy('id', 'desc')->get();

        return view('products.edit', compact('product', 'attributes', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $productData = $request->all();

        $validator = Validator::make($productData, [
            'name' => 'required|max:255',
            'description' => 'nullable|max:255',
            'image' => 'nullable|file',
            'delete' => 'integer'
        ]);

        if ($validator->fails())
        {
            return redirect()
                ->route('products.edit', ['product' => $product->id])
                ->withErrors($validator, 'edit')
                ->withInput();
        }

        if($request->request->has('delete') || $request->hasFile('image')){
            Storage::disk('public')->delete($product->image);

            $productData['image'] = null;
        }

        if ($request->hasFile('image'))
        {
            $productData['image'] = Storage::disk('public')->putFile('products', $request->file('image'));
        }

        $product->update($productData);

        DB::table('products_attributes')
            ->where('product_id', '=', $product->id)
            ->delete();

        $responseMessages = [];

        if($request->has('attributes'))
        {
            $attributes = $request->input('attributes');

            foreach($attributes as $attribute)
            {
                $validator = Validator::make($attribute, [
                    'id' => 'integer',
                    'value' => 'max:255'
                ]);

                if ($validator->fails())
                {
                    $responseMessages[] = [
                        'status' => 'warning',
                        'message' => __('products.some_attributes_not_added')
                    ];
                }else{
                    DB::table('products_attributes')->insert([
                        'product_id' => $product->id,
                        'attribute_id' => $attribute['id'],
                        'value' => $attribute['value']
                    ]);
                }
            }
        }

        $responseMessages[] = [
            'status' => 'success',
            'message' => __('products.successful_updated')
        ];

        Session::flash('responseMessages', $responseMessages);

        return redirect()->route('products.edit', ['product' => $product->id]);
    }

    /**
     * Displays the specified resource deletion confirmation form.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product)
    {
        return view('products.confirmation.delete', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete($product->id);

        Session::flash('responseMessages', [
            [
                'status' => 'success',
                'message' => __('products.successful_deleted')
            ]
        ]);

        return redirect()->route('products.index');
    }
}
