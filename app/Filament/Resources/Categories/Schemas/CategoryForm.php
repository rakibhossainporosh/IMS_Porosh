<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Category Information')
                    ->schema([
                        Select::make('parent_id')
                            ->label('Parent Category')
                            ->placeholder('Select a parent category (Optional)')
                            ->options(
                                Category::whereNull('parent_id')->pluck('name', 'id')
                            )
                            ->nullable()
                            ->searchable()
                            ->preload()
                            ->columnSpanFull(),
                        TextInput::make('name')
                            ->label('Category Name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Set $set) {
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->label('Category Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Category::class, 'slug', ignoreRecord: true)
                            ->helperText('The slug is used in the URL and should be unique.'),
                        Toggle::make('status')
                            ->label('Active Status')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpan('full'),
            ]);
    }
}
