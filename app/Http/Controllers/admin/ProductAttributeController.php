<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Models\Product;

class ProductAttributeController extends Controller
{
    //  VIEW PRODUCT ATTRIBUTE
    public function index($id)
    {

        return view(
            'admin.catelogue_management.product.product-attribute',
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
        // // dd($data['sku']);
        // echo "<pre>"; print_r($request->sku); die;
        if ($request->isMethod('post')) {
            $data = $request->all();
            foreach ($data['sku'] as $key => $value) {

                // $request->validate([
                //     'sku[]' => 'required|unique:product_attributes',
                //     'size[]' => 'required',
                //     'price[]' => 'required',
                //     'stock[]' => 'required',
                // ], [
                //     'sku[].required' => 'Sku is a required field',
                //     'sku[].unique:product_attributes' => 'Sku must be unique',
                //     'size[].required' => 'Size is a required field',
                //     'price[].required' => 'Price is a required field',
                //     'stock[].required' => 'Stock is a required field'
                // ]);

                $attribute = new ProductAttribute;

                $attribute->product_id = $data['product_id'];
                $attribute->sku = $value;
                $attribute->size = $data['size'][$key];
                $attribute->price = $data['price'][$key];
                $attribute->stock = $data['stock'][$key];
                $attribute->status = 1;
                $attribute->save();
            }

            return redirect()->back()->with('success_msg', 'Attribute has been added successfuly');
        }
    }

    //  ADD PRODUCT ATTRIBUTE
    public function editAttribute(Request $request, $id, $attr_id)
    {
        // $data = $request->all();
        // dd($data);
        // echo "<pre>"; print_r($request->sku); die;
        if ($request->isMethod('post')) {
            $data = $request->all();

            // $request->validate([
            //     'sku[]' => 'required|unique:product_attributes',
            //     'size[]' => 'required',
            //     'price[]' => 'required',
            //     'stock[]' => 'required',
            // ], [
            //     'sku[].required' => 'Sku is a required field',
            //     'sku[].unique:product_attributes' => 'Sku must be unique',
            //     'size[].required' => 'Size is a required field',
            //     'price[].required' => 'Price is a required field',
            //     'stock[].required' => 'Stock is a required field'
            // ]);

            $attribute = ProductAttribute::find($attr_id);

            $attribute->sku = $data['sku'];
            $attribute->size = $data['size'];
            $attribute->price = $data['price'];
            $attribute->stock = $data['stock'];
            $attribute->status = 1;
            $attribute->save();


            return redirect('admin/product-attr/' . $id)->with('success_msg', 'Attribute has been updated successfuly');
        }

        // $productAttributes = ProductAttribute::where('id', $attr_id,)->first()->toArray();
        // dd($productAttributes);
        // echo "<pre>"; print_r($productAttributes); die;

        return view(
            'admin.catelogue_management.product.edit-product-attribute',
            [
                'productAttributes' => ProductAttribute::where('id', $attr_id,)->first()->toArray(),
                'products' => Product::with('category', 'brand')->where('id', $id)->first()->toArray()
            ]
        );
    }

    //  UPDATE PRODUCT ATTRIBUTE STATUS
    public function updateProductAttrStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo '<pre/>'; print_r ($data['status']); die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductAttribute::where('id', $data['status_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
        }
    }

    //  DELETE PRODUCT ATTRIBUTE
    public function destroy($id, $attr_id)
    {
        $data = ProductAttribute::find($attr_id)->delete();
        // dd($data);
        return redirect()->back()->with('success_msg_attr', 'The Product Attribute has been deleted successfully');
    }
}
