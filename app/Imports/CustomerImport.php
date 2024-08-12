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
use App\Http\Requests\CustomerRequest;
class CustomerImport implements ToCollection, WithHeadingRow, SkipsOnFailure
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    use Importable, SkipsFailures;
    protected $failures = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            $rowArray = $row->toArray();
            $validator = Validator::make($rowArray,(new CustomerRequest)->rules(),(new CustomerRequest)-> messages());
            if ($validator->fails()) {
                $this->failures[] = [
                    'row' => $index + 1,
                    'errors' => $validator->errors()->all(),
                ];
                continue;
            }

            Customer::create([
                'customer_name' => $row['customer_name'],
                'email' => $row['email'],
                'tel_num' => $row['tel_num'],
                'address' => $row['address'],
                'is_active' => $row['is_active']
            ]);
        }
    }
    public function getFailures()
    {
        return $this->failures;
    }

}
