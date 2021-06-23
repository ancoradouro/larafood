<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Table;
use App\Http\Requests\StoreUpdateTable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\{
    Auth,
    DB,
};

class TableController extends Controller
{

    protected $table, $num_pagination = 10;

    public function __construct(Table $table)
    {
        $this->table = $table;

        $this->middleware(['can:tables']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tables = $this->table->latest()->paginate($this->num_pagination);

        return view('admin.pages.tables.index', [
            'tables' => $tables,
        ]);

        //return view('admin.pages.tables.index', compact('tables') ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTable $request)
    {
        //$data = $request->all();
        //$data['tenant_id'] = Auth::user()->tenant_id;
        //$this->reposiroty->create($data);
        //dd($request->all());

        $table = new Table();
        $table->identify = $request->identify;
        $table->uuid = Str::uuid()->toString();
        $table->description = $request->description;
        $table->tenant_id = Auth::user()->tenant_id;
        $table->save();

        return redirect()->route('tables.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$table = $this->table->latest()->find($id);
        
        $table = DB::table('tables')
            ->where('tenant_id', '=', Auth::user()->tenant_id)
            ->where('id', '=', $id)
            ->select(['*'])
            //->toSql();
            ->first();
        
        if (!$table){
            return redirect()->back();
        }else return view('admin.pages.tables.show', compact('table'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$table = $this->table->find($id))return redirect()->back();
        
        return view('admin.pages.tables.edit', compact('table'));
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
        if (!$table = $this->table->find($id))return redirect()->back();

        $data = $request->all();
        $table->update($data);
        return redirect()->route('tables.index')->with('success', 'Salvo com sucesso'); ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$table = $this->table->find($id)){
            return redirect()->back();
        }
        $table->delete();
        return redirect()->route('tables.index');
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

        $tables = $this->table->where(function($query) use ($request) {
            if ($request->filter) {
                $query
                    ->orWhere('identify', 'LIKE', "%{$request->filter}%")
                    ->orWhere('description', 'LIKE', "%{$request->filter}%")
                    ->where('tenant_id', '=', Auth::user()->tenant_id);
            }
        })
        ->paginate($this->num_pagination);
        
        return view('admin.pages.tables.index', compact('tables', 'filters'));
    }
}
