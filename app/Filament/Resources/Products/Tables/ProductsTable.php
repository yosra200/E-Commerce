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
            TextColumn::make('name.ar')->label('اسم المنتج')->searchable(),
            TextColumn::make('category.name.ar')->label('القسم')->searchable(),
            TextColumn::make('sku')->label('SKU')->searchable(),
            TextColumn::make('price')->label('السعر')->money('EGP')->sortable(),
            IconColumn::make('is_active')->label('ظاهر')->boolean(),
            TextColumn::make('sort_order')->label('الترتيب')->sortable(),
            TextColumn::make('created_at')->label('تاريخ الإضافة')->dateTime()->sortable(),
        ])->recordActions([
            EditAction::make(),
        ])->toolbarActions([
            BulkActionGroup::make([DeleteBulkAction::make()]),
        ]);
    }
}
