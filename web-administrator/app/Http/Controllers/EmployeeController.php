<?php

namespace App\Http\Controllers;

use App\Models\ContractId;
use App\Models\employee;
use App\Models\IdType;
use App\Models\MaritalStatus;
use App\Models\RoleGroup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'allEmployees');
        $nipFilter = $request->query('nip');
        $roleFilter = $request->query('roleGroup');

        $query = Employee::query();

        if ($status == 'active') {
            $query->where('isDelete', 0);
        } elseif ($status == 'inactive') {
            $query->where('isDelete', 1);
        }

        if ($request->filled('nip') && $nipFilter !== 'All') {
            $query->where('NIP', $nipFilter);
        }

        if ($request->filled('roleGroup') && $roleFilter !== 'All') {
            $query->where('roleGroupId', $roleFilter);
        }

        $data = $query->orderBy('NIP', 'asc')->paginate(15);
        $nip = Employee::select('NIP')->distinct()->get();
        $roleGroup = RoleGroup::select('role_id', 'role')->distinct()->get();

        return view('employees.index', compact('data', 'nip', 'roleGroup'));
    }

    public function create()
    {

        $roleGroup = RoleGroup::select('id', 'roleGroup')->distinct()->get();
        return view('employees/create', compact('contractType', 'idType', 'maritalStatus', 'roleGroup'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('NIP', $request->NIP);
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        Session::flash('phone', $request->phone);
        Session::flash('address', $request->address);
        Session::flash('roleGroup', $request->roleGroup);
        Session::flash('idType', $request->idType);
        Session::flash('contractType', $request->contractType);
        Session::flash('maritalStatus', $request->maritalStatus);
        Session::flash('start_date', $request->start_date);
        Session::flash('idNumber', $request->idNumber);

        $request->validate([
            'NIP' => 'required|numeric',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric',
            'idType' => 'required',
            'idNumber' => 'required',
            'address' => 'required',
            'roleGroup' => 'required',
            'start_date' => 'required',
            'marital_status' => 'required',
            'contractType' => 'required',
        ], [
            'NIP.numeric' => 'NIP must be filled in with number.',
            'phone.numeric' => 'Phone Number must be filled in with number.',
            'roleGroup.required' => 'The Division field is required.',
            'NIP.required' => 'The NIP field is required.',
            'idType.required' => 'The ID Type field is required.',
            'idNumber.required' => 'The ID Number field is required.',
            'start_date.required' => 'The Start Date field is required.',
            'marital_status.required' => 'The Marital Status field is required.',
            'contractType.required' => 'The Contract Type field is required.',
        ]);
        $data = [
            'NIP' => $request->input('NIP'),
            'employeeName' => $request->input('name'),
            'employeeEmail' => $request->input('email'),
            'employeePhone' => $request->input('phone'),
            'employeeAddress' => $request->input('address'),
            'roleGroupId' => $request->input('roleGroup'),
            'roleGroupName' => $request->input('role'),
            'marital_status' => $request->input('maritalStatus'),
            'contract_id' => $request->input('contractType'),
            'start_date' => $request->input('start_date'),
            'id_type' => $request->input('idType'),
            'id_number' => $request->input('idNumber'),
        ];
        employee::create($data);
        return redirect('employee')->with('success', 'Data Inserted Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = employee::where('NIP', $id)->first();
        if ($data->deleteDateTime == '' || $data->updateDateTime == '') {
            $data->deleteDateTime = ' -';
            $data->updateDateTime = ' -';
        }
        return view('employees/show')->with('data', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = employee::where('NIP', $id)->first();
        $roleGroup = RoleGroup::select('id', 'roleGroup')->distinct()->get();
        return view('employees/edit', compact('data', 'contractType', 'idType', 'maritalStatus', 'roleGroup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numeric',
            'address' => 'required',
            'roleGroup' => 'required',
            'contractType' => 'required',
            'idType' => 'required',
            'idNumber' => 'required',
            'maritalStatus' => 'required',
            'start_date' => 'required',
        ], [
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'phone.numeric' => 'Phone Number must be field in with number.',
            'phone.required' => 'The Phone Number field is required.',
            'address.required' => 'The Address field is required.',
            'roleGroup.required' => 'The Division field is required.',
            'contractType.required' => 'The Contract Type field is required.',
            'idType.required' => 'The ID Type field is required.',
            'idNumber.required' => 'The ID Number field is required.',
            'maritalStatus.required' => 'The Marital Status field is required.',
            'start_date.required' => 'The Start Date field is required.',
        ]);
        $data = [
            'employeeName' => $request->input('name'),
            'employeeEmail' => $request->input('email'),
            'employeePhone' => $request->input('phone'),
            'employeeAddress' => $request->input('address'),
            'roleGroupId' => $request->input('roleGroup'),
            'contract_id' => $request->input('contractType'),
            'id_type' => $request->input('idType'),
            'id_number' => $request->input('idNumber'),
            'marital_status' => $request->input('maritalStatus'),
            'start_date' => $request->input('start_date'),
            'updateBy' => 'Admin',
            'updateDateTime' => Carbon::now()->setTimezone('Asia/Jakarta'),
        ];
        employee::where('NIP', $id)->update($data);
        return redirect('employee')->with('success', 'Data Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        employee::where('NIP', $id)->delete();
        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }

    public function inactive(string $id)
    {
        $data = [
            'isDelete' => 1,
            'deleteDateTime' => Carbon::now()->setTimezone('Asia/Jakarta'),
            'deleteBy' => 'Admin',
            'updateBy' => 'Admin',
            'employeeStatus' => 'Inactive',
            'updateDateTime' => Carbon::now()->setTimezone('Asia/Jakarta'),
        ];
        employee::where('NIP', $id)->update($data);
        return redirect()->back()->with('success', ' Successfully Set Employee Inactive');
    }
    public function active(string $id)
    {
        $data = [
            'isDelete' => 0,
            'deleteDateTime' => null,
            'deleteBy' => null,
            'updateBy' => 'Admin',
            'employeeStatus' => 'Active',
            'updateDateTime' => Carbon::now()->setTimezone('Asia/Jakarta'),
        ];
        employee::where('NIP', $id)->update($data);
        return redirect()->back()->with('success', 'Successfully Set Employee Inactive');
    }
}
