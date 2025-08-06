<?php

namespace App\Filament\Resources;

use App\Models\Transaction;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers\DetailsRelationManager;
use Filament\Forms\Components\Hidden;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Store';
    protected static ?string $navigationLabel = 'Transaksi';
    protected static ?string $pluralModelLabel = 'Transaksi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Hidden::make('user_id')
                    ->default(fn () => Auth::id()),

                Forms\Components\TextInput::make('name')
                    ->label('Nama Penerima')
                    ->required(),

                Forms\Components\TextInput::make('phone')
                    ->label('No HP')
                    ->tel()
                    ->required(),

                Forms\Components\Textarea::make('address')
                    ->label('Alamat Lengkap')
                    ->required(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'shipped' => 'Shipped',
                        'completed' => 'Completed',
                        'canceled' => 'Canceled',
                    ])
                    ->default('pending')
                    ->required(),

                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->numeric()
                    ->required()
                    ->disabled(),
                // Forms\Components\Textarea::make('alamat_pengiriman')
                //     ->label('No Rumah')
                //     ->required(),

                Forms\Components\FileUpload::make('bukti_dp')
                    ->label('Bukti Bayar DP')
                    ->image()
                    ->directory('bukti-dp')
                    ->imagePreviewHeight('150'),

                Forms\Components\TextInput::make('total_dp')
                    ->label('Total DP (50%)')
                    ->numeric()
                    ->prefix('Rp')
                    ->required()
                    ->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('User'),
                Tables\Columns\TextColumn::make('name')->label('Penerima'),
                Tables\Columns\TextColumn::make('phone')->label('No HP'),
                Tables\Columns\TextColumn::make('address')->label('Alamat')->limit(30),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'gray',
                        'paid' => 'success',
                        'shipped' => 'info',
                        'completed' => 'success',
                        'canceled' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('IDR', true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y, H:i'),
                Tables\Columns\TextColumn::make('alamat_pengiriman')->label('Nomor Rumah'),
                Tables\Columns\TextColumn::make('total_dp')->label('DP')->money('IDR'),
                Tables\Columns\ImageColumn::make('bukti_bayar_dp')
                    ->label('Bukti DP')
                    ->disk('public')
                    ->circular(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
        return [
            DetailsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
            'view' => Pages\ViewTransaction::route('/{record}'),
        ];
    }
}
