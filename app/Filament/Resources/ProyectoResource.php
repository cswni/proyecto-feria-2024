<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProyectoResource\Pages;
use App\Models\Proyecto;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class ProyectoResource extends Resource
{
    public static $categorias = [
        'Investigación Grado Concluida'  => 'Investigación Grado Concluida',
        'Proyecto de Emprendimiento' => 'Proyecto de Emprendimiento',
        'Docentes investigadores y estudiantes de posgrado' => 'Docentes investigadores y estudiantes de posgrado',
        'Investigación Grado Protocolo' => 'Investigación Grado Protocolo',
        'Proyecto de Innovación' => 'Proyecto de Innovación',
    ];
    protected static ?string $model = Proyecto::class;

    protected static ?string $slug = 'proyectos';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->required(),

                TextInput::make('sede')
                    ->required(),

                Select::make('categoria')
                    ->options(self::$categorias)
                    ->required(),

                TextInput::make('area')
                    ->required(),

                TextInput::make('requerimientos')
                    ->required(),

                TextInput::make('miembros')
                    ->required(),

                TextInput::make('telefonos')
                    ->required(),

                TextInput::make('tutores')
                    ->required(),

                TextInput::make('nota')
                    ->numeric(),

                Placeholder::make('created_at')
                    ->label('Created Date')
                    ->content(fn(?Proyecto $record): string => $record?->created_at?->diffForHumans() ?? '-'),

                Placeholder::make('updated_at')
                    ->label('Last Modified Date')
                    ->content(fn(?Proyecto $record): string => $record?->updated_at?->diffForHumans() ?? '-'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordClasses(fn (Model $record) => match ($record->nota) {
                '> 75' => 'opacity-30',
                'reviewing' => 'border-s-2 border-orange-600 dark:border-orange-300',
                'published' => 'border-s-2 border-green-600 dark:border-green-300',
                default => null,
            })
            ->modifyQueryUsing(function ($query) {
                $query->orderBy('nota', 'desc');
            })
            ->columns([
                TextColumn::make('nombre')->searchable()->lineClamp(5)->wrap(),
                TextColumn::make('sede')->toggleable(),
                TextColumn::make('categoria')->toggleable(),
                TextColumn::make('area')->toggleable(),
                TextColumn::make('requerimientos')->toggleable(),
                TextColumn::make('miembros')->toggleable(),
                TextColumn::make('telefonos')->toggleable(),
                TextColumn::make('tutores')->toggleable(),
                TextColumn::make('nota'),
            ])
            ->filters([
                SelectFilter::make('categoria')
                ->options(self::$categorias)
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProyectos::route('/'),
            'create' => Pages\CreateProyecto::route('/create'),
            //'edit' => Pages\EditProyecto::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
