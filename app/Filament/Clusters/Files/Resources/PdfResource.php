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
use Illuminate\Support\Facades\Auth;

class PdfResource extends Resource
{
    protected static ?string $model = Pdf::class;
    protected static ?int $navigationSort = 1;
    protected static ?string $modelLabel = 'Arquivos PDF';
    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?string $cluster = Files::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function canViewAny(): bool
    {
        return Auth::user()->hasPermission('pdf.view');
    }

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
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Criador')
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
        $user = Auth::user();

        // 1. O usuário pode ver QUALQUER PDF? (Ex: admin)
        // Usamos a lógica da Policy que já definimos.
        if ($user->can('viewAny', Pdf::class)) {
            return parent::getEloquentQuery()->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
        }

        // 2. Se não, o usuário precisa da permissão básica para 'ver'
        if (!$user->hasPermission('pdf.view')) {
            return parent::getEloquentQuery()->whereRaw('0 = 1'); // Retorna uma consulta vazia
        }

        // 3. Se tiver a permissão, filtramos para mostrar apenas os PDFs dele
        return parent::getEloquentQuery()
            ->where('user_id', $user->id)
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
