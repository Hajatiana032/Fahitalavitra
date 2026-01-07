<?php

namespace App\Livewire;

use App\Models\Movie;
use Filament\Actions\Action;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Image;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class MoviesTmdb extends Component implements HasActions, HasSchemas
{
    use InteractsWithActions;
    use InteractsWithSchemas;

    public array $moviesList = [];

    public Movie $movie;

    public ?string $search = null;

    /**
     * @throws ConnectionException
     */
    public function mount(): void
    {
        $this->loadMovies();
    }

    /**
     * @throws ConnectionException
     */
    public function loadMovies(): void
    {
        $url = 'https://api.themoviedb.org/3/discover/movie?include_adult=false&include_video=false&language=en-US&page=1&sort_by=popularity.desc';

        if ($this->search !== null) {
            $url = 'https://api.themoviedb.org/3/search/movie?query='.urlencode($this->search);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.config('services.tmdb.api_key'),
        ])->get($url);

        $this->moviesList = $response->json('results') ?? [];
    }

    public function moviesSchema(Schema $schema): Schema
    {
        return $schema->components([
            Section::make()
                ->schema([
                    TextInput::make('search')
                        ->label('Rechercher un film')
                        ->placeholder('Titre du film…')
                        ->live()
                        ->columnSpanFull()
                        ->type('search')
                        ->afterStateUpdated(function (string $state) {
                            $this->search = $state;
                            $this->loadMovies();
                        }),
                ]),
            Grid::make()
                ->columns([
                    'default' => 1,
                    'lg' => 4,
                ])
                ->schema(
                    collect($this->moviesList)->map(
                        fn($movie) => Section::make()->schema([
                                Image::make(
                                    'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                                    $movie['title']
                                )
                                    ->imageSize('100%'),
                                Text::make(substr($movie['title'], 0, 15).'...')->color('primary')
                                    ->size(TextSize::Large)
                                    ->weight(FontWeight::Bold),
                                Text::make(substr($movie['overview'], 0, 100).'...'),
                                Action::make($movie['id'])->label('Importer')
                                    ->action(function (array $data) use ($movie) {
                                        $this->downloadPoster(
                                            'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                                            $movie['poster_path']
                                        );
                                        $inTheater = $data['in_theater'.$movie['id']] ?? false;
                                        $releaseDate = $data['release_date'.$movie['id']] ?? null;
                                        Movie::firstOrCreate([
                                            'title' => $movie['title'],
                                            'slug' => Str::slug($movie['title']),
                                            'image' => 'img/uploads/movies'.$movie['poster_path'],
                                            'synopsis' => $movie['overview'],
                                        ]);
                                    })
                                    ->icon('heroicon-o-arrow-down')
                                    ->successRedirectUrl(
                                        route(
                                            'filament.admin.resources.films.view',
                                            ['record' => Str::slug($movie['title'])]
                                        )
                                    )
                                    ->successNotificationTitle('Importer avec succès.'),
                            ]
                        )
                    )->toArray(),
                ),
        ]);
    }

    /**
     * @throws ConnectionException
     */
    public function downloadPoster(string $url, string $fileName): void
    {
        $imageUrl = $url;
        $imageContent = Http::get($imageUrl)->body();
        Storage::disk('public')->put('img/uploads/movies'.$fileName, $imageContent);
    }

    public function showAction()
    {
        return Action::make('delete')
            ->color('danger')
            ->requiresConfirmation()
            ->action(fn() => $this->post->delete());
    }

    public function render(): View
    {
        return view('livewire.movies-tmdb', ['movies' => $this->moviesList]);
    }
}
