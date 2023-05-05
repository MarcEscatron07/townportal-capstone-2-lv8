<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Computer;
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
        $computers = Computer::get();
        $types = Type::get();
        return view('peripherals.create', compact('computers', 'types'));
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
        $new = new Peripheral($data);

        if($new->save()) {
            return redirect()->route('peripherals.create')
            ->with('success', 'Successfully added new peripheral!');
        } else {
            return redirect()->route('peripherals.create')
            ->with('failed', 'Unable to add new peripheral...');
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
        $peripheral = Peripheral::findOrFail($id);
        return view('peripherals.show', compact('id', 'peripheral'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peripheral = Peripheral::findOrFail($id);
        $computers = Computer::get();
        $types = Type::get();
        return view('peripherals.edit', compact('id', 'peripheral', 'computers', 'types'));
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
        $peripheral = Peripheral::findOrFail($id);
        // dd($network);
        $data = $request->all();
        // dd($data);

        $peripheral->computer_id = $data['computer_id'] ?? null;
        $peripheral->type_id = $data['type_id'] ?? null;
        $peripheral->name = $data['name'] ?? null;
        $peripheral->brand = $data['brand'] ?? null;
        $peripheral->model = $data['model'] ?? null;
        $peripheral->serial_number = $data['serial_number'] ?? null;
        $peripheral->cost = $data['cost'] ?? null;
        $peripheral->remarks = $data['remarks'] ?? null;

        if($peripheral->save()) {
            return redirect()->route('peripherals.edit', $peripheral->id)
            ->with('success', 'Successfully updated peripheral!');
        } else {
            return redirect()->route('peripherals.edit', $peripheral->id)
            ->with('failed', 'Unable to update peripheral...');
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
        $peripheral = Peripheral::findOrFail($id);
        $peripheral->delete();

        return redirect()->route('peripherals.index')->with('success','Deleted successfully');
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
                })->editColumn('computer_id', function(Peripheral $peripheral){
                    return $peripheral->formattedComputer();
                })->editColumn('type_id', function(Peripheral $peripheral){
                    return $peripheral->formattedType();
                })
                ->rawColumns(['action'])->make(true);
        }
    }
}
