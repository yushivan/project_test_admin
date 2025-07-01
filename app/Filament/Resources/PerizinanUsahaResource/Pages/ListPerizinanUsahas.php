<?php

namespace App\Filament\Resources\PerizinanUsahaResource\Pages;

use App\Filament\Resources\PerizinanUsahaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPerizinanUsahas extends ListRecords
{
    protected static string $resource = PerizinanUsahaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
