<?php
 
namespace App\Http\Controllers;
 
use App\Product;
use App\User; 
use App\Rating;
use App\Promotion;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Notification;
//use Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
 
class ProductController extends Controller
{   
    
 
    public function index(){
        
        $products = Product::paginate(5);
        
        if (request('q')) {
             $products = Product::where('name', 'like', '%'.request('q').'%')
             ->paginate(5);
        }
        
        if (request('n')) {
             $products = Product::where('id','like','%'.request('n').'%')
             ->paginate(5);
        }
        
        return view('admin.products',['products' => $products]);
    }
 
    public function destroy($id){
        Product::destroy($id);
        return redirect('/admin/products');
    }
 
    public function newProduct(){
        return view('admin.new');
    }
 
    public function add() {
 
        
        $baseDir = Request::file('file');
        //$extension = $file->getClientOriginalExtension();
        //Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));
        
        $file = request()->file('file')->store($baseDir, 'public');
        
        //$entry = new \App\File();
        //$entry->mime = $file->getClientMimeType();
        //$entry->original_filename = $file->getClientOriginalName();
        //$entry->filename = $file->getFilename().'.'.$extension;
 
        //$entry->save();
 
        $product  = new Product();
        
        $product->file_id=$file;
        //$product->file_id=$entry->id;
        $product->name =Request::input('name');
        $product->brand =Request::input('brand');
        $product->description =Request::input('description');
        $product->price =Request::input('price');
        $product->author =Request::input('author');
        $product->isbn =Request::input('isbn');
        //$product->imageurl =Request::input('imageurl');
 
        $product->save();
 
        return redirect('/admin/products');
 
    }
    
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
           'name' => 'required|string|max:255',
           'description' => 'required|string|max:255',
            'price' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|integer|regex:/^(\d{13})?$/|unique:products',
            'file' => 'required'
        ]);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v);
        }else{

        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'description' => 'required|string|max:255',
        //     'price' => 'required|max:255',
        //     'author' => 'required|string|max:255',
        //     'isbn' => 'required|string|max:255'
        // ]);
            
        $baseDir = request('file');
        $file = request()->file('file')->store($baseDir, 'public');
        
 
        $product  = new Product();
        
        $product->file_id=$file;
        $product->name = request('name');
        $product->brand = request('brand');
        $product->description = request('description');
        $product->price = request('price');
        $product->author = request('author');
        $product->isbn = request('isbn');
 
        $product->save();
 
        return redirect('/admin/products');
        }

    //
    }
    
    public function newPromotion(){
        return view('admin.promotion');
    }
    
    public function addcode() {

        $promotion  = new Promotion();
        $promotion->uid =request('uid');
        $promotion->code =request('pcode');

        $notification  = new Notification();
        $notification->user_id = request('uid');
        $notification->notifiable_id = 0;
        $notification->notifiable_type = 'promotion';
        $notification->data = request('pcode');

        $notification->save();
        $promotion->save();
        return redirect('/admin/products');
 
    }
    
    //productDetail
    public function productDetail(Product $product){
        

        $ratings = Rating::where('product_id',$product->id)->get();
        
        //$items = $cart->cartItems;
        $counts = Rating::where('product_id',$product->id)->get();
        $total=0;
        foreach($counts as $count){
            $total+=$count->star;
        }
        
        $number=0;
        foreach($counts as $count){
            $number+=1;
        }
        
        if ($number!=0) $averagestar= $total/$number;
        else $averagestar = 0;
        
        $averagestar = round($averagestar,2);
        
        return view('products.productdetail', compact('product','ratings','averagestar'));
    }
}