<?php

namespace App\Filament\Resources\TransactionMarketplaceResource\Pages;

use App\Filament\Resources\TransactionMarketplaceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTransactionMarketplaces extends ListRecords
{
    protected static string $resource = TransactionMarketplaceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
