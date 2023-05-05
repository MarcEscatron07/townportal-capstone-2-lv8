<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Network;
use App\Models\Computer;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('computers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $networks = Network::get();
        $statuses = Status::get();
        $units = config('global.units');
        return view('computers.create', compact('networks', 'statuses', 'units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $new = new Computer($data);

        if($new->save()) {
            return redirect()->route('computers.create')
            ->with('success', 'Successfully added new computer!');
        } else {
            return redirect()->route('computers.create')
            ->with('failed', 'Unable to add new computer...');
        }
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
        $computer = Computer::findOrFail($id);
        $networks = Network::get();
        $statuses = Status::get();
        $units = config('global.units');
        return view('computers.edit', compact('id', 'computer', 'networks', 'statuses', 'units'));
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
        $computer = Computer::findOrFail($id);
        // dd($network);
        $data = $request->all();
        // dd($data);

        $computer->network_id = $data['network_id'] ?? null;
        $computer->status_id = $data['status_id'] ?? null;
        $computer->name = $data['name'] ?? null;
        $computer->unit = $data['unit'] ?? null;
        $computer->remarks = $data['remarks'] ?? null;

        if($computer->save()) {
            return redirect()->route('computers.edit', $computer->id)
            ->with('success', 'Successfully updated computer!');
        } else {
            return redirect()->route('computers.edit', $computer->id)
            ->with('failed', 'Unable to update computer...');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $computer = Computer::findOrFail($id);
        $computer->delete();

        return redirect()->route('computers.index')->with('success','Deleted successfully');
    }

    public function data(Request $request) {
        if($request->ajax()) {
            $data = Computer::get();

            return DataTables::of($data)
                ->addColumn('action', function(Computer $computer){
                    $showUrl = route('computers.show', $computer->id);
                    $editUrl = route('computers.edit', $computer->id);
                    $delUrl = route('computers.destroy', $computer->id);

                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="'.$showUrl.'" class="btn btn-info rounded mx-1" title="Show"><i class="fa fa-eye"></i></a>
                              <a href="'.$editUrl.'" class="btn btn-warning rounded mx-1" title="Edit"><i class="fa fa-edit"></i></a>
                              <a href="'.$delUrl.'" class="btn btn-danger rounded mx-1 btn-delete" title="Delete"><i class="fa fa-trash"></i></a>
                              <form action="'.$delUrl.'" method="POST" style="display: none;" class="form-delete">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>
                            </div>';
                })->editColumn('network_id', function(Computer $computer){
                    return $computer->formattedNetwork();
                })->editColumn('status_id', function(Computer $computer){
                    return $computer->formattedStatus();
                })
                ->rawColumns(['action'])->make(true);
        }
    }
}
