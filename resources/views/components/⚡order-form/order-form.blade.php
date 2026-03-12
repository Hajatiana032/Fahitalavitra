<div id="modal-{{ $id }}"
     class="overlay modal overlay-open:opacity-100 hidden
         overlay-open:duration-300 overlay-backdrop-open:bg-primary/30 [--overlay-backdrop:static]"
     role="dialog"
     tabindex="-1"
     data-overlay-keyboard="false"
     wire:ignore.self>
    <div class="modal-dialog modal-dialog-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">{{ $title }}</h3>
                <button type="button"
                        class="btn btn-text btn-circle btn-sm absolute bg-accent end-3 top-3 waves"
                        aria-label="Close"
                        data-overlay="#modal-{{ $id }}">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <form wire:submit.prevent="buy">
                @csrf
                <div class="modal-body">
                    <div class="alert font-semibold alert-info mb-4 text-center">
                        <i class="fa fa-circle-exclamation"></i> Important: Vos billets seront envoyés dans votre
                                                                 adresse email. Chaque billet recevra un code unique.
                    </div>
                    <div class="mb-4 flex gap-4 max-sm:flex-col">
                        <div class="w-full">
                            <label class="label-text"
                                   for="lastname"> Nom </label>
                            <input type="text"
                                   class="input @error('lastname') is-invalid @enderror"
                                   id="lastname"
                                   wire:model="lastname"
                                   autofocus/>
                            @error('lastname')
                            <div class="text-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="label-text"
                                   for="firstname"> Prénom </label>
                            <input type="text"
                                   class="input @error('lastname') is-invalid @enderror"
                                   id="firstname"
                                   wire:model="firstname"/>
                            @error('firstname')
                            <div class="text-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-4 flex gap-4 max-sm:flex-col">
                        <div class="w-full">
                            <label class="label-text"
                                   for="email"> Email </label>
                            <input type="email"
                                   class="input @error('email') is-invalid @enderror"
                                   id="email"
                                   wire:model="email"/>
                            @error('email')
                            <div class="text-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="w-full">
                            <label class="label-text"
                                   for="phone"> Téléphone </label>
                            <input type="text"
                                   class="input @error('phone') is-invalid @enderror"
                                   id="phone"
                                   wire:model="phone"/>
                            @error('phone')
                            <div class="text-error">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="max-w-sm m-auto">
                        <label class="label-text"
                               for="quantity">Quantité</label>
                        <div class="input px-0 m-auto">
                                <span class="border-base-content/25 border-e ps-0">
                                    <button type="button"
                                            class="flex size-9.5 items-center justify-center"
                                            aria-label="decrement button"
                                            wire:click="decrement">
                                        <i class="fa fa-minus-circle"></i>
                                    </button>
                                </span>
                            <input type="text"
                                   name="quantity"
                                   id="quantity"
                                   class="input text-center px-3 @error('quantity') is-invalid @enderror"
                                   wire:model="quantity">
                            <span class="border-base-content/25 border-s ps-0">
                                    <button type="button"
                                            class="flex size-9.5 items-center justify-center"
                                            aria-label="increment button"
                                            wire:click="increment">
                                        <i class="fa fa-plus-circle"></i>
                                    </button>
                                </span>
                        </div>
                        @error('quantity')
                        <div class="text-error">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-primary waves">
                        <span class="in-data-loading:hidden">Confirmer</span>
                        <span class="not-in-data-loading:hidden"><i class="fa fa-hourglass-2 fa-spin"></i>
                                Confirmer</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
