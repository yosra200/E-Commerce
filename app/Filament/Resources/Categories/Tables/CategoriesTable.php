<?php

namespace App\Filament\Resources\Categories\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Category;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('parent_id')
                //     ->numeric()
                //     ->sortable(),
                // ImageColumn::make('image'),

                TextColumn::make('id')
                    ->label('ID')
                    ->searchable()

                    ->sortable(),
                TextColumn::make('name_ar')
                    ->label('الاسم بالعربية')
                    ->getStateUsing(fn(Category $record): string => $record->getTranslation('name', 'ar', false) ?: '-')
                    ->searchable('name->ar')
                    ->sortable(['name->ar']),
                TextColumn::make('name_en')
                    ->label('الاسم بالإنجليزية')
                    ->getStateUsing(fn(Category $record): string => $record->getTranslation('name', 'en', false) ?: '-')
                    ->searchable('name->en')
                    ->sortable(['name->en']),
                IconColumn::make('is_active')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
