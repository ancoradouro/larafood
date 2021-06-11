<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use Illuminate\Http\Request;
use App\Models\{
    User,
    Tenant,
};
use Illuminate\Support\Facades\{
    Auth,
    DB,
};
class UserController extends Controller
{
    protected $repository, $num_pagination = 10;


    public function __construct(User $user)
    {
        $this->repository = $user;
    }


    protected static function booted()
    {
        static::addGlobalScope(new AncientScope);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->latest()->TenantUser()->paginate($this->num_pagination);
        
        /*$users = DB::table('users')
                ->join('tenants', function ($join) {
                    $join->on('users.tenant_id', '=', 'tenants.id');
                })
                ->where('users.tenant_id', '=', Auth::user()->tenant_id)
                ->select(['tenants.name as empresa', 'users.*'])
                //->toSql();
                ->paginate($this->num_pagination);
                //->get();
        */
        //dd($users);
        
        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {

        //$data = $request->all();
        //$data['tenant_id'] = Auth::user()->tenant_id;
        //$this->reposiroty->create($data);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->tenant_id = Auth::user()->tenant_id;
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->latest()->TenantUser()->find($id);
        
        $user = DB::table('users')
            ->join('tenants', function ($join) {
                $join->on('users.tenant_id', '=', 'tenants.id');
            })
            ->where('users.tenant_id', '=', Auth::user()->tenant_id)
            ->where('users.id', '=', $id)
            ->select(['tenants.name as empresa', 'users.*'])
            //->toSql();
            ->first();
        
        if (!$user){
            return redirect()->back();
        }else return view('admin.pages.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$user = $this->repository->TenantUser()->find($id))return redirect()->back();
        
        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request\StoreUpdateUser  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateUser $request, $id)
    {
        if (!$user = $this->repository->TenantUser()->find($id))return redirect()->back();
        
        $data = $request->only(['name','email']);

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'Salvo com sucesso'); ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$user = $this->repository->TenantUser()->find($id)){
            return redirect()->back();
        }
        $user->delete();
        return redirect()->route('users.index');
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

        //$user = $this->repository->TenantUser()->find($id) ->como fazer filtros usando o scopeTenantUser

        $users = $this->repository->where(function($query) use ($request) {
            if ($request->filter) {
                $query
                    ->orWhere('name', 'LIKE', "%{$request->filter}%")
                    ->orWhere('email', $request->filter)
                    ->where('tenant_id', '=', Auth::user()->tenant_id);
            }
        })
        ->TenantUser()
        ->paginate($this->num_pagination);
        
        return view('admin.pages.users.index', compact('users', 'filters'));
    }
}
