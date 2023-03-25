<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use Illuminate\Validation;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $request = request();


        $categories = Category::with('parent')


            // leftJoin('categories as parents', 'parents.id' , '=' , 'categories.parent_id')
            // ->select([
            //     'categories.*' ,
            //     'parents.name as parent_name'
            // ])

            // للاستعلام عن عدد المنتجات في كل مخزن

            // ->select('categories.*')
            // ->selectRaw('(SELECT COUNT(*) FROM products WHERE category_id = categories.id) as products_count')

            ->withCount([
                'products as products_number' => function ($query) {
                    $query->where('status', '=', 'active');
        }] ) //هاد نفس الي فوق
        ->filter($request->query())
        ->paginate(10);



        return view('dashboard.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $parents = Category::all();
        $category = new Category();
        return view('dashboard.categories.create', compact('category', 'parents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request )


    {


        $request->validate(Category::rules(),[
            'required'=>'This field (:attribute) is required ',
            'unique'=>'This is name already exists!'

        ]);


    // $category = new Category($request->all());
    // $category->save();

    $request->merge([
        'slug' => str::slug($request->post('name'))
    ]);

    $data = $request->except('image');

        $data['image'] = $this->uploadeImage($request);


    $category = Category::create($data);
    // PRG

    return redirect()->route('dashboard.categorise.index')->with('success', 'Category Created!');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('dashboard.categories.show', [
            'category' => $category

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNull('parent_id')
                    ->orwhere('parent_id', '<>', $id);
            })->get();

        try {
            $category = Category::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('info', 'Record nor found!');
        }

        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {


        $category = Category::findOrFail($id);

        $old_image = $category->image;

        $data = $request->except('image');

        $new_image = $this->uploadeImage($request);
        if($new_image){
            $data['image'] = $new_image;
        }

        $category->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('dashboard.categorise.index')->with('success', 'Category Updated!') ;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        // if ($category->image){
        //     Storage::disk('public')->delete($category->image);
        // }

        return redirect()->route('dashboard.categorise.index')->with('success', 'Category Deleted!');
    }


     protected function uploadeImage( Request $request)
     {

    if (!$request->hasFile('image')) {
        return;
    }
    $file = $request->file('image');
    $path = $file->store('uploads', [
        'disk' => 'public'
    ]);
   return  $path;
}





public function trash(){

        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
}
public function restore(Request $request , $id){

        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->route('dashboard.categories.trash')->with('success' , 'Categoru Restored!');
}
public function forceDelete( $id){

        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();

         if ($category->image){
            Storage::disk('public')->delete($category->image);
        }

        return redirect()->route('dashboard.categories.trash')->with('success' , 'Categoru Deleted Forever!');
}















}
