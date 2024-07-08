<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str; 

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        // filter data
        // get date range picker
       
        if ($request->ajax()) {
           
            $employees = Employee::select('employees.*')->with('position','status');

            if($request->filled('from_date') && $request->filled('to_date'))
            {
        
                $employees = $employees->whereBetween('employees.work_start_date', [$request->from_date, $request->to_date]);
            }

            return DataTables::of($employees)
                    ->addIndexColumn()
                    ->filter(function ($query) use ($request) {
                        if ($request->filled('search')) {
                            $query->where(function ($q) use ($request) {
                                $q->where('employees.name', 'like', '%' . $request->search . '%')
                                ->orWhere('employees.email', 'like', '%' . $request->search . '%')
                                ->orWhere('employees.employee_id', 'like', '%' . $request->search . '%');
                            });
                        }
                    })
                    ->order(function ($query) {
                        $query->orderBy('id', 'desc');
                    })
                    ->editColumn('work_start_date', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d', $data->work_start_date)->format('d M Y'); return $formatedDate; })
                    ->addColumn('action', function($row){
                        $actionBtn = '<a href="'.route('employee.show', $row->id).'" class="edit btn btn-success btn-sm nowrap"><i class="fa fa-eye"></i> Detail</a> ';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('employee.index');
    }

    public function create()
    {
        $positions = Position::all();
        return view('employee.create', compact('positions'));
    }

    public function store(Request $request)
    {

        // validate data

        $request->validate([
            'position' => 'required|exists:positions,id',
            'status_id' => 'required|in:1,2',
            'employee_id' => 'required|unique:employees,employee_id',
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|numeric|digits_between:10,13|unique:employees,phone',
            'address' => 'required',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'work_start_date' => 'required|date',
            'file' => 'mimes:png,jpg,jpeg,gif|max:5000'
        ]);

        // create employee
        $attributes = [
            'position_id' => $request->position,
            'status_id' => $request->status_id,
            'employee_id' => $request->employee_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender,
            'work_start_date' => Carbon::createFromFormat('d/m/Y', $request->work_start_date)->format('Y-m-d')
        ];

        $employee = Employee::create($attributes);

        // get dropzone image
        if ($request->file('file')) {
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            $request->file->storeAs('uploads/', $filename, 'public');

            $employee->update([
                'photo' => '/storage/uploads/'.$filename
            ]);
            
        }

        return response()->json($employee);
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.show', compact('employee'));
    }

    public function storeFile(Request $request, $id)
    {
        $request->validate([
            'file' => 'mimes:png,jpg,jpeg,gif|max:5000'
        ]);

        if ($request->file('file')) {
            $employee = Employee::find($id);
            $file = $request->file('file');
            $filename = time().'_'.$file->getClientOriginalName();
            $request->file->storeAs('uploads/', $filename, 'public');

            $employee->update([
                'photo' => '/storage/uploads/'.$filename
            ]);
        }

        return response()->json([
            'success' => true,
        ]);
    }
}
