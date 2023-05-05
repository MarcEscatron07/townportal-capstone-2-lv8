<?php

namespace App\Http\Controllers;

use App\Models\Peripheral;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PeripheralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('peripherals.index');
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
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function data(Request $request) {
        if($request->ajax()) {
            $data = Peripheral::get();

            return DataTables::of($data)
                ->addColumn('action', function(Peripheral $peripheral){
                    $showUrl = route('peripherals.show', $peripheral->id);
                    $editUrl = route('peripherals.edit', $peripheral->id);
                    $delUrl = route('peripherals.destroy', $peripheral->id);

                    return '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <a href="'.$showUrl.'" class="btn btn-info rounded mx-1" title="Show"><i class="fa fa-eye"></i></a>
                              <a href="'.$editUrl.'" class="btn btn-warning rounded mx-1" title="Edit"><i class="fa fa-edit"></i></a>
                              <a href="'.$delUrl.'" class="btn btn-danger rounded mx-1 btn-delete" title="Delete"><i class="fa fa-trash"></i></a>
                              <form action="'.$delUrl.'" method="POST" style="display: none;" class="form-delete">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="'.csrf_token().'">
                                </form>
                            </div>';
                })
                ->rawColumns(['action'])->make(true);
        }
    }
}
