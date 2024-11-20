<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function suppliers(){
        $suppliers = Supplier::all();
        return response()->json(
            [
                'suppliers'  => $suppliers,
                'message' => 'Suppliers',
                'code' => 200 
            ]
        );
    }

    public function getSupplier($id){
        $supplier = Supplier::find($id);
        return response()->json($supplier);
    }

    public function saveSupplier(Request $request) {
        $supplier = new Supplier();
        $supplier->supplier_name = $request->supplier_name;
        $supplier->contact_person = $request->contact_person;
        $supplier->mobile_number_1 = $request->mobile_number_1;
        $supplier->mobile_number_2 = $request->mobile_number_2;
        $supplier->save();
        return response()->json([
            'message' => 'Supplier Created Successfully' ,
            'code' => 200
        ]);

    }

    public function deleteSupplier($id){
        $supplier = Supplier::find($id);
        if($supplier){
            $supplier->delete();
            return response()->json([
                'message' => 'Supplier Deleted Successfully' ,
                'code' => 200
            ]);
        }else{
            return response()->json([
                'message' => "Supplier with id:$id does not exist"
            ]);
        }
    }

    public function updateSupplier($id, Request $request) {
        $supplier = Supplier::where('id', $id)->first();
        $supplier->supplier_name = $request->supplier_name;
        $supplier->contact_person = $request->contact_person;
        $supplier->mobile_number_1 = $request->mobile_number_1;
        $supplier->mobile_number_2 = $request->mobile_number_2;
        $supplier->save();
        return response()->json([
            'message' => 'Supplier Updated Successfully' ,
            'code' => 200
        ]);
    }

}
