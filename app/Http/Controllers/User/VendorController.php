<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CustomerSite;
use App\Models\MonitoringLog;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function VendorList(Request $request)
    {
        $userId = auth()->id();
        $vendor = Vendor::select('id', 'name', 'description')
                        ->where('creator_id', $userId)
                        ->get();

        return datatables()->of($vendor)
            ->addColumn('action', function ($vendor) {
                $edit_link = '<a href="javascript:void(0)" data-toggle="tooltip" onClick="editVendorFunc(' . $vendor->id . ')" data-original-title="Edit" class="text-yellow-500"><i class="fa-solid fa-pen-to-square mr-2"></i></a>';
                $delete_link = '<a href="javascript:void(0)" onClick="deleteVendorFunc(' . $vendor->id . ')" data-toggle="tooltip" data-original-title="Delete" class="text-red-500"><i class="fa-solid fa-trash mr-2"></i></a>';
                return $edit_link . '' . $delete_link;
            })->make(true);
    }


    public function index()
    {
        return view('User.SiteTracking.Vendor.index');
    }
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name' => 'required',
            'description' => 'required',
        ];
        $request->validate($rules);
        $userId = auth()->id();
        $vendorData = [
            'name' => $request->name,
            'description' => $request->description,
            'creator_id' => $userId,
        ];

        Vendor::updateOrCreate(['id' => $request->id], $vendorData);

        return response()->json(['success' => 'Vendor saved successfully.']);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $vendor  = Vendor::where($where)->first();

        return Response()->json($vendor);
    }
    public function destroy(Request $request)
    {
        // Retrieve vendor id from the request
        $vendorId = $request->id;

        // Delete monitoring logs associated with customer sites of the vendor
        CustomerSite::where('vendor_id', $vendorId)->each(function ($customerSite) {
            MonitoringLog::where('customer_site_id', $customerSite->id)->delete();
        });

        // Delete customer sites associated with the vendor
        CustomerSite::where('vendor_id', $vendorId)->delete();

        // Delete the vendor
        $vendor = Vendor::where('id', $vendorId)->delete();

        // Return the response as JSON
        return response()->json(['success' => 'Vendor and associated data deleted successfully.']);
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('ids');

        foreach ($ids as $id) {
            $vendor = Vendor::find($id);
            if ($vendor) {
                $customerSites = CustomerSite::where('vendor_id', $id)->get();
                foreach ($customerSites as $customerSite) {
                    MonitoringLog::where('customer_site_id', $customerSite->id)->delete();
                    $customerSite->delete();
                }
                $vendor->delete();
            }
        }

        return response()->json(['success' => true]);
    }
}
