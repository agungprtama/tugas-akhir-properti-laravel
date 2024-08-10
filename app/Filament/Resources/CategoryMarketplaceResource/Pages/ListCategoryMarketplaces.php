<?php

namespace App\Filament\Resources\CategoryMarketplaceResource\Pages;

use App\Filament\Resources\CategoryMarketplaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCategoryMarketplaces extends ListRecords
{
    protected static string $resource = CategoryMarketplaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
