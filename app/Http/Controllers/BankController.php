<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankStoreRequest;
use App\Http\Requests\BankUpdateRequest;
use App\Models\Bank;
use Illuminate\Http\Request;
use DB;

class BankController extends Controller
{

    public function index()
    {
        return view('layouts.back-end.bank.bank-view');
    }


    // public function search(Request $request)
    // {
    //     if($request->ajax()) {
    //         $output="";
    //         $banks=DB::table('banks')
    //             ->where('short_name','LIKE','%'.$request->search."%")
    //             ->Orwhere('full_name','LIKE','%'.$request->search."%")
    //             ->Orwhere('code','LIKE','%'.$request->search."%")
    //             ->Orwhere('routing_number','LIKE','%'.$request->search."%")->get();
    //         if($banks) {
    //             foreach ($banks as $key => $bank) {
    //                 $output.='<tr>'.
    //                     '<td>'.$bank->id.'</td>'.
    //                     '<td>'.$bank->short_name.'</td>'.
    //                     '<td>'.$bank->full_name.'</td>'.
    //                     '<td>'.$bank->code.'</td>'.
    //                     '<td>'.$bank->routing_number.'</td>'.
    //                     '<td>'.'<button @click.prevent="editData(item.id)" type="button"
    //                                                 class="btn btn-primary btn-sm" data-toggle="modal"
    //                                                 data-target="#editModal">
    //                                             <i class="tio-edit"></i> Edit</button>

    //                                         <button deleteData(id)
    //                                                 class="btn btn-danger btn-sm delete">
    //                                             <i class="tio-add-to-trash"></i>
    //                                             delete
    //                             </button>'.'</td>'.
    //                     '</tr>';
    //             }
    //             return Response($output);
    //         }
    //     }
    // }



    public function store(BankStoreRequest $request)
    {
        $data   =  Bank::create($request->all());
        return response()->json($data);
    }


    public function show(Request $request)
    {
//        dd($request->all());
        $data = Bank::all();
        return response()->json(['bank' =>$data]);
    }


    public function edit($id)
    {
        $data = Bank::findOrFail($id);
        return response()->json(['bank'=>$data]);
    }


    public function update(BankUpdateRequest $request, $id)
    {
        $Student = Bank::find($id);
        if(!$Student){
            return response()->json(['error'=>"Student not found"]);
        }
        $data   =  Bank::find($id)->update($request->all());
//            Bank::find($id)->update([
//                'short_name'        =>$request->short_name,
//                'full_name'         =>$request->full_name,
//                'code'              =>$request->code,
//                'routing_number'    =>$request->routing_number
//        ]);
        return response()->json($data);
    }


    public function destroy($id)
    {
        try {
            $data = Bank::destroy($id);
            return response()->json($data);

        }catch (\Exception $e){
            return response()->json(['message'=>'Something went wrong']);
        }
    }
}
