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
            $qtyDesainer = 0;
            $qtyKonika = 0;
            $qtyOutdor = 0;
            $qtyDtf = 0;
            $qtyLaser = 0;

            foreach ($user->orders as $order) {
                $qtyDesainer += $order->qty_desainer;
                $qtyKonika += $order->qty_konika;
                $qtyOutdor += $order->qty_outdor;
                $qtyDtf += $order->qty_dtf;
                $qtyLaser += $order->qty_laser;
            }

            $formattedData[] = [
                'name' => $user->name,
                'qty_desainer' => $qtyDesainer,
                'qty_konika' => $qtyKonika,
                'qty_outdor' => $qtyOutdor,
                'qty_dtf' => $qtyDtf,
                'qty_laser' => $qtyLaser,
            ];
        }

        return response()->json(['data' => $formattedData]);
    }


    public function generatePdfRecord()
    {
        // Panggil fungsi record() untuk mengambil data
        $response = $this->record();

        // Ambil data dari objek respons
        $data = $response->getOriginalContent()['data'];

        // Generate HTML for the PDF content
        $html = '<table style="width:100%; border-collapse: collapse;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Nama Karyawan / Pengguna </th>';
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
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['name'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['qty_desainer'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['qty_konika'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['qty_outdor'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['qty_dtf'] . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $item['qty_laser'] . '</td>';
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
