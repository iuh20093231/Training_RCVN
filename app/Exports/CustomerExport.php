<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class CustomerExport implements FromCollection, WithHeadings, WithMapping
{
    

    
    public function collection()
    {
        return Customer::all();

    }
    public function headings(): array
    {
        return [
            'customer_name',
            'email',
            'tel_num',
            'address',
        ];
    }
    public function map($customer): array
    {
        return [
            $customer->customer_name,
            $customer->email,
            $customer->tel_num,
            $customer->address,
        ];
    }
}
