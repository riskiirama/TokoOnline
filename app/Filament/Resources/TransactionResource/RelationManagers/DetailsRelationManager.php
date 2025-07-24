<?php

namespace App\Filament\Resources\TransactionResource\RelationManagers;

use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;

class DetailsRelationManager extends RelationManager

{
    protected static string $relationship = 'details';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
            Forms\Components\Select::make('product_id')
                ->label('Produk')
                ->options(Product::all()->pluck('name', 'id'))
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, Set $set) {
                    $product = Product::find($state);
                    $set('price', $product?->price ?? 0);
                }),

            Forms\Components\TextInput::make('qty')
                ->numeric()
                ->default(1)
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                    $set('subtotal', $state * $get('price'));
                }),

            Forms\Components\TextInput::make('price')
                ->numeric()
                ->readOnly()
                ->required(),

            Forms\Components\TextInput::make('subtotal')
                ->numeric()
                ->readOnly()
                ->required(),
            Forms\Components\Select::make('ukuran_baju')
                ->label('Ukuran Baju')
                ->options([
                    'S' => 'S',
                    'M' => 'M',
                    'L' => 'L',
                    'XL' => 'XL',
                ])
                ->required(),

        ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')->label('Produk'),
                Tables\Columns\TextColumn::make('qty'),
                Tables\Columns\TextColumn::make('price')->money('IDR'),
                Tables\Columns\TextColumn::make('subtotal')->money('IDR'),
                Tables\Columns\TextColumn::make('ukuran_baju')
                    ->label('Ukuran Baju'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->after(function (Model $record) {
                        // Kurangi stok
                        $product = Product::find($record->product_id);
                        if ($product) {
                            $product->decrement('stock', $record->qty);
                        }

                        // Update total transaksi
                        $transaction = $record->transaction;
                        $transaction->update([
                            'total' => $transaction->details()->sum('subtotal'),
                        ]);
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->beforeFormFilled(function (Model $record, array $data) {
                        // Simpan qty lama untuk referensi
                        $record->old_qty = $record->qty;
                    })
                    ->after(function (Model $record) {
                        // Hitung selisih qty dan update stok
                        $original = $record->getOriginal('qty');
                        $selisih = $original - $record->qty;

                        $product = Product::find($record->product_id);
                        if ($product) {
                            $product->increment('stock', $selisih);
                        }

                        // Update subtotal dan total transaksi
                        $record->subtotal = $record->qty * $record->price;
                        $record->save();

                        $record->transaction->update([
                            'total' => $record->transaction->details()->sum('subtotal'),
                        ]);
                    }),

                Tables\Actions\DeleteAction::make()
                    ->before(function (Model $record) {
                        $product = Product::find($record->product_id);
                        if ($product) {
                            $product->increment('stock', $record->qty);
                        }
                    })
                    ->after(function (Model $record) {
                        $record->transaction->update([
                            'total' => $record->transaction->details()->sum('subtotal'),
                        ]);
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()
                    ->before(function ($records) {
                        foreach ($records as $record) {
                            $product = Product::find($record->product_id);
                            if ($product) {
                                $product->increment('stock', $record->qty);
                            }
                        }
                    })
                    ->after(function ($records) {
                        if ($records->isNotEmpty()) {
                            $transaction = $records->first()->transaction;
                            $transaction->update([
                                'total' => $transaction->details()->sum('subtotal'),
                            ]);
                        }
                    }),
            ]);
    }
}
