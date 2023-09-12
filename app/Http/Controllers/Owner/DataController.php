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
        // Retrieve users with their orders and professions
        $users = User::where('role', 'user')
            ->with('orders', 'profesis')
            ->orderBy('created_at', 'desc')
            ->get();

        
            $completedDesainerOrders = 0;
            $completedKonikaOrders = 0;
            $completedOutdorOrders = 0; // Initialize Outdor
            $completedDTFOrders = 0; // Initialize DTF
            $completedLaserOrders = 0; // Initialize Laser

        $data = [];

    
        foreach ($users as $user) {
         
            if ($user->profesis) {
                foreach ($user->profesis as $profession) {
                    // Calculate the total quantity of completed orders for this profession
                    $completedOrdersCount = $user->orders()
                    ->where('profesi_id', $profession->id)
                    ->where('qty', '>', 0)
                    ->sum('qty');
                    
                    
    
                    // Determine the profession and add the completed orders count accordingly
                    if ($profession->name === 'Desainer') {
                        $completedDesainerOrders += $completedOrdersCount;
                    } elseif ($profession->name === 'Konika') {
                        $completedKonikaOrders += $completedOrdersCount;
                    } elseif ($profession->name === 'Outdor') {
                        $completedOutdorOrders += $completedOrdersCount;
                    } elseif ($profession->name === 'DTF') {
                        $completedDTFOrders += $completedOrdersCount;
                    } elseif ($profession->name === 'Laser') {
                        $completedLaserOrders += $completedOrdersCount;
                    }
                }
    
                $data[] = [
                    'user_name' => $user->name,
                    'desainer' => $completedDesainerOrders,
                    'konika' => $completedKonikaOrders,
                    'outdor' => $completedOutdorOrders,
                    'dtf' => $completedDTFOrders,
                    'laser' => $completedLaserOrders,
                ];
            }
        }
    
        return datatables()->of($data)
            ->addIndexColumn()
            ->toJson();
    }
    
    public function records()
    {
        // Retrieve users with their orders and professions
        $users = User::where('role', 'user')
            ->with('orders', 'profesis')
            ->orderBy('created_at', 'desc')
            ->get();
        
            $completedDesainerOrders = 0;
            $completedKonikaOrders = 0;
            $completedOutdorOrders = 0; // Initialize Outdor
            $completedDTFOrders = 0; // Initialize DTF
            $completedLaserOrders = 0; // Initialize Laser
            
        $data = [];
    
        foreach ($users as $user) {
           
    
            if ($user->profesis) {
                foreach ($user->profesis as $profession) {
                    // Calculate the total quantity of completed orders for this profession
                    $completedOrdersCount = $user->orders()
                    ->where('profesi_id', $profession->id)
                    ->where('qty', '>', 0)
                    ->sum('qty');
    
                    // Initialize all variables with the same value
                    $completedDesainerOrders = $completedOrdersCount;
                    $completedKonikaOrders = $completedOrdersCount;
                    $completedOutdorOrders = $completedOrdersCount;
                    $completedDTFOrders = $completedOrdersCount;
                    $completedLaserOrders = $completedOrdersCount;
    
                    // Determine the profession and add the completed orders count accordingly
                    if ($profession->name === 'Desainer') {
                        $completedDesainerOrders += $completedOrdersCount;
                    } elseif ($profession->name === 'Konika') {
                        $completedKonikaOrders += $completedOrdersCount;
                    } elseif ($profession->name === 'Outdor') {
                        $completedOutdorOrders += $completedOrdersCount;
                    } elseif ($profession->name === 'DTF') {
                        $completedDTFOrders += $completedOrdersCount;
                    } elseif ($profession->name === 'Laser') {
                        $completedLaserOrders += $completedOrdersCount;
                    }
                }
    
                $data[] = [
                    'user_name' => $user->name,
                    'desainer' => $completedDesainerOrders,
                    'konika' => $completedKonikaOrders,
                    'outdor' => $completedOutdorOrders,
                    'dtf' => $completedDTFOrders,
                    'laser' => $completedLaserOrders,
                ];
            }
        }
    
        return $data;
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
