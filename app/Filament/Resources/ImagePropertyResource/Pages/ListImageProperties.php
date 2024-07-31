<?php

namespace App\Filament\Resources\ImagePropertyResource\Pages;

use App\Filament\Resources\ImagePropertyResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImageProperties extends ListRecords
{
    protected static string $resource = ImagePropertyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
