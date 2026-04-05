<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-code-bracket-square';
    protected static ?string $navigationGroup = 'Portfolio';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Project Details')->schema([
                Forms\Components\TextInput::make('title')->required()->maxLength(255)->columnSpanFull(),
                Forms\Components\Textarea::make('description')->required()->rows(4)->columnSpanFull(),
                Forms\Components\FileUpload::make('image')
                    ->image()->directory('projects')
                    ->imageResizeMode('cover')->imageCropAspectRatio('16:9')
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('tech_tags')->placeholder('Add technology...')->columnSpanFull(),
                Forms\Components\Select::make('category')
                    ->options(['web'=>'Web Platform','desktop'=>'Desktop Solution','other'=>'Other'])
                    ->required()->default('web'),
                Forms\Components\Toggle::make('featured')->label('Featured Project'),
                Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
                Forms\Components\TextInput::make('live_url')->url()->label('Live URL'),
                Forms\Components\TextInput::make('repo_url')->url()->label('Repository URL'),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->square(),
                Tables\Columns\TextColumn::make('title')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('category')->badge()
                    ->color(fn(string $s) => match($s){ 'web'=>'info','desktop'=>'warning',default=>'gray' }),
                Tables\Columns\IconColumn::make('featured')->boolean(),
                Tables\Columns\TextColumn::make('sort_order')->sortable(),
            ])
            ->defaultSort('sort_order')
            ->reorderable('sort_order')
            ->filters([Tables\Filters\SelectFilter::make('category')->options(['web'=>'Web','desktop'=>'Desktop','other'=>'Other'])])
            ->actions([Tables\Actions\EditAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
