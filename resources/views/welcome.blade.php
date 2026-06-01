@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">

```
        <div class="card">
            <div class="card-header">
                Welcome
            </div>

            <div class="card-body">
                <h1 class="display-4">Laravel UI + Bootstrap</h1>

                <p class="lead">
                    Ваше приложение успешно настроено.
                </p>

                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary me-2">
                        Войти
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-outline-primary">
                        Регистрация
                    </a>
                @else
                    <a href="{{ url('/home') }}" class="btn btn-success">
                        Перейти в панель
                    </a>
                @endguest
            </div>
        </div>

    </div>
</div>
```

</div>
@endsection
