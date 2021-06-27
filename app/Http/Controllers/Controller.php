<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\StudentTable;
use Illuminate\Http\Request;
use DataTables;
use Validator;
use Illuminate\Support\Facades\DB;
use \App\ItemMaster;
use \App\CustomerMaster;
use \App\BillHeader;
use \App\BillDetail;

class Controller extends BaseController
{
    public $data = [];
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveItemRecord(Request $request)
    {
        //Validation Rules
        $validator=Validator::make($request->all(),[
            'item_name' => 'required',
            'item_price' => 'required|numeric|gt:0',
        ]);
        $data=[];
        //Return Back If Validation Fails
        if($validator->fails()){
            $data['error']   = $validator->messages();
            $data['success'] = false;
            $data['msg'] = 'Valdation Error Occurred';
            return response()->json($data, 200);
        }
        //Insert Data
        try{
            DB::transaction(function () use ($request) {
                $ItemData = [
                    'name' => $request->item_name,
                    'rate' => $request->item_price
                ];
                ItemMaster::create($ItemData);
            });
            $data['msg']     = 'Item Created Successfully!';
            $data['success'] = true;
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data['msg']          = 'An Error Occured!';
            $data['success_fail'] = true;
            return response()->json($data, 200);
        }

    }

    public function viewItems()
    {
        $data = ItemMaster::latest()->get();
        return DataTables::of($data)->make(true);
    }

    public function viewCustomers()
    {
        $data = CustomerMaster::latest()->get();
        return DataTables::of($data)->make(true);
    }

    public function saveCustomerRecord(Request $request)
    {
        //Validation Rules
        $validator=Validator::make($request->all(),[
            'cust_name' => 'required|string',
            'cust_city' => 'required|string',
            'cust_addr' => 'required|string'
        ]);
        $data=[];
        //Return Back If Validation Fails
        if($validator->fails()){
            $data['error']   = $validator->messages();
            $data['success'] = false;
            $data['msg'] = 'Valdation Error Occurred';
            return response()->json($data, 200);
        }
        //Insert Data
        try{
            DB::transaction(function () use ($request) {
                $ItemData = [
                    'name'    => $request->cust_name,
                    'city'    => $request->cust_city,
                    'address' => $request->cust_addr
                ];
                CustomerMaster::create($ItemData);
            });
            $data['msg']     = 'Customer Created Successfully!';
            $data['success'] = true;
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data['msg']          = 'An Error Occured!';
            $data['success_fail'] = true;
            return response()->json($data, 200);
        }

    }

    function getAllCustomers()
    {
        $data = $data = CustomerMaster::latest()->get();
        return response()->json($data, 200);
    }

    public function createBill(Request $request)
    {
        //Validation Rules
        $validator=Validator::make($request->all(),[
            'customer' => 'required',
            'item.*' => 'required',
            'quantity.*' => 'required|numeric|gt:0',
        ]);
        $data=[];
        //Return Back If Validation Fails
        if($validator->fails()){
            $data['error']   = $validator->messages();
            $data['success'] = false;
            $data['msg'] = 'Valdation Error Occurred';
            return response()->json($data, 200);
        }
        //Insert Data
        try{
            DB::transaction(function () use ($request) {
                $totalAmount = 0;
                for($i = 0;$i < count($request->item);$i++)
                {
                    $item = ItemMaster::find($request->item[$i]);
                    ($item != null)?$totalAmount+=($request->quantity[$i] * $item->rate):'';
                }
                $billHeader = [
                    'date'        => date('Y-m-d H:i:s'),
                    'customer_id' => $request->customer,
                    'total_amount' => $totalAmount
                ];
                $billHeaderData = BillHeader::create($billHeader);
                //BillDetails Table Data
                for($i = 0;$i < count($request->item);$i++)
                {
                    $billHeaderData->billDetails()->create([
                        'item_id' => $request->item[$i],
                        'rate'    => ItemMaster::find($request->item[$i])->rate,
                        'qty'     => $request->quantity[$i]
                    ]);
                }
            });
            $data['msg']     = 'Bill Created Successfully!';
            $data['success'] = true;
            return response()->json($data, 200);
        } catch (\Exception $e) {
            $data['msg']          = 'An Error Occured!';
            $data['success_fail'] = true;
            return response()->json($data, 200);
        }
    }

    public function getAllBill()
    {
        $data = BillHeader::with('customer')->latest()->get();
        return Datatables::of($data)->addColumn('action', function ($data){
            $html = '';
            $html.='<a title="View"data-id="'.$data->id.'"class="btn btn_icon btn_details"><i class="fa fa-eye"></i></a>';
            return $html;
        })->editColumn('date', function ($data) {
             return date('d M, Y H:i',strtotime($data->date));
        })->make(true);
    }

    public function getDetailedBill(Request $request)
    {
        $data = BillDetail::with('item')->where('bill_header_id',$request->data)->get();
        return DataTables::of($data)->make(true);
    }
}



