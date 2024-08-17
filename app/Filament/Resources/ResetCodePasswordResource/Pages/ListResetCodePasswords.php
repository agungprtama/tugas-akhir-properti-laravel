<?php

namespace App\Filament\Resources\ResetCodePasswordResource\Pages;

use App\Filament\Resources\ResetCodePasswordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListResetCodePasswords extends ListRecords
{
    protected static string $resource = ResetCodePasswordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
