<?php

namespace App\Filament\Resources\AppealTypeResource\Pages;

use App\Filament\Resources\AppealTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAppealType extends EditRecord
{
    protected static string $resource = AppealTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
