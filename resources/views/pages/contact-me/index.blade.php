@extends('layouts.app')
@include('includes.navbar')

@section('content')

    <div class="container lv-container-contact-form">
        <!-- PICTURE PAGE, SECTION START -->
            <div class="card" style="width: 18rem;">
                <img src="{{ url('../images/dance-question-mark.jpg') }}" class="card-img-top" alt="...">
            </div>
        <!-- PICTURE PAGE, SECTION END -->

        <!-- CONTACT FORM, SECTION START -->
            <div class="container-contact-form">
                <div class="container-contact-head">
                    <h1>Lorem, ipsum dolor.</h1>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum distinctio amet eos beatae culpa autem, quis consequatur alias adipisci ipsam.</p>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <div class="container-contact-main">
                    <form action="{{ route('contact-me.index') }}" method="POST">
                    @csrf
                        <div class="mb-4">
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Cum te numesti?">
                        </div>
                        <div class="mb-4">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Care este adresa ta de email?">
                        </div>
                        <div class="mb-4">
                            <textarea class="form-control form-message" id="message" name="message" placeholder="Lasa-mi un mesaj"></textarea>
                        </div>
                        <div class="my-4 form-check">
                            <input type="checkbox" class="form-check-input" id="privacy_policy" name="privacy_policy">
                            <label class="form-check-label" for="privacy_policy">Sunt de acord cu <a href="#">termenii si conditiile</a></label>
                        </div>
                        <button type="submit" class="btn btn-primary">TRIMITE MESAJUL</button>
                    </form>
                </div>
            </div>
        <!-- CONTACT FORM, SECTION END -->
    </div>

@endsection