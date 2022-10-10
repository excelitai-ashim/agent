<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use App\Models\Agent;
use App\Models\AgentInfo;
use App\Models\PaymentDetails;
use App\Models\Bank;

class AgentController extends Controller
{
    public function index(){
        // dd("ok");
        // return view('layouts.back-end.partials.agent.agent_view');
        return view('layouts.index');
    }
    public function agentViewPage(){
        // $agent = Agent::with('agentInfo','paymentDetails')->OrderBy('id','desc')->get();
        // dd($agent);
        return view('layouts.back-end.partials.agent.agent_view');

    }

    public function agentgetData(){
        $agent = Agent::with('agent_info','payment_details','payment_details.bank_name')->OrderBy('id','desc')->get();
        $districts = District::orderBy('id','desc')->get();
        $divisions = Division::orderBy('id','desc')->get();
        $bank = Bank::orderBy('id','desc')->get();
        // return response(compact('customer','districts','divisions'));
        return response()->json(['agent'=>$agent,
         'districts'=> $districts,'divisions'=> $divisions,'bank'=> $bank]);
}



     function generateRandomString($length = 6)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return
            $randomString;
    }
      public function storeAgent(Request $request){

        //dd($request->all());

        $file = $request->file('image');

        $filename = '';
        if ($file) {
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
        } else {
            $filename = '';
        }

        //     $request->validate([
        //         'image' =>'required',
        //         'registration_date' => 'required',
        //         'agent_id' => 'required',
        //         'name' => 'required',
        //         'mobileNumber1' => 'required',
        //         'mobileNumber2' => 'required',
        //         'agent_zone_area' => 'required',
        //         'agent_division' => 'required',
        //         'present_address' => 'required',
        //         'permanent_address' => 'required',
        //         'bank_details' => 'required',
        //         'account_number' =>'required',
        //         'Mobile_banking' => 'required',
        //         'banking_mobile_number' => 'required',
        //         'Mobile_banking' => 'required',
        //         'email' => 'required|unique:agent_customers',
        //         'password' =>'required',

        //   ]);


          $Agent=Agent::create([
            // 'name' => "dddddddddddddddddddd",
            // 'email' => "dddddddddddddd@gmail.com",

             'name' => $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),

        ]);

          $AgentInfo=AgentInfo::create([
            'agent_id' => $Agent->id,
            'image' =>$filename,
            'agent_Autostring_id' =>"#".$this->generateRandomString(),
            'registration_date' => $request->registration_date,
            'mobileNumber1' => $request->mobileNumber1,
            'mobileNumber2' => $request->mobileNumber2,
            'agent_zone_area' => $request->agent_zone_area,
            'agent_division' => $request->agent_division,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,


        ]);

        $PaymentDetails=PaymentDetails::create([
            'agent_id' =>$Agent->id,
            'bank_id' => $request->bank_name,
            'account_number' => $request->account_number,
            'Mobile_banking' => $request->Mobile_banking,
            'banking_mobile_number' => $request->banking_mobile_number,

        ]);

          return response()->json([
            'Agent' => $Agent,
            'AgentInfo' => $AgentInfo,
            'PaymentDetails' => $PaymentDetails
        ]);
      }

      public function edit($agent_id){
        //   $agent = Agent::find($agent_id);
          $agent = Agent::where('id',$agent_id)->with('agent_info','payment_details','payment_details.bank_name')->OrderBy('id','desc')->first();

          if(!$agent){
              return response()->json(['error'=>"Agent not found"]);
          }
          return response()->json(['agent'=>$agent]);
      }

      public function removeAgent($agent_id){
        $agentInfo = AgentInfo::where('agent_id', $agent_id)->first();
        if($agentInfo->images && file_exists($agentInfo->images)){
            unlink($agentInfo->images);
        }
        $agentInfo->delete();

       Agent::where('id', $agent_id)->delete();
       PaymentDetails::where('agent_id', $agent_id)->delete();




        return response("Successfully Deleted");


      }
      public function validateStatus()
      {
          return $this->validate(request(), [
              'id' => 'required|min:1|max:3'
          ]);
      }
      public function update(Request $request, $agent_id){
        dd($request->all());
        $filename = '';
        $agent = Agent::find($agent_id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $filename);
            if ($agent->image) {
                unlink($agent->images);;
            }
        } else {
            $filename = $request->image;
        }


        $agentData = [
            'image' => $filename ,
            'agent_id' => $request->agent_id,
            'name' => $request->name,
            'mobileNumber1' => $request->mobileNumber1,
            'mobileNumber2' => $request->mobileNumber2,
            'agent_zone_area' => $request->agent_zone_area,
            'agent_division' => $request->agent_division,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'bank_details' => $request->bank_details,
            'account_number' => $request->account_number,
            'Mobile_banking' => $request->Mobile_banking,
            'banking_mobile_number' => $request->banking_mobile_number,
            'email' => $request->email,

        ];

        $agent->update($agentData);
        return response()->json([
            'status' => 200,
            'message' => "Agent data updated successfully!"
        ]);
      }

      public function statusUpdate(Request $request, $id){


//          $Agent = Agent::find($id);
//          if(!$Agent){
//              return response()->json(['error'=>"Agent not found"]);
//          }

          if ('status'== 1){
              $data= Agent::findOrFail($id)->update(['status' => 1,]);
          }else{
              $data= Agent::findOrFail($id)->update(['status' => 1,]);
          }

          return response()->json($data);
      }
}
