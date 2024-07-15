<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class CustomerExport implements FromQuery,WithHeadings, WithMapping
{
    protected $searchConditions;

    public function __construct($searchConditions = null)
    {
        $this->searchConditions = $searchConditions;
    }
    public function headings(): array
    {
        return [
            'Tên',
            'email',
            'Số điện thoại',
            'Địa chỉ',
        ];
    }
    public function query()
    {
        $query = Customer::query();
        if ($this->searchConditions) {
            // Thêm logic xử lý điều kiện tìm kiếm ở đây
            if (isset($this->searchConditions['customer_name'])) {
                $query->where('customer_name', 'like', '%' . $this->searchConditions['customer_name'] . '%');
            }
            // Thêm các điều kiện khác nếu cần
        } else {
            // Nếu không có điều kiện tìm kiếm, chỉ lấy trang đầu tiên
            $query->take(20); // Giả sử mỗi trang có 10 bản ghi
        }
        return $query->select('customer_name','email','tel_num','address');
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
