<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use PDF;

class DataController extends Controller
{
    public function users(){
        $users = User::where('role', 'user')->orderBy('created_at', 'desc')->get();
        return datatables()->of($users)
            ->addColumn('action', 'owner.pengguna.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function admin(){
        $users = User::where('role', 'admin')->orderBy('created_at', 'desc')->get();
        return datatables()->of($users)
            ->addColumn('action', 'owner.settingAdmin.action')
            ->addIndexColumn()
            ->rawColumns(['action'])
            ->toJson();
    }

    public function record()
    {
        $data = User::where('role', 'user')
            ->with('orders', 'profesis')
            ->orderBy('created_at', 'desc')
            ->get();

        // Create a new array to format the data for DataTables
        $formattedData = [];

        foreach ($data as $user) {
            $formattedData[] = [
                'name' => $user->name,
                'qty_desainer' => $user->orders->sum('qty_desainer'),
                'qty_konika' => $user->orders->sum('qty_konika'),
                'qty_outdor' => $user->orders->sum('qty_outdor'),
                'qty_dtf' => $user->orders->sum('qty_dtf'),
                'qty_laser' => $user->orders->sum('qty_laser'),
            ];
        }

        return response()->json(['data' => $formattedData]);
    }


    public function generatePdfRecord()
    {
        // Call the record function to retrieve the data
        $data = $this->records();

        // Generate HTML for the PDF content
        $html = '<table style="width:100%; border-collapse: collapse;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Username</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Desainer</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Konika</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Outdor</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">DTF</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Laser</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        foreach ($data as $item) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['user_name'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['desainer'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['konika'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['outdor'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['dtf'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['laser'] . '</td>';
            $html .= '</tr>';
        }

        $html .= '</tbody>';
        $html .= '</table>';

        // Generate PDF from the HTML content
        $pdf = PDF::loadHTML($html);

        // Optional: Set PDF options
        $pdf->setOption('margin-top', 10);
        $pdf->setOption('margin-bottom', 10);

        // Return the PDF as a download
        return $pdf->download('records.pdf');
    }




}
