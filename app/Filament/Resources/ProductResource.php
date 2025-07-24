<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Store';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('price')
                ->numeric()
                ->required(),

            Forms\Components\TextInput::make('stock')
                ->numeric()
                ->required(),

            Forms\Components\FileUpload::make('image')
                ->image()
                ->directory('products')
                ->imagePreviewHeight('150')
                ->required(),

            Forms\Components\Textarea::make('description')
                ->maxLength(65535),

            Forms\Components\Select::make('category_id')
                ->relationship('category', 'name')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
           Tables\Columns\ImageColumn::make('image')
                ->label('Image')
                ->disk('public') // tambahkan ini
                ->visibility('public') // ini opsional, tapi bagus jika kamu ingin kontrol lebih
                ->circular(), // opsional

            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('price')
                ->money('IDR', true)
                ->sortable(),

            Tables\Columns\TextColumn::make('stock')
                ->label('Stock')
                ->sortable(),

            Tables\Columns\TextColumn::make('category.name')
                ->label('Category')
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
