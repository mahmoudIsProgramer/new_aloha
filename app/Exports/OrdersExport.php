<?php

namespace App\Exports;

use App\Login;
use App\Orders;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromCollection, WithHeadings, ShouldAutoSize,WithEvents
{

    public function collection()
    {
        return Login::select(  'name','email','phone','country','message','area','subject', 'school_id','level','board','session','address','year','created_at')->latest()->get();
    }

    public function headings(): array
    {
        return [

            'Name',
            'Email',
            'phone',
            'country',
            'message',
            'area',
            'subject',
            'school',
            'level',
            'board',
            'session',
            'address',
            'year',
            'Created At ',
            ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:W1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

}
