<?php

namespace App\Filament\Resources\Units\Schemas;

use App\Models\Unit;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Unit Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Unit Name')
                            ->placeholder('e.g. Kilogram, Liter, Piece')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('short_code')
                            ->label('Short Name')
                            ->placeholder('e.g. kg, L, pc')
                            ->required()
                            ->maxLength(50)
                            ->unique(Unit::class, 'short_code', ignoreRecord: true)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function ($state, Set $set) {
                                $set('short_code', Str::upper($state));
                            })
                            ->helperText('Short name will be automatically converted to uppercase.'),
                    ])
                    ->columns(2)
                    ->columnSpan('full'),
            ]);
    }
}
