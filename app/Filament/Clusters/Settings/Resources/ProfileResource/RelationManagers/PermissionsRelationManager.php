<?php

namespace App\Filament\Clusters\Settings\Resources\ProfileResource\RelationManagers;

use App\Models\Permission;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PermissionsRelationManager extends RelationManager
{
    protected static string $relationship = 'permissions';
    protected static ?string $title = "Regras";
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('name')
                    ->label('Nome')
                    ->options(Permission::pluck('name', 'id')->toArray()),
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                ->preloadRecordSelect() // Evita múltiplas associações
                ->form(fn (Tables\Actions\AttachAction $action): array => [
                    $action->getRecordSelect()
                        ->options(fn ($livewire) => Permission::whereNotIn('id', 
                            $livewire->ownerRecord->permissions->pluck('id')
                        )->pluck('name', 'id')->toArray())
                        ->required(),
                ]),  
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DetachBulkAction::make(),
            ]);
    }
}
