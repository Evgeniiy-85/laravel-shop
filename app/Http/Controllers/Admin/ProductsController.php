<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\ProductsRequest;
use App\Models\Product;
use App\Models\Category;


class ProductsController extends Controller {

    public function index() {
        $products = Product::all();

        return view('admin.products.index', [
            'products' => $products,
        ]);
    }

    public function add() {
        return view('admin.products.add', [
            'categories' => Category::all(),
            'statuses' => Product::getStatuses(),
        ]);
    }


    public function edit($id) {
        $product = Product::find($id);

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'statuses' => Product::getStatuses(),
        ]);
    }

    /**
     * @param ProductsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(ProductsRequest $request) {
        $product = new Product();
        $product->prod_title = $request->input('prod_title');
        $product->prod_category = $request->input('prod_category');
        $product->prod_alias = $request->input('prod_alias');
        if (!$product->prod_alias) {
            $product->prod_alias = Helper::createAlias($product->prod_title);
        }
        $product->prod_image = '';
        $product->prod_price = $request->input('prod_price');
        $product->prod_quantity = $request->input('prod_quantity');
        $product->prod_status = $request->input('prod_status');
        $res = $product->save();

        return redirect()->route('admin.products')->with('success', 'Успешно');
    }

    /**
     * @param $id
     * @param ProductsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, ProductsRequest $request) {
        $product = Product::find($id);
        $product->prod_title = $request->input('prod_title');
        $product->prod_category = $request->input('prod_category');
        $product->prod_alias = $request->input('prod_alias');
        if (!$product->prod_alias) {
            $product->prod_alias = Helper::createAlias($product->prod_title);
        }
        $product->prod_image = '';
        $product->prod_price = $request->input('prod_price');
        $product->prod_quantity = $request->input('prod_quantity');
        $product->prod_status = $request->input('prod_status');
        $res = $product->save();

        return redirect()->route('admin.products')->with('success', 'Успешно');
    }
}
