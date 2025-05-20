<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SingleTicketOrderExport implements FromCollection, WithHeadings, WithMapping
{
    protected $order;
    public function __construct($order) { $this->order = $order; }
    public function collection() { return collect([$this->order]); }
    public function headings(): array { return ['Nama', 'Email', 'Event', 'Kode Tiket', 'QR Code (base64)']; }
    public function map($order): array {
        $qr = base64_encode(\QrCode::format('png')->size(150)->generate($order->kode_tiket ?? $order->id));
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