<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$products = Product::where('deleted_at',null)->get();
    	$status = (count($products) > 0) ? true : false;
        return view('product.products',['products' => $products, 'status' => $status]);
    }

    /**
     * Get records for pagination
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $requestData = $request->all();
        // echo "<pre>"; var_dump($requestData); exit;
        $start = $requestData['start'];
        $limit = $requestData['length'];
        $search = $requestData['search']['value'];
        $orderBy = $requestData['order'][0]['column'];
        $order = $requestData['order'][0]['dir'];
        
        $fieldList = array('id','name','qty','amount','deleted_at','created_at','updated_at');
        $orderBy = $fieldList[$orderBy];

        $totalProductCount = Product::where('deleted_at',null)->count();

        $products = Product::where('deleted_at',null)
                    ->where('name', 'like', "%$search%")
                    ->orWhere('qty', 'like', "%$search%")
                    ->orWhere('amount', 'like', "%$search%")
                    ->orWhere('created_at', 'like', "%$search%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderBy($orderBy, $order)
                    ->get();
        $p = array();
        $i = $start + 1;
        foreach ($products as $product) {
            $p[] = array(
                $i++,
                $product->name,
                $product->qty,
                $product->amount,
                date('Y-m-d H:i:s',strtotime($product->created_at)),
                "<a class='btn btn-sm btn-success' href='".route('editProduct',$product->id)."'> <i class='fas fa-edit'></i> Edit </a>
                <a class='btn btn-sm btn-danger' href='".route('deleteProduct',$product->id)."' onclick='return confirm(\"Are you sure want to delete?\")'><i class='fa fa-trash'></i> Delete </a>"
            );
        }

        $output = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => count($products),
                "recordsFiltered" => $totalProductCount,
                "data" => $p
            );
        echo json_encode($output);
        exit;
    }

    /**
     * Add New Product.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add()
    {
        return view('product.addProduct');
    }

    public function store(Request $request){
    	$product = new Product();
        $data = $this->validate($request, [
            'name'=>'required',
            'qty'=> 'required|numeric',
            'amount'=> 'required|numeric'
        ]);
       
        $product->saveProduct($data);
        return redirect('/products')->with('success', 'New product has been created!');
    }

    /**
     * Edit selected Product.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
    	$product = Product::where('id', $id)->first();
        return view('product.editProduct', compact('product'));
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
        $product = new Product();
        $data = $this->validate($request, [
            'name'=>'required',
            'qty'=> 'required|numeric',
            'amount'=> 'required|numeric'
        ]);
       
        $product->saveProduct($data,$id);

        return redirect('/products')->with('success', 'Product has been updated!!');
    }

    /**
     * Delete selected Product.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function delete($id)
    {
        $product = new Product();
        $product->deleteProduct($id);
        return redirect('/products')->with('success', 'Product has been deleted!!');
    }
    
}
