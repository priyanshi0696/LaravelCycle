<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banners;
use App\Models\Client;
use App\Models\Product;

use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
   public function banner()
   {

    $data=Banners::get()->toArray();

    return view('admin.banner.banner')->with(compact('data'));

   }

   public function banneradd(Request $request)
{

    $bannerID = $request->banner_id;

    $banner = Banners::updateOrCreate(
        ['id' => $bannerID],
        [
            'banner_title' => $request->title,
            'banner_description' => $request->description,
        ]
    );

    if ($request->hasFile('image')) {
        $image_tmp = $request->file('image');

        if ($image_tmp->isValid()) {
            $extension = $image_tmp->getClientOriginalExtension();
            $imageName = rand(111, 99999) . '' . $extension;
            $imagepath = 'user/images/bannerimage/' . $imageName;
            Image::make($image_tmp)->save($imagepath);

            $banner->banner_image = $imageName;
        }
    }

    $banner->save();

    return response()->json(['success' => 'Saved successfully.']);
}

public function banneredit($id)
{

    $where = array('id' => $id);
    $banner  = Banners::where($where)->first();

    return Response::json($banner);
}
public function bannerdelete($id)
{
    $banner = Banners::where('id',$id)->delete();

    return Response::json(['success' => 'Delete successfully.']);
}

public function productadd(Request $request)
{

    $productID = $request->product_id;

    $product = Product::updateOrCreate(
        ['id' => $productID],
        [
            'product_title' => $request->title,
            'product_description' => $request->description,
            'price' =>$request->price,
        ]
    );

    if ($request->hasFile('image')) {
        $image_tmp = $request->file('image');

        if ($image_tmp->isValid()) {
            $extension = $image_tmp->getClientOriginalExtension();
            $imageName = rand(111, 99999) . '' . $extension;
            $imagepath = 'user/images/productimage/' . $imageName;
            Image::make($image_tmp)->save($imagepath);

            $product->image = $imageName;
        }
    }

    $product->save();

    return response()->json(['success' => 'Saved successfully.']);
}

public function productedit($id)
{

    $where = array('id' => $id);
    $product  = Product::where($where)->first();

    return Response::json($product);
}
public function productdelete($id)
{
    $product = Product::where('id',$id)->delete();

    return Response::json(['success' => 'Delete successfully.']);
}

public function clientadd(Request $request)
{

    $clientID = $request->client_id;

    $client = Client::updateOrCreate(
        ['id' => $clientID],
        [
            'client_name' => $request->name,
            'client_description' => $request->description,

        ]
    );

    if ($request->hasFile('image')) {
        $image_tmp = $request->file('image');

        if ($image_tmp->isValid()) {
            $extension = $image_tmp->getClientOriginalExtension();
            $imageName = rand(111, 99999) . '' . $extension;
            $imagepath = 'user/images/clientimage/' . $imageName;
            Image::make($image_tmp)->save($imagepath);

            $client->client_image = $imageName;
        }
    }

    $client->save();

    return response()->json(['success' => 'Saved successfully.']);
}

public function clientedit($id)
{

    $where = array('id' => $id);
    $client  = Client::where($where)->first();

    return Response::json($client);
}
public function clientdelete($id)
{
    $client = Client::where('id',$id)->delete();

    return Response::json(['success' => 'Delete successfully.']);
}


public function product()
{

 $data=Product::get()->toArray();

 return view('admin.product.product')->with(compact('data'));

}




public function client()
   {

    $data=Client::get()->toArray();

    return view('admin.client.client')->with(compact('data'));

   }



}