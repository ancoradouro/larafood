<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{

    protected $category, $num_pagination = 10;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->category->latest()->paginate($this->num_pagination);

        return view('admin.pages.categories.index', [
            'categories' => $categories,
        ]);

        //return view('admin.pages.categories.index', compact('categories') ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$data = $request->all();
        //$data['tenant_id'] = Auth::user()->tenant_id;
        //$this->reposiroty->create($data);
        //dd($request->all());
        $category = new Category();
        $category->name = $request->name;
        $category->url = Str::kebab($request->name);
        $category->description = $request->description;
        $category->tenant_id = Auth::user()->tenant_id;
        $category->save();

        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = $this->category->latest()->find($id);
        
        /*$user = DB::table('categories')
            ->where('tenant_id', '=', Auth::user()->tenant_id)
            ->where('id', '=', $id)
            ->select(['*'])
            //->toSql();
            ->first();
        */
        if (!$category){
            return redirect()->back();
        }else return view('admin.pages.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$category = $this->category->find($id))return redirect()->back();
        
        return view('admin.pages.categories.edit', compact('category'));
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
        if (!$category = $this->category->find($id))return redirect()->back();

        $data = $request->all();
        $data['url'] = Str::kebab($request->name);
        $category->update($data);
        return redirect()->route('categories.index')->with('success', 'Salvo com sucesso'); ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$category = $this->category->find($id)){
            return redirect()->back();
        }
        $category->delete();
        return redirect()->route('categories.index');
    }

    /**
     * Search results.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $categories = $this->category->where(function($query) use ($request) {
            if ($request->filter) {
                $query
                    ->orWhere('name', 'LIKE', "%{$request->filter}%")
                    ->orWhere('url', $request->filter)
                    ->where('tenant_id', '=', Auth::user()->tenant_id);
            }
        })
        ->paginate($this->num_pagination);
        
        return view('admin.pages.categories.index', compact('categories', 'filters'));
    }
}
