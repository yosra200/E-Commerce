<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name.ar')->label('Name')->searchable(),
            TextColumn::make('category.name.ar')->label('Category')->searchable(),
            TextColumn::make('sku')->searchable(),
            TextColumn::make('price')->money('EGP')->sortable(),
            IconColumn::make('is_active')->boolean(),
            TextColumn::make('sort_order')->sortable(),
            TextColumn::make('created_at')->dateTime()->sortable(),
        ])->recordActions([
            EditAction::make(),
        ])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
