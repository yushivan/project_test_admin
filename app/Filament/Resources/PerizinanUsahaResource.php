<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PerizinanUsahaResource\Pages;
use App\Filament\Resources\PerizinanUsahaResource\RelationManagers;
use App\Models\PerizinanUsaha;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PerizinanUsahaResource extends Resource
{
    protected static ?string $model = PerizinanUsaha::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $pluralModelLabel = 'Perizinan Usaha';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('customer_id')
                    ->relationship('customer', 'nama')
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('nama_usaha')->required(),
                Forms\Components\TextInput::make('bidang_usaha')->required(),
                Forms\Components\TextInput::make('alamat_usaha')->required(),
                Forms\Components\TextInput::make('status')->required(),
                Forms\Components\FileUpload::make('ktp')
                    ->required()
                    ->reorderable()
                    ->directory('perizinanusaha/ktp')
                    ->appendFiles()
                    ->columnStart(1)
                    ->label('Foto KTP'),
                Forms\Components\FileUpload::make('npwp')
                    ->required()
                    ->reorderable()
                    ->directory('perizinanusaha/npwp')
                    ->appendFiles()
                    ->columnStart(1)
                    ->label('Foto NPWP'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('customer.nama')->label('Customer'),
                Tables\Columns\TextColumn::make('nama_usaha'),
                Tables\Columns\TextColumn::make('bidang_usaha'),
                Tables\Columns\TextColumn::make('status'),
            ])->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListPerizinanUsahas::route('/'),
            'create' => Pages\CreatePerizinanUsaha::route('/create'),
            'edit' => Pages\EditPerizinanUsaha::route('/{record}/edit'),
        ];
    }
}
