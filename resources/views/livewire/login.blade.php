<div class="row justify-content-center align-items-center py-5" style="height: 100vh;">
  <div class="col-lg-4">
    <main class="form-signin w-100 m-auto">
      <form autocomplete="off" no-validate wire:submit.prevent="submit">
        <h1 class="h3 mb-3 fw-normal">Tienda Online</h1>

        @if(session()->has('succesfull_register'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
          {{ session()->get('succesfull_register') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($error)
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
          {{ $error }}
          <button type="button" class="btn-close" aria-label="Close" wire:click="resetError"></button>
        </div>
        @endif

        <div class="form-floating">
          <input wire:model.debounce.500ms="email" type="email" class="form-control" id="floatingInput" autocomplete="email" placeholder="email@dominio.com">
          <label for="floatingInput">Correo Electrónico</label>
        </div>
        @error('email') <small class="d-block px-2 text-danger">{{ $message }}</small> @enderror

        <div class="form-floating mt-3">
          <input wire:model.debounce.500ms="password" type="password" class="form-control" id="floatingPassword" autocomplete="new-password" placeholder="*********">
          <label for="floatingPassword">Contraseña</label>
        </div>
        @error('password') <small class="d-block px-2 text-danger">{{ $message }}</small> @enderror

        <div class="checkbox mt-3">
          <label>
            <input wire:model="remember" type="checkbox" value="remember-me"> Recordar sesión
          </label>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Iniciar Sesión</button>

        <p class="mt-3 text-center">¿Aún no tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>

        <p class="my-3 text-muted text-center">&copy; {{ now()->format('Y') }}</p>
      </form>
    </main>
  </div>
</div>
