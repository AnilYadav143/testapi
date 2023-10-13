<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductType;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\VariationType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    // public function __construct()
    // {
    //     // Share data to all views
    //     if (auth()->check()) {
    //         view()->share('globalData', ['key' => 'value']);
    //     } 
        
        
    // }
    
    public function registerForm()
    {
        $roles = Role::get();
        return view('register',compact('roles'));
    }
    public function register(Request $request)
    {
        // return $request->mobile;
        $request->validate([
            'role_id' => 'required',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|strin   g|min:6',
            'mobile' => 'required|numeric|min:10',
            'profile' => 'mimes:jpeg,jpg,png,gif|required',
        ]);
        if($request->has('profile')){
            $name =  'profile'.rand(0,1000).time().'.'.$request->profile->extension();
            $path =   public_path().'/admin/profile_img';
            $request->profile->move($path,$name);
            $profile = 'admin/profile_img/'.$name;
          }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile' => $request->mobile,
            'profile' => $profile,
        ]);
        $user->assignRole($request->role_id);
        if($user){
            return response()->json(['message' => 'Registration successful', 200]);
        }else{
            return response()->json(['message' => 'something went wrong!', 201]);
        }
    }
    
    public function Login(){
        return view('login');
    }
    public function postlogin(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('MyAppToken')->accessToken;
            return response()->json(['token' => $token],200);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    public function Dashboard(){
        return view('admin.dashboard');
    }
    /**
     * Add Product View
     **/
    public function AddProduct(Request $request){
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        $product_type = ProductType::where('status', 1)->get();
        // $variation_type = VariationType::where('status', 1)->get();
        if($request->method()=='GET')
        {
            return view('admin.add_product', compact('categories','product_type'));
        }
        if($request->method()=='POST')
        {
            $validator = $request->validate([
                'p_name'      => 'required',
                'p_categry_id' => 'required',
                'p_description' => 'required',
                'p_type_id' => 'required',
                'p_variation' => 'required',
                'p_var_value' => 'required',
                'p_price' => 'required',
                'p_qty' => 'required',
                'p_discout_type' => 'required',
                'p_discout' => 'required',
                'p_image' => 'required',
                
            ]);
            if($request->has('p_image')){
                $path_img = array();
                // dd($request->all());
                for($i=0;count($request->p_image)>$i;$i++){
                    $name =  'p_image'.rand(0,1000).time().'.'.$request->p_image[$i]->extension();
                    $path =   public_path().'/admin/product_image';
                    $request->p_image[$i]->move($path,$name);
                    $path_img[] = 'admin/product_image/'.$name;
                }
            }
            $res = Product::create([
                'p_name'      => $request->p_name,
                'p_categry_id' => $request->p_categry_id,
                'p_description' => $request->p_description,
                'p_type_id' => $request->p_type_id,
                'p_variation' => json_encode($request->p_variation),
                'p_var_value' => json_encode($request->p_var_value),
                'p_price' => json_encode($request->p_price),
                'p_qty' => json_encode($request->p_qty),
                'p_discout_type' => json_encode($request->p_discout_type),
                'p_discout' => json_encode($request->p_discout),
                'p_image' => json_encode($path_img),
            ]);
            if($res){
                Alert::success('Success Title', 'Success Product added');
                return redirect()->back();
            }else{
                Alert::error('Error Title', 'Error Product not added');
                return redirect()->back();
            }

        }
    }
    /**
     * Manage Product View
     **/
    public function ManageProduct(){
        $products = Product::get();
        $category = Category::with('subcategory')->get();
        return view('admin.manage_product',compact('products','category'));
    }
    public function ProDelete(string $id)
    {
        $data = Product::find($id);
        // dd(json_decode($data->p_image));
        if($data->delete()){
            foreach(json_decode($data->p_image) as $delimg){
                if (file_exists($delimg)) {
                    unlink($delimg);
                }
            }
            Alert::alert('Great', 'Product Deleted successfully');
            return redirect()->back();  
       }else{
            Alert::alert('Error', 'Product not Deleted');
            return redirect()->back();
       }
    }
    /**
     * Product edit
     **/
    public function ProEdit($id)
    {
        // dd($id);
        $single_data   = Product::find($id);
        $product_type = ProductType::where('status', 1)->get();
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('admin.add_product',compact('single_data','categories','product_type'));
    }
    public function ProUpdate(Request $request, $id){
        // dd($request->all());
            $validator = $request->validate([
                'p_name'      => 'required',
                'p_categry_id' => 'required',
                'p_description' => 'required',
                'p_type_id' => 'required',
                'p_variation' => 'required',
                'p_var_value' => 'required',
                'p_price' => 'required',
                'p_qty' => 'required',
                'p_discout_type' => 'required',
                'p_discout' => 'required',
                
            ]);
            if($request->has('p_image')){
                $path_img = array();
                // dd($request->all());
                for($i=0;count($request->p_image)>$i;$i++){
                    $name =  'p_image'.rand(0,1000).time().'.'.$request->p_image[$i]->extension();
                    $path =   public_path().'/admin/product_image';
                    $request->p_image[$i]->move($path,$name);
                    $path_img[] = 'admin/product_image/'.$name;
                }
                Product::find($id)->update(['p_image'=>json_encode($path_img)]);
            }
            $res = Product::find($id)->update([
                'p_name'      => $request->p_name,
                'p_categry_id' => $request->p_categry_id,
                'p_description' => $request->p_description,
                'p_type_id' => $request->p_type_id,
                'p_variation' => json_encode($request->p_variation),
                'p_var_value' => json_encode($request->p_var_value),
                'p_price' => json_encode($request->p_price),
                'p_qty' => json_encode($request->p_qty),
                'p_discout_type' => json_encode($request->p_discout_type),
                'p_discout' => json_encode($request->p_discout),
            ]);
            if($res){
                Alert::success('Success Title', 'Success Product Updated');
                return redirect()->back();
            }else{
                Alert::error('Error Title', 'Error Product not Updated');
                return redirect()->back();
            }
    }
    
    /**
     * store Category and View
     **/
    public function AddCategory(Request $request)
    {
        
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        if($request->method()=='GET')
        {
            return view('admin.add_category', compact('categories'));
        } 
        if($request->method()=='POST')
        {
            // dd($request->all());
            $validator = $request->validate([
                'category_name'      => 'required',
                'description' => 'required',
                'category_image' => 'required',
                // 'slug'      => 'required|unique:categories',
                'parent_id' => 'nullable|numeric'
                
            ]);
            if($request->has('category_image')){
                $name =  'category'.rand(0,1000).time().'.'.$request->category_image->extension();
                $path =   public_path().'/admin/category_img';
                $request->category_image->move($path,$name);
                $path_img = 'admin/category_img/'.$name;
              }
            $res = Category::create([
                'name' => $request->category_name,
                'description' => $request->description,
                'image' =>$path_img,
                'parent_id' =>$request->parent_id
            ]);
            if($res){
                Alert::success('Success Title', 'Success Category added');
                return redirect()->back();
            }else{
                Alert::error('Error Title', 'Error Category not added');
                return redirect()->back();
            }
        }
    }
    /**
     * category and subcategory delete functions
     **/
    public function CatDelete(string $id)
    {
        $data = $this->deleteCategoryAndSubcategories($id);
        return redirect()->back()->with('toast_success', 'Category deleted successfully');
    }
    public function deleteCategoryAndSubcategories($categoryId)
    {
        $category = Category::find($categoryId);

        if (!$category) {
            return redirect()->back()->with('toast_success', 'not deleted Category');
        }

        $subcategories = Category::where('parent_id', $category->id)->get();

        foreach ($subcategories as $subcategory) {
            $this->deleteCategoryAndSubcategories($subcategory->id);
        }

        $category->delete();
    }

    /**
     * category edit
     **/
    public function CatEdit($id)
    {
        $single_data = Category::find($id);
        $categories = Category::where('parent_id', null)->orderby('name', 'asc')->get();
        return view('admin.add_category',compact('single_data','categories'));
    }
    /**
     * category UPDATE
     **/
    public function CatUpdate(Request $request, $id)
    {
        $validator = $request->validate([
            'category_name'      => 'required',
            'description' => 'required',
            'parent_id' => 'nullable|numeric'
        ]);
        if($request->has('category_image')){
            $name =  'category'.rand(0,1000).time().'.'.$request->category_image->extension();
            $path =   public_path().'/admin/category_img';
            $request->category_image->move($path,$name);
            $path_img = 'admin/category_img/'.$name;
            Category::find($id)->update(['profile'=>$path_img]);
        }
        $res = Category::find($id)->update([
            'name' => $request->category_name,
            'description' => $request->description,
            'parent_id' =>$request->parent_id
        ]);
        if($res){
            Alert::success('Success Title', 'Success Category Updated');
            return redirect()->back();
        }else{
            Alert::error('Error Title', 'Error Category not Updated');
            return redirect()->back();
        }
    }

    /**
     * AssignRole role assign role to user
     **/
    public function AssignRole(){
        $user = User::get();
        dd($user);
    }
    
    /**
     * Auth Logout
     **/
    public function logout()
    {
        Auth::logout();
        Alert::error('Error Title', 'Error Category not Updated');
        return redirect('login'); // Redirect to the desired page after logout
    }

}
