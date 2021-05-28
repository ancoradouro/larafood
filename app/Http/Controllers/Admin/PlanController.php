<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlanController extends Controller
{
    private $repository;
    protected $num_pagination = 10;

    public function __construct(Plan $plan)
    {
        $this->repository = $plan;
    }

    public function index()
    {
        $plans = $this->repository->latest()->paginate($this->num_pagination);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
        ]);
    }

    public function create()
    {
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlan $request)
    {
        
        $plan = new Plan();
        $plan->name = $request->name;
        $plan->description = $request->description;
        $plan->url = Str::kebab($request->name);
        $plan->price = $request->price;
        $plan->save();
        
        //$this->repository->create($request->all());

        //return redirect('/plans')->with('message', 'Plano criado com sucesso');
        return redirect()->route('plans.index', ['message' => 'Deu certo']); //passa parametro assim ?message=Deu%20certo
        
    }

    public function show($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)return redirect()->back();

        return view('admin.pages.plans.show', [
            'plan' => $plan
        ]);
    }

    public function destroy($url)
    {
        $plan = $this->repository->with('details')->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        //dd($plan);//->details->count();

        if($plan->details->count() > 0){
            return redirect()->back()->with('error','Exitem detalhes vinculados ao plano, impossível deletar registro.');
        }
        $plan->delete();

        return redirect()->route('plans.index');
    }

    public function search(Request $request)
    {
        //dd($request->all());
        //$filters = $request->all();
        $filters = $request->except('_token');

        $plans = $this->repository->search($request->filter);

        return view('admin.pages.plans.index', [
            'plans' => $plans,
            'filters' => $filters,
        ]);
    }

    public function edit($url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        return view('admin.pages.plans.edit', [
            'plan' => $plan
        ]);
    }

    public function update(StoreUpdatePlan $request, $url)
    {
        $plan = $this->repository->where('url', $url)->first();

        if (!$plan)return redirect()->back();

        $plan->update($request->all());

        return redirect()->route('plans.index')->with('success', 'Salvo com sucesso'); //https://stackoverflow.com/questions/19838978/laravel-redirect-back-with-message
    }
}
