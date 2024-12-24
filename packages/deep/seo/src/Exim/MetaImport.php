<?php

namespace Deep\Seo\Exim;

use Deep\Seo\Models\MetaInterface;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Facades\Excel;

use Carbon\Carbon;

class MetaImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading
{
    protected $batch_no;

    public function __construct($batch_no)
    {
        $this->batch_no = $batch_no;
    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $i) 
        {
            $row = json_decode(json_encode($i), true);
            
            MetaInterface::create([
                'batch_no'                  =>  $this->batch_no,
                'user_id'                   =>  Auth::user()->id,
                'url'                       =>  array_key_exists('url', $row) ? $row['url'] : null,
                'title'                     =>  array_key_exists('title', $row) ? $row['title'] : null,
                'description'               =>  array_key_exists('description', $row) ? $row['description'] : null,
                'status'                    => 'New',
                'message'                   => '',
            ]);
        }
    }
}