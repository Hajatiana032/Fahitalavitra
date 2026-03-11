<header class="bg-base-100 flex w-full flex-wrap text-sm md:flex-nowrap md:justify-start md:py-0 sticky top-0 z-1
mb-5">
    <nav class="mx-auto w-full px-4 shadow-xs shadow-accent py-2"
         aria-label="Global">
        <div class="relative md:flex md:items-center">
            <div class="flex items-center justify-between">
                <a class="link text-base-content link-neutral text-xl font-bold no-underline"
                   href="{{ route('home') }}"
                   wire:navigate>
                    Fahitalavitra
                </a>
                <div class="md:hidden">
                    <button type="button"
                            class="collapse-toggle btn btn-outline btn-secondary btn-sm btn-square"
                            data-collapse="#navbar-mega-menu-click"
                            aria-controls="navbar-mega-menu-click"
                            aria-label="Toggle navigation">
                        <span class="fa fa-bars collapse-open:hidden!"></span>
                        <span class="fa fa-close collapse-open:block! hidden!"></span>
                    </button>
                </div>
            </div>
            <div id="navbar-mega-menu-click"
                 class="collapse hidden grow basis-full overflow-hidden rounded-lg transition-all duration-300 md:block">
                <div
                    class="flex flex-col rounded-lg max-md:mt-3 max-md:border max-md:p-2 md:flex-row md:items-center md:justify-end md:ps-5 md:pe-0.5 gap-2 max-md:border-base-content/20">
                    <ul class="menu md:menu-horizontal text-base px-0 max-md:w-fit max-md:py-0 gap-2">
                        <li>
                            <a href="{{ route('home') }}"
                               @class(['hover:bg-primary','bg-primary' => request()->routeIs('home'),]) wire:navigate>Accueil</a>
                        </li>
                        <li>
                            <a href="{{ route('projection.list') }}"
                               @class(['hover:bg-primary font-normal', 'bg-primary' =>
                               request()->routeIs('projection.list')])
                               wire:navigate>
                                Actuellement en salle
                            </a>
                        </li>
                    </ul>
                    <div
                        class="dropdown [--adaptive:none] [--auto-close:inside] [--mega-menu:true] [--strategy:static] md:[--strategy:absolute]">
                        <button @class([
                            'dropdown-toggle btn btn-text hover:bg-primary font-normal',
                            'bg-primary' => request()->routeIs('genres'),
                        ]) aria-haspopup="menu"
                                aria-expanded="false"
                                aria-label="Dropdown">
                            Genres
                            <span class="fa fa-chevron-circle-down dropdown-open:rotate-180 size-4"></span>
                        </button>
                        <div class="dropdown-menu dropdown-open:opacity-100 start-0 top-full hidden w-full min-w-60 rounded-lg py-2 opacity-0 transition-[opacity,margin] duration-[0.1ms] before:absolute max-md:border max-md:shadow-none max-md:border-base-content/20"
                             role="menu"
                             aria-orientation="vertical">
                            <ul class="menu md:menu-horizontal rounded-box w-full max-xl:gap-4 p-0 flex justify-center">
                                <livewire:genres/>
                            </ul>
                        </div>
                    </div>
                    <ul class="menu md:menu-horizontal text-base px-0 max-md:w-fit max-md:py-0 gap-2">
                        <li>
                            <a href="{{ route('contact') }}"
                               @class([
                                                          'hover:bg-primary',
                                                          'bg-primary' => request()->routeIs('contact'),
                                                      ]) wire:navigate>Contact</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>
</header>
