<?php

namespace App\Filament\Resources\PermohonanKtpResource\Pages;

use App\Filament\Resources\PermohonanKtpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPermohonanKtps extends ListRecords
{
    protected static string $resource = PermohonanKtpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
