<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketOrder;
use Illuminate\Http\Request;
use App\Exports\ConfirmedTicketOrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SingleTicketOrderExport;

class TicketOrderController extends Controller
{
    public function index()
    {
        $orders = TicketOrder::with('event')->orderBy('created_at', 'desc')->get();
        return view('admin.pages.tickets.index', compact('orders'));
    }

    public function show($id)
    {
        $order = TicketOrder::with('event')->findOrFail($id);
        return view('admin.pages.tickets.show', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = TicketOrder::findOrFail($id);
        $order->status = 'confirmed';
        $order->save();
        return redirect()->route('admin.tickets.index')->with('success', 'Order berhasil dikonfirmasi!');
    }

    public function exportConfirmedExcel()
    {
        return Excel::download(new ConfirmedTicketOrdersExport, 'tiket-terkonfirmasi.xlsx');
    }

    public function downloadQrExcel($id)
    {
        $order = TicketOrder::with('event')->findOrFail($id);
        if ($order->status !== 'confirmed') {
            return back()->with('error', 'Tiket belum dikonfirmasi!');
        }
        return \Maatwebsite\Excel\Facades\Excel::download(new SingleTicketOrderExport($order), 'qr-tiket-'.$order->id.'.xlsx');
    }
} 