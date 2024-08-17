<?php

namespace App\Filament\Resources\ResetCodePasswordResource\Pages;

use App\Filament\Resources\ResetCodePasswordResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResetCodePassword extends EditRecord
{
    protected static string $resource = ResetCodePasswordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
