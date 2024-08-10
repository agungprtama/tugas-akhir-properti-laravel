<?php

namespace App\Filament\Resources\OwnerMarketplaceResource\Pages;

use App\Filament\Resources\OwnerMarketplaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOwnerMarketplaces extends ListRecords
{
    protected static string $resource = OwnerMarketplaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
