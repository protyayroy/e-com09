<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;
use App\Models\Product;

class ProductAttributeController extends Controller
{
    public function index($id){

        // $productAttributes = Product::with('category', 'brand')->where('id', $id)->first()->toArray();
        // dd($productAttributes);

        return view('admin.catelogue_management.product.product-attribute', [
            'productAttributes' => ProductAttribute::get(),
            'products' => Product::with('category', 'brand')->where('id', $id)->first()->toArray(),
            // where('product_id', $id)->first()
        ]);
    }

    public function addAttribute(Request $request){
        // $data = $request->all();
        // // dd($data);
        // echo "<pre>"; print_r($data); die;
        if($request->isMethod('post')){
            $data = $request->all();
            foreach($data['sku'] as $key => $value) {
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
    public function destroy($id)
    { echo $id; die;
        ProductAttribute::find($id)->delete();
        return redirect('admin/product-attr')->with('success_msg', 'The Product Attribute has been deleted successfully');
    }
}
