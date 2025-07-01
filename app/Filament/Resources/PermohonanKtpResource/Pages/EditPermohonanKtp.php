<?php

namespace App\Filament\Resources\PermohonanKtpResource\Pages;

use App\Filament\Resources\PermohonanKtpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPermohonanKtp extends EditRecord
{
    protected static string $resource = PermohonanKtpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
