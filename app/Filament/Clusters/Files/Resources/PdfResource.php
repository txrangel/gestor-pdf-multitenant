<?php

namespace App\Filament\Clusters\Files\Resources;

use App\Filament\Clusters\Files;
use App\Filament\Clusters\Files\Resources\PdfResource\Pages;
use App\Filament\Clusters\Files\Resources\PdfResource\RelationManagers;
use App\Models\Pdf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Pages\SubNavigationPosition;

class PdfResource extends Resource
{
    protected static ?string $model = Pdf::class;
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Arquivos PDF';
    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $cluster = Files::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Criação')
                    ->sortable()
                    ->searchable()
                    ->dateTime(),
                    
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(fn ($record) => response()->download(storage_path('app/public/' . $record->file_path))),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListPdfs::route('/'),
            'create' => Pages\CreatePdfCustom::route('/create'),
            // 'edit' => Pages\EditPdf::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
