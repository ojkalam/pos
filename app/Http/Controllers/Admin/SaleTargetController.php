<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SaleTarget;
use App\Sell;

class SaleTargetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saletargets = SaleTarget::orderBy('id', 'desc')->get();

        return view('backend.saletarget.index', compact('saletargets'));
    }

    //
    public static function getTotalPaid ($startdate, $enddate)
    {
        $total_sale = Sell::whereBetween('created_at', [$startdate, $enddate])->sum('paid');
        return round($total_sale);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request, [
                'start_date'          => 'required',
                'end_date'            => 'required',
                'target_amount'      => 'required|integer'
            ]);

        $setOtherExp = SaleTarget::all();
        foreach ($setOtherExp as $targets) {
            $each_target = SaleTarget::find($targets->id);
            $each_target->status = 0;
            $each_target->save();
        }

        $sale_target = new SaleTarget;
        $sale_target->start_date = $request->start_date;
        $sale_target->end_date = $request->end_date;
        $sale_target->target_amount = $request->target_amount;
        $sale_target->save();


        return redirect()->route('saletargets.index')->with('successMsg','Sales Target made successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $saletarget = SaleTarget::findOrFail($id);

        return view('backend.saletarget.edit', compact('saletarget'));
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
        $this->validate($request, [
                'start_date'          => 'required',
                'end_date'            => 'required',
                'target_amount'      => 'required|integer'
            ]);

        $sale_target = SaleTarget::find($id);

        $sale_target->start_date = $request->start_date;
        $sale_target->end_date = $request->end_date;
        $sale_target->target_amount = $request->target_amount;
        $sale_target->save();

        return redirect()->route('saletargets.index')->with('successMsg','Sales Target updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $saletarget = SaleTarget::find($id);

        $saletarget->delete();

        return redirect()->back()->with('successMsg','Sale Target Successfully Delete');
    }
}
