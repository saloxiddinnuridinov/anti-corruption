<?php

namespace App\Filament\Resources\AppealTypeResource\Pages;

use App\Filament\Resources\AppealTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAppealTypes extends ListRecords
{
    protected static string $resource = AppealTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
