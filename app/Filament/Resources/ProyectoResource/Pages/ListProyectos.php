<?php

namespace App\Filament\Resources\ProyectoResource\Pages;

use App\Filament\Resources\ProyectoResource;
use ArielMejiaDev\FilamentPrintable\Actions\PrintAction;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProyectos extends ListRecords
{
    protected static string $resource = ProyectoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            PrintAction::make()->label('Imprimir'),
        ];
    }
}
