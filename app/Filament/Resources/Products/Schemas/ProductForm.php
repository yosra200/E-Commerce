<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Product information')->schema([
                Select::make('category_id')
                    ->relationship('category', 'id')
                    ->getOptionLabelFromRecordUsing(fn ($record) => $record->name['ar'] ?? $record->name['en'] ?? $record->id)
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name.ar')->label('Name (Arabic)')->required()->maxLength(255),
                TextInput::make('name.en')->label('Name (English)')->required()->maxLength(255),
                Textarea::make('description.ar')->label('Description (Arabic)')->maxLength(5000),
                Textarea::make('description.en')->label('Description (English)')->maxLength(5000),
            ])->columns(2),
            Section::make('Pricing and availability')->schema([
                TextInput::make('price')->numeric()->minValue(0)->required()->prefix('EGP'),
                TextInput::make('compare_price')->numeric()->minValue(0)->gte('price')->prefix('EGP'),
                TextInput::make('sku')->required()->maxLength(255)->unique(ignoreRecord: true),
                TextInput::make('sort_order')->numeric()->integer()->minValue(0)->default(0)->required(),
                Toggle::make('is_active')->default(true)->required(),
            ])->columns(2),
        ]);
    }
}
