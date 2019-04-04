<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

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
        return view('products.create');
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

        if ($validator->fails()) {
            return redirect()
                ->route('products.create')
                ->withErrors($validator, 'store')
                ->withInput();
        }

        if ($request->hasFile('image'))
        {
            $productData['image'] = Storage::disk('public')->putFile('products', $request->file('image'));
        }

        Product::create($productData);

        Session::flash('responseMessages', [
            'success' => __('products.successful_added')
        ]);

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
        return view('products.edit', compact('product'));
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

        if ($validator->fails()) {
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

        Session::flash('responseMessages', [
            'success' => __('products.successful_updated')
        ]);

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
            'success' => __('products.successful_deleted')
        ]);

        return redirect()->route('products.index');
    }
}
