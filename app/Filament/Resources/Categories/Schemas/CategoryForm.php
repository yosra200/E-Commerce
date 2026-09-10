<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Filament\Forms\Components\BaseFileUpload;
use App\Models\Category;


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


                TextInput::make('slug')
                    ->label('الرابط ')
                    ->required(),

                FileUpload::make('image')
                    ->label('الصورة')
                    ->rules(['required'])
                    ->markAsRequired()->image()
                    ->fetchFileInformation(false)
                    ->saveUploadedFileUsing(fn(TemporaryUploadedFile $file): string => (new Category())->uploadFile($file, 'categories'))
                    ->getUploadedFileUsing(static function (BaseFileUpload $component, string $file, string | array | null $storedFileNames): ?array {
                        if (blank($file)) {
                            return null;
                        }

                        $fileName = basename(str_replace('\\', '/', $file));

                        return [
                            'name' => $fileName,
                            'size' => 0,
                            'type' => null,
                            // 'url' => asset('assets/uploads/categories/' . $fileName),
                            'url' => asset('assets/uploads/categories/' . $fileName),
                        ];
                    }),
                Toggle::make('is_active')
                    ->label('نشط')
                    ->required(),
            ]);
    }
}
