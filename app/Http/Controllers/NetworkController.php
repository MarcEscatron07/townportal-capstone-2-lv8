<?php

namespace App\Http\Controllers;

use App\Models\Network;
use App\Models\Provider;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class NetworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('networks.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $providers = Provider::get();
        return view('networks.create', compact('providers'));
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
        $new = new Network($data);

        if($new->save()) {
            return redirect()->route('networks.create')
            ->with('success', 'Successfully added new network!');
        } else {
            return redirect()->route('networks.create')
            ->with('failed', 'Unable to add new network...');
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
        $network = Network::with(['computers'])->findOrFail($id);
        $computers = $network->computers()->get();
        return view('networks.show', compact('id', 'network', 'computers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $network = Network::with(['computers'])->findOrFail($id);
        $providers = Provider::get();
        return view('networks.edit', compact('id', 'network', 'providers'));
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
        $network = Network::with(['computers'])->findOrFail($id);
        // dd($network);
        $data = $request->all();
        // dd($data);

        $network->provider_id = $data['provider_id'] ?? null;
        $network->name = $data['name'] ?? null;
        $network->cost = $data['cost'] ?? null;
        $network->remarks = $data['remarks'] ?? null;

        /* update Computers here */

        if($network->save()) {
            return redirect()->route('networks.edit', $network->id)
            ->with('success', 'Successfully updated network!');
        } else {
            return redirect()->route('networks.edit', $network->id)
            ->with('failed', 'Unable to update network...');
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
        $network = Network::findOrFail($id);
        $network->delete();

        return redirect()->route('networks.index')->with('success','Deleted successfully');
    }

    public function data(Request $request) {
        if($request->ajax()) {
            $data = Network::get();

            return DataTables::of($data)
                ->addColumn('action', function(Network $network){
                    $showUrl = route('networks.show', $network->id);
                    $editUrl = route('networks.edit', $network->id);
                    $delUrl = route('networks.destroy', $network->id);

                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="'.$showUrl.'" class="btn btn-info rounded mx-1" title="Show"><i class="fa fa-eye"></i></a>
                              <a href="'.$editUrl.'" class="btn btn-warning rounded mx-1" title="Edit"><i class="fa fa-edit"></i></a>
                              <a href="'.$delUrl.'" class="btn btn-danger rounded mx-1 btn-delete" title="Delete"><i class="fa fa-trash"></i></a>
                              <form action="'.$delUrl.'" method="POST" style="display: none;" class="form-delete">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>
                            </div>';
                })->editColumn('provider_id', function(Network $network){
                    return $network->formattedProvider();
                })
                ->rawColumns(['action'])->make(true);
        }
    }
}
