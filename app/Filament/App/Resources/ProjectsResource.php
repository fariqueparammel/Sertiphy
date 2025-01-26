<?php

namespace App\Filament\App\Resources;

use Illuminate\Support\Facades\Auth;
use App\Filament\App\Resources\ProjectsResource\Pages;
use App\Filament\App\Resources\ProjectsResource\Pages\OpenProject;
use App\Filament\App\Resources\ProjectsResource\RelationManagers;
use App\Models\Projects;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Tables\Actions\Action;

class ProjectsResource extends Resource
{
    protected static ?string $model = Projects::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('Project')
                    ->required()
                    ->maxLength(255),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Project')
                    ->label('Projects')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created on'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last updated on')
            ])

            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
                // i think need to write fucntion here the the view button should take the userers project id
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

    // protected function getTableActions(): array
    // {
    //     return [
    //         Action::make('View')
    //             ->icon('heroicon-o-eye')
    //             ->url(fn(Projects $record) => route('filament.resources.projects.view', ['record' => $record->id])),
    //     ];
    // }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProjects::route('/create'),
            // 'choose' => Pages\OpenProject::route('/{record}/choose'),
            'edit' => Pages\EditProjects::route('/{record}/edit'),
            'view' => Pages\OpenProject::route('/choose'),

        ];
    }
}
