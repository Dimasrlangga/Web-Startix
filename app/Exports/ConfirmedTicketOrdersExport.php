<?php
namespace App\Exports;

use App\Models\TicketOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class ConfirmedTicketOrdersExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return TicketOrder::where('status', 'confirmed')->with('event')->get();
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'Event',
            'Kode Tiket',
            'QR Code (base64)'
        ];
    }

    public function map($order): array
    {
        $qr = base64_encode(QrCode::format('png')->size(150)->generate($order->kode_tiket ?? $order->id));
        $qrImg = 'data:image/png;base64,' . $qr;
        return [
            $order->name,
            $order->email,
            $order->event->title ?? '',
            $order->kode_tiket ?? $order->id,
            $qrImg
        ];
    }
} 