<?php

namespace App\Filament\Resources\ImagePropertyResource\Pages;

use App\Filament\Resources\ImagePropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditImageProperty extends EditRecord
{
    protected static string $resource = ImagePropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
