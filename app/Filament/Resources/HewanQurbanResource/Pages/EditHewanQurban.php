<?php

namespace App\Filament\Resources\HewanQurbanResource\Pages;

use App\Filament\Resources\HewanQurbanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHewanQurban extends EditRecord
{
    protected static string $resource = HewanQurbanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
