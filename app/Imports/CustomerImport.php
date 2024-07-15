<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
class CustomerImport implements ToCollection, WithHeadingRow, SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   /* public function model(array $row)
    {
        return new Customer([
            'customer_name'=> $row[0], 
            'email'    => $row[1], 
            'tel_num' => $row[2], 
            'address' => $row[3], 
        ]);
    }*/
    use Importable, SkipsFailures;

    public function collection(Collection $rows)
    {
        $failures = [];
        foreach ($rows as $index => $row) {
            $rowArray = $row->toArray();
           //dd($rowArray);
            // Kiểm tra dữ liệu
            $validator = Validator::make($rowArray, [
                'ten_khach_hang' => 'required|min:5',
                'email' => 'required|email|unique:custormers,email',
                'so_dien_thoai' => 'required|string|regex:/^[0-9]{10,15}$/',
                'dia_chi' => 'required|string',
            ]);

            if ($validator->fails()) {
                $failures[] = [
                    'row' => $index + 1,
                    'errors' => $validator->errors()->all(),
                ];
                continue;
            }

            Customer::create([
                'customer_name' => $row['ten_khach_hang'],
                'email' => $row['email'],
                'tel_num' => $row['so_dien_thoai'],
                'address' => $row['dia_chi'],
                'is_active' => $row['trang_thai']
            ]);
        }

        if (!empty($failures)) {
            session()->flash('import_failures', $failures);
        }
    }

}
