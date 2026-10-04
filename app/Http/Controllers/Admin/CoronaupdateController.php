<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoronaUpdate;

class CoronaupdateController extends Controller
{
    public function corona()
    {
        $data = CoronaUpdate::first();
        return view('admin.corona_news', compact('data'));
    }

    public function update_corona_news(Request $request, $id)
    {
        $data = CoronaUpdate::find($id);
        $data->w_total_case = $request->w_total_case;
        $data->w_total_recover = $request->w_total_recover;
        $data->w_total_death = $request->w_total_death;
        $data->bd_total_case = $request->bd_total_case;
        $data->bd_total_recover = $request->bd_total_recover;
        $data->bd_total_death = $request->bd_total_death;
        $data->status = $request->status;
        $data->save();

        $notification=array(
            'message' => 'Successfully Done',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
        
    }

}
