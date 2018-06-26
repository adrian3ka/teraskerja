<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\ProductRequest;
use Uuid;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    //
	public function index(){
		
		$product_list = Product::paginate(3);
		$product_count = $product_list->total();
		return view('product.index',compact('product_list','product_count'));
	}
	public function manage(){
		
		$product_list = Auth::user()->product()->paginate(3);
		$product_count = $product_list->total();
		return view('product.manage',compact('product_list','product_count'));
	}
	public function show(Product $product){
		return view('product.show',compact('product'));
	}
	public function create(){
		return view('product.create');
	}
	 public function store(ProductRequest $request)
    {
        //
		
		
		$data = $request->all();
		$data['id_user'] = Auth::user()->id;
		
		// Disini proses generate uuid, ambil angka constant aja
        $data['id'] = Uuid::generate(4);
		
		Product::create($data);
		//Session::flash('flash_message','Data kelas berhasil disimpan.');
		
		//echo $product_list;
		return redirect('product');
    }
}
