<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Models\Product;

class ProductAttributeController extends Controller
{
    //  VIEW PRODUCT ATTRIBUTE
    public function productAttr($id)
    {
        return view('admin.catelogue_management.product.attribute.product-attribute',
            [
                'productAttributes' => ProductAttribute::where('product_id', $id)->get()->toArray(),
                'products' => Product::with('category', 'brand')->where('id', $id)->first()->toArray()
            ]
        );
    }

    //  ADD PRODUCT ATTRIBUTE
    public function addAttribute(Request $request)
    {
        // $data = $request->all();
        // echo "<pre>"; print_r($request->all()); die;
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['size'] as $key => $value) {
                $attribute = new ProductAttribute;

                $attribute->product_id = $data['product_id'];
                $attribute->size = $value;
                $attribute->price = $data['price'][$key];
                $attribute->stock = $data['stock'][$key];
                $attribute->stock_limit_alert = $data['stock_limit_alert'][$key];
                $attribute->save();
            }

            return redirect()->back()->with('success_msg', 'Attribute has been added successfuly');
        }
    }

    //  EDIT PRODUCT ATTRIBUTE
    public function editAttribute(Request $request, $attr_id)
    {
        // $data = $request->all();
        // dd($data);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $attribute = ProductAttribute::find($attr_id);

            $attribute->size = $data['edit_size'];
            $attribute->price = $data['edit_price'];
            $attribute->stock = $data['edit_stock'];
            $attribute->stock_limit_alert = $data['edit_stock_limit_alert'];
            $attribute->save();


            return back()->with('success_msg', 'Attribute has been updated successfuly');
        }
    }

    //  DELETE PRODUCT ATTRIBUTE
    public function destroy($product_id, $attr_id)
    {
        // dd($attr_id);
        $data = ProductAttribute::find($attr_id)->delete();
        // dd($data);
        return redirect()->back()->with('success_msg', 'The Product Attribute has been deleted successfully');
    }
}
