<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyForm;
use App\Models\VendorCompanyProfile;
use Auth;
use File;
use Validator;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function edit($vendor_id)
    {
        $fields = CompanyForm::where('status', 1)->get();
        $vendor = User::where('role', '3')->where('id', $vendor_id)->first();
        return view('admin.company_profile.form', compact('fields', 'vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $vendor_id)
    {
        /// dd($request->all());
        try {
            $data = array();
            $requestData = $request->all();
            unset($requestData['_token']);
            foreach ($requestData as $key => $input) {
                // echo $request->hasFile($key);
                $company_logo = null;
                if ($request->hasFile($key)) {
                    //dd($input);
                    $file = $input;
                    $fileName = (preg_replace("/[^a-z0-9\_\-\.]/i", '',str_replace(' ', '_', $file->getClientOriginalName())));
                    $ext = $file->getClientOriginalExtension();
                    $completeFileName = time() . "!" . $fileName;
                    $path = 'uploads/vendor/';
                    $file->move(public_path($path), $completeFileName);
                    $company_logo = $path . $completeFileName;
                    $data['user_id'] = $vendor_id;
                    $data['field_key'] = $key;
                    $data['field_value'] = $company_logo;
                } else {
                    $data['user_id'] = $vendor_id;
                    $data['field_key'] = $key;
                    $data['field_value'] = $input;
                }
                // $isExist = VendorCompanyProfile::where('user_id', Auth::user()->id)->where('field_key', $key)->first();
                $isExist = VendorCompanyProfile::where('user_id', $vendor_id)->where('field_key', $key)->first();
                if (!empty($isExist)) {
                    VendorCompanyProfile::where('user_id', $vendor_id)
                        ->where('field_key', $key)
                        ->update([
                            'field_value' => $data['field_value'],
                        ]);
                } else {
                    VendorCompanyProfile::create($data);
                }
            }

            return redirect()->route('admin.vendor.company_profile', $vendor_id)->with('success', 'Company Profile has been updated');
        } catch (\Throwable $e) {
            // dd($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
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
        //
    }
}
