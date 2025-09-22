<x-shared.layout>
    <x-slot:title>Log in</x-slot:title>
    <x-shared.section-title title="{{env('APP_NAME')}}" subtitle="Entra e scopri nuove opportunità ogni giorno." />
    <div class="container-fluid mybg">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-6 height-custom mt-3">
                <form action="{{route('login')}}" method="POST" class="mybgsec shadow rounded p-5 mt-5">
                    @csrf
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Indirizzo email:</label>
                        <input type="email" class="form-control shadow" id="loginEmail" name="email" placeholder="Ex.mariorossi@mail.com">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control shadow" id="password"name="password">
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="mybutton btn shadow mt-3" type="submit">Accedi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-shared.layout>