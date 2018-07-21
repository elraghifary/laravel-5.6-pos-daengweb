<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use File;
use Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|max:10|unique:products',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            // default $photo = null
            $photo = null;
            // if there's is file (photo) uploaded
            if ($request->hasFile('photo')) {
                // then run method saveFile()
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            // store data to table products
            $products = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'stock' => $request->stock,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'photo' => $photo
            ]);
            
            // if success direct to product.index
            return redirect(route('product.index'))->with(['success' => '<strong>' . $products->name . '</strong> has been submitted.']);
        } catch (\Exception $e) {
            // if error direct to previous page and show an error
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $products = Product::findOrFail($id);

        if (!empty($products->photo)) {
            File::delete(public_path('uploads/product/' . $products->photo));
        }

        $products->delete();

        return redirect()->back()->with(['success' => '<strong>' . $products->name . '</strong> was deleted.']);
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);

        $categories = Category::orderBy('name', 'ASC')->get();

        return view('products.edit', compact('products', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required|string|max:10|exists:products,code',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $products = Product::findOrFail($id);
            
            $photo = $products->photo;

            // check if photo exist then delete and add a new one
            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/product/' . $photo)) : null;
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            $products->update([
                'name' => $request->name,
                'description' => $request->description,
                'stock' => $request->stock,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'photo' => $photo
            ]);
            
            return redirect(route('product.index'))->with(['success' => '<strong>' . $products->name . '</strong> has been modified.']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($name, $photo)
    {
        // file name = product name + time + extension
        $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();

        // path for uploaded photo
        $path = public_path('uploads/product');

        // check if folder do not exist
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        }

        // if folder exist
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }
}
