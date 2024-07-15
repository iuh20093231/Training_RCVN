<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
class CustomerExport implements FromQuery,WithHeadings, WithMapping
{
    use Exportable;

    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    public function headings(): array
    {
        return [
            'Tên khách hàng',
            'Email',
            'số điện thoại',
            'Địa chỉ',
        ];
    }
    public function query()
    {
        $query = Customer::query();
        return $query->orderBy('created_at', 'desc');
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
