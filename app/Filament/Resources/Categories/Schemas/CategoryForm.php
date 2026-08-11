<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('parent_id')
                    ->label('الفئة الرئيسية')
                    ->numeric()
                    ->default(null),
                Textarea::make('name')
                    ->label('الاسم')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('slug')
                    ->label('الرابط')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('الصورة')
                    ->image(),
                Toggle::make('is_active')
                    ->label('نشط')
                    ->required(),
                TextInput::make('sort_order')
                    ->label('ترتيب الفئة')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
