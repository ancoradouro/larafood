<?php

namespace App\Http\Controllers\Auth;

use App\Models\{
    User,
    Plan,
    Tenant,
};
use Illuminate\Support\Facades\{
    Auth,
    Hash,
    DB,
};
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;


class RegisteredUserController extends Controller
{
    public $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    
    public function create($url)
    {
        $plan = $this->plan->where('url', $url)->first();

        if (!$plan)
            return redirect()->back();

        return view('auth.register', [
            'plan' => $plan
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cnpj' => 'required|regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\\-\d{2}$/'
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if(!$plan = $this->plan){
            return redirect()->router('site.home');
        }

        /*
        $data = $request->all();
        $tenants = $plan->tenants()->create({
            'cnpj' => $request->cnpj,
            'name' => $request->name,
            'url' => Str::kebab($request->url),
            'email' => $request->email,
            'plan_id' => $data['plan_id'],
        });
        */
         
        DB::beginTransaction();

        try{

            $ten = new Tenant();
            $ten->name = $request->name;
            $ten->cnpj = $request->cnpj;
            $ten->url = Str::kebab($request->name);
            $ten->email = $request->email;
            $ten->plan_id = $request->plan_id;
            $ten->save();
        
            $user = $ten->users()->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            DB::commit();

            event(new Registered($user));

            Auth::login($user);
        
        }catch(\Exception $e){
            DB::rollback();
            //return redirect()->route('user.index')
            //return redirect()->route('register', $plan->url)->with('warning','Something Went Wrong!');
            dd($e);
        }
        
        return redirect('/admin');
    }
}
