<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Product Information')
                    ->schema([
                        TextInput::make('name')
                            ->label('Product Name')
                            ->placeholder('Enter product name')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $operation, $state, Set $set){
                                if($operation === 'create'){
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(Product::class, 'slug', ignoreRecord:true)
                            ->helperText('Auto generated from product name'),
                        TextInput::make('sku')
                            ->label('SKU / Barcode')
                            ->placeholder('Enter your product code')
                            ->required()
                            ->maxLength(255)
                            ->unique(Product::class, 'sku', ignoreRecord:true),
                        Select::make('category_id')
                            ->label('Category')
                            ->required()
                            ->options(Category::pluck('name', 'id'))
                            ->searchable()
                            ->preload(),
                        Select::make('unit_id')
                            ->label('Unit')
                            ->required()
                            ->options(Unit::pluck('name', 'id'))
                            ->searchable()
                            ->preload(),
                        TextInput::make('cost_price')
                            ->label('Cost Price')
                            ->numeric()
                            ->prefix('৳')
                            ->required()
                            ->default(0),
                        TextInput::make('selling_price')
                            ->label('Selling Price')
                            ->numeric()
                            ->prefix('৳')
                            ->required()
                            ->default(0),
                        Toggle::make('status')
                            ->label('Status')
                            ->default(true)
                            ->onColor('success')
                            ->offColor('danger')
                            ->columnSpanFull(),
                        Textarea::make('description')
                            ->label('Description')
                            ->placeholder('Enter product description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
                Section::make('Product Image and Description')
                        ->schema([
                            FileUpload::make('image')
                            ->label('Product Image')
                            ->image()
                            ->directory('products')
                            ->imageEditor()
                            ->columnSpanFull(),
                            Textarea::make('description')
                                ->label('Description')
                                ->placeholder('Enter your product description')
                                ->rows(4)
                                ->columnSpanFull(),
                        ])
                        ->columns(1),
                    
            ]);
    }
}
