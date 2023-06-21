<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport as ExportsEmployeeExport;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Dompdf\Dompdf;



class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Employee::where('nama', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $data = Employee::paginate(5);
        }
        return view('datapegawai', compact('data'));
    }

    public function tambahpegawai()
    {
        return view('tambahdata');
    }

    public function insertdata(Request $request)
    {
        $data = Employee::create($request->all());

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function tampilkandata($id)
    {
        $data = Employee::find($id);
        return view('tampildata', compact('data'));
    }

    public function updatedata(Request $request, $id)
    {
        $data = Employee::find($id);
        $data->update($request->all());

        if ($request->hasFile('foto')) {
            $request->file('foto')->move('fotopegawai/', $request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('pegawai')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('pegawai')->with('success', 'Data Berhasil Dihapus');
    }

    public function exportpdf()
    {
        $data = Employee::all();
        view()->share('data', $data);
        $pdf = PDF::loadView('datapagawai-pdf');
        return $pdf->download('data.pdf');
    }


    public function exportexcel()
    {
        return Excel::download(new ExportsEmployeeExport, 'datapegawai.xlsx');
    }

    public function importexcel(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('EmployeeData', $namafile);

        $filePath = public_path('EmployeeData/' . $namafile);

        Excel::import(new EmployeeImport, $filePath);

        return redirect()->back();
    }
}
