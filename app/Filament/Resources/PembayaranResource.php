<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Models\Pembayaran;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\{DateTimePicker, Select, TextInput, FileUpload, View, Placeholder};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\{TextColumn, BadgeColumn, ImageColumn};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class PembayaranResource extends Resource
{
    protected static ?string $model = Pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('status')
                    ->options([
                        'waiting' => 'Waiting',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
                Select::make('metode')
                    ->options([
                        'qris' => 'QRIS',
                        'transfer' => 'Transfer',
                    ])
                    ->disabled(),
                TextInput::make('jumlah')
                    ->disabled(),
                DateTimePicker::make('tanggal')
                    ->disabled(),
                View::make('admin.components.bukti-preview')
                    ->view('admin.components.bukti-preview')
                    ->columnSpanFull(),
                Placeholder::make('View Pemesanan')
                    ->label('Pemesanan Details')
                    ->content(fn($record) => view('admin.components.pemesanan-link', ['record' => $record])),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('metode'),
                TextColumn::make('jumlah'),
                TextColumn::make('status')->badge(),
                TextColumn::make('pemesanan.id')->label('Pemesanan ID'),
                TextColumn::make('tanggal')->dateTime(),
            ])
            ->filters([
                //
            ])
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
