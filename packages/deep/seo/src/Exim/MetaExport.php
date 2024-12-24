<?php

namespace Deep\Seo\Exim;

use Deep\Seo\Models\Meta;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class MetaExport implements FromCollection, WithMapping, WithHeadings
{
    use Exportable;

    public function map($data): array
    {
        return[
            $data->url,
            $data->title,
            strlen( $data->title ),
            $data->title,
            strlen( $data->description ),
        ];
    }

    public function headings(): array{
        return [
            'URL',
            'Title',
            'Title Length (50-60) =LEN($B2)',
            'Description',
            'Description Length (150-160) =LEN($D2)',
        ];
    }

    public function collection(){
        $data = Meta::get();
        return $data;
    }
}