<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\Settings;
use App\Filament\Resources\TenantResource\Pages;
use App\Filament\Resources\TenantResource\RelationManagers;
use App\Models\Tenant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Pages\SubNavigationPosition;


class TenantResource extends Resource
{
    protected static ?string $cluster = Settings::class;
    protected static ?string $model = Tenant::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static SubNavigationPosition $subNavigationPosition = SubNavigationPosition::Top;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->required()
                        ->email()
                        ->unique(table: Tenant::class, column: 'email',ignorable: null,ignoreRecord: true)
                        ->maxLength(255),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('domain')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\FileUpload::make('photo_path')
                        ->disk('public') // Usar o disco 'public'
                        ->directory('tenants/photos') // Salvar na pasta 'pdfs' dentro do disco 'public'
                        ->preserveFilenames()
                        ->image()
                        ->deletable(true)
                        ->imageResizeMode('cover')
                        ->imageCropAspectRatio('4:3')
                        ->imageEditor()
                        ->circleCropper()
                        ->downloadable()
                        ->previewable(true)
                        ->required(),
                    Forms\Components\ColorPicker::make('primary_color')
                        ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/')
                        ->required(),
                    Forms\Components\ColorPicker::make('secundary_color')
                        ->regex('/^#([a-f0-9]{6}|[a-f0-9]{3})\b$/')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('domains.domain')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                // Tables\Filters\TrashedFilter::make(), 
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                // Tables\Actions\RestoreAction::make(),
                // Tables\Actions\ForceDeleteAction::make(),
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
            'index' => Pages\ListTenants::route('/'),
            'create' => Pages\CreateTenant::route('/create'),
            'edit' => Pages\EditTenant::route('/{record}/edit'),
        ];
    }
    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()
    //         ->withoutGlobalScopes([
    //             SoftDeletingScope::class,
    //         ]);
    // }
}
