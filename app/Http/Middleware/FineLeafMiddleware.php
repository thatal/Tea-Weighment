<?php

namespace App\Http\Middleware;

use App\Models\DailyFineLeafCount;
use App\Services\CommonService;
use Closure;
use Session;

class FineLeafMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // only check if user is factory
        if(CommonService::isFactory()){
            $todays_slab = DailyFineLeafCount::where("factory_id", auth()->id())
                ->whereDate("date", date("Y-m-d"))
                ->count();
            if($todays_slab === 0){
                return redirect()->to(route("factory.fine-leaf.index"))
                    ->with('error', "Please enter todays\'s fine leaf count slab to continue.");
            }
        }
        return $next($request);
    }
}
