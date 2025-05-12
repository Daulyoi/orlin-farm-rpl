<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HewanQurbanResource\Pages;
use App\Filament\Resources\HewanQurbanResource\RelationManagers;
use App\Models\HewanQurban;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\{TextInput, Select, FileUpload, Textarea};
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\{TextColumn, ImageColumn};
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HewanQurbanResource extends Resource
{
    protected static ?string $model = HewanQurban::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('jenis')
                    ->label('Jenis Hewan')
                    ->required(),

                TextInput::make('bobot')
                    ->label('Bobot (kg)')
                    ->required()
                    ->numeric(),

                TextInput::make('harga')
                    ->label('Harga')
                    ->required()
                    ->numeric(),

                Select::make('tersedia')
                    ->label('Tersedia')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'tidak' => 'Tidak Tersedia',
                    ])
                    ->default('tersedia')
                    ->required(),

                Select::make('kelamin')
                    ->label('Kelamin')
                    ->options([
                        'jantan' => 'Jantan',
                        'betina' => 'Betina',
                    ])
                    ->required(),

                Textarea::make('deskripsi')
                    ->label('Deskripsi Hewan')
                    ->required(),

                Textarea::make('lokasi')
                    ->label('Lokasi Hewan')
                    ->required(),

                FileUpload::make('foto')
                    ->label('Foto Hewan')
                    ->image()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis')
                    ->label('Jenis Hewan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('bobot')
                    ->label('Bobot (kg)')
                    ->sortable(),

                TextColumn::make('harga')
                    ->label('Harga')
                    ->sortable(),

                TextColumn::make('tersedia')
                    ->label('Tersedia')
                    ->sortable(),

                TextColumn::make('kelamin')
                    ->label('Kelamin')
                    ->sortable(),

                TextColumn::make('lokasi')
                    ->label('Lokasi')
                    ->sortable(),

                ImageColumn::make('foto')
                    ->label('Foto Hewan')
                    ->getStateUsing(function ($record) {
                        return asset('storage/' . $record->foto);
                    })
                    ->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListHewanQurbans::route('/'),
            'create' => Pages\CreateHewanQurban::route('/create'),
            'edit' => Pages\EditHewanQurban::route('/{record}/edit'),
        ];
    }
}
