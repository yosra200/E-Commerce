<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('name.ar')
                    ->label('الاسم بالعربي')
                    ->rules(['required'])
                    ->markAsRequired()->maxLength(255),

                TextInput::make('name.en')
                    ->label('الاسم بالانجليزيه')
                    ->rules(['required'])
                    ->markAsRequired()->maxLength(255),
                // TextInput::make('slug_ar')
                //     ->label('الرابط بالعربي')
                //     ->required()
                //     ->formatStateUsing(function ($state, $record) {
                //         return $record
                //             ? $record->getTranslation('slug', 'ar')
                //             : $state;
                //     }),

                // TextInput::make('slug_en')
                //     ->label('الرابط بالإنجليزي')
                //     ->required()
                //     ->formatStateUsing(function ($state, $record) {
                //         return $record
                //             ? $record->getTranslation('slug', 'en')
                //             : $state;
                //     }),

                FileUpload::make('image')
                    ->label('الصورة')
                    ->image(),

                Toggle::make('is_active')
                    ->label('نشط')
                    ->required(),
            ]);
    }
}
