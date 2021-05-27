<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailPlan;
use App\Models\Plan;


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

}
