<?php

namespace App\Filament\Clusters\Files\Resources;

use App\Filament\Clusters\Files;
use App\Filament\Clusters\Files\Resources\TxtResource\Pages;
use App\Filament\Clusters\Files\Resources\TxtResource\RelationManagers;
use App\Models\Txt;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Filament\Pages\SubNavigationPosition;

class TxtResource extends Resource
{
    protected static ?string $model = Txt::class;
    protected static ?int $navigationSort = 3;
    protected static ?string $modelLabel = 'Arquivos de Texto';
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $cluster = Files::class;
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pdf_id')
                    ->label('PDF')
                    ->relationship('pdf', 'name')
                    ->unique(table: Txt::class, column: 'pdf_id',ignorable: null,ignoreRecord: true)
                    ->required(),
                // Forms\Components\FileUpload::make('file_path')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pdf.name')
                    ->label('PDF')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('extension')
                    ->label('Extensão')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_path')
                    ->label('Caminho')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                // Ação para visualizar o conteúdo do TXT
                Tables\Actions\Action::make('viewTxtContent')
                    ->label('Ver Conteúdo do TXT')
                    ->modalHeading('Conteúdo do TXT')
                    ->modalCancelAction(false)
                    ->modalSubmitAction(false) // Remove o botão de envio (como "Salvar")
                    ->form([
                        Forms\Components\RichEditor::make('txt_content')
                            ->label('Conteúdo do TXT')
                            ->disabled(),
                    ])
                    ->mountUsing(function (Txt $record, Forms\ComponentContainer $form) {
                        // Carregar o conteúdo do TXT do arquivo
                        $txtContent = Storage::disk('public')->get($record->file_path);
                        // Substituir quebras de linha por <br>
                        $txtContent = nl2br($txtContent);
                        $form->fill([
                            'txt_content' => $txtContent,
                        ]);
                    })
                    ->hidden(function (Txt $record) {
                        // Exibir a ação apenas se a extensão for .txt
                        return $record->extension !== '.txt';
                    }),
                // Ação para baixar o arquivo TXT
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (Txt $record) {
                        if ($record->extension != ".txt") {
                            $zipFolderPath = storage_path('app/public/txts/' . basename($record->file_path, '.zip'));
                            $tempZipPath = storage_path('app/public/txts/' . basename($record->file_path, '.zip') . '_download.zip');
                            
                            $zip = new ZipArchive;
                            if ($zip->open($tempZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                                $files = scandir($zipFolderPath);
                                foreach ($files as $file) {
                                    if ($file !== '.' && $file !== '..') {
                                        $zip->addFile($zipFolderPath . '/' . $file, $file);
                                    }
                                }
                                $zip->close();
                            }
                            
                            return response()->download($tempZipPath)->deleteFileAfterSend(true);
                        }
                        return response()->download(storage_path('app/public/' . $record->file_path));
                    }),
                // Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageTxts::route('/'),
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
