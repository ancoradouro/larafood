<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use Illuminate\Http\Request;
use App\Models\{
    DetailPlan,
    Plan,
};


class DetailPlanController extends Controller
{
    protected $repository, $plan;
    protected $num_pagination = 10;

    public function __construct(DetailPlan $detailsPlan, Plan $plan)
    {
        $this->repository = $detailsPlan;
        $this->plan = $plan;
    }

    public function index($idPlan)
    {
        if (!$plan = $this->plan->where('id', $idPlan)->first()) {
            return redirect()->back();
        }

        //$details = $plan->details();
        $details = $plan->details()->paginate($this->num_pagination);

        return view('admin.pages.plans.details.index', [
            'plan' => $plan,
            'details' => $details,
        ]);
    }

    public function create($urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }
        return view('admin.pages.plans.details.create',[
            'plan' => $plan,
        ]);
    }

    public function store(StoreUpdateDetailPlan $request, $urlPlan)
    {
        if (!$plan = $this->plan->where('url', $urlPlan)->first()) {
            return redirect()->back();
        }


        //$data = $request->all();
        //$data['plans_id'] = $plan->id;
        //$this->repository->create();
        $plan->details()->create($request->all());

        return redirect()->route('details.plan.index', $plan->id );
    }

    public function edit($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if (!$plan || !$detail) {
            return redirect()->back();
        }
        return view('admin.pages.plans.details.edit',[
            'plan' => $plan,
            'detail' => $detail,
        ]);
    }

    public function update(StoreUpdateDetailPlan $request, $urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->update($request->all());
        //$plan->details()->create($request->all());

        return redirect()->route('details.plan.index', $plan->id )->with('success', 'Salvo com sucesso');
    }

    public function show($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if (!$plan || !$detail) {
            return redirect()->back();
        }
        return view('admin.pages.plans.details.show',[
            'plan' => $plan,
            'detail' => $detail,
        ]);
    }


    public function destroy($urlPlan, $idDetail)
    {
        $plan = $this->plan->where('url', $urlPlan)->first();
        $detail = $this->repository->find($idDetail);
        if (!$plan || !$detail) {
            return redirect()->back();
        }

        $detail->delete();
        //$plan->details()->create($request->all());

        return redirect()->route('details.plan.index', $plan->id )->with('success', 'Salvo com sucesso');
    }
}
