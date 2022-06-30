@extends('layouts.app')

@section('navcategory')
    <a class="me-3" href="{{ url('admin/user') }}" style="color: orange"> PROFILO</a>
    @if (count($user->categories))
        <a class="me-3" href="{{ route('admin.categories.edit', $user->id) }}" style="color: orange"> CATEGORIE </a>
        <a class="me-3" href="{{ url('admin/plates') }}" style="color: orange">PIATTI</a>
    @else
        <a class="me-3" href="{{ route('admin.categories.create', $user->id) }}" style="color: orange"> CATEGORIE </a>
        <a class="me-3" href="#" style="color: orange">PIATTI</a>
    @endif
    <a class="me-3" href="{{ url('#') }}" style="color: orange"> ORDINI </a>
    <a class="me-3" href="{{ url('#') }}" style="color: orange"> STATISTICHE </a>
@endsection

@section('content')
    <div class="container-fluid t4-h100vh mt-5">
        <div class="row text-center mt-5 mb-5">
            <div class="col-12">
                <h2>Benvenuto {{ $user->name }}!</h2>
                <h4>In questa sezione potrai visualizzare e modificare i tuoi dati</h4>
                @if (count($user->categories) == 0)
                    <h5>Inserisci almeno una Categoria per poter utilizzare tutte le funzioni</h5>
                    <div>
                        <a class="btn t4-add-btn d-flex align-items-center me-3"
                            href="{{ route('admin.categories.create', $user->id) }}">Aggiungi categoria</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="row mt-5 justify-content-xl-center justify-content-md-end mb-5">

            {{-- Immagine profilo --}}
            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype='multipart/form-data'>
                    @csrf
                    @method('PUT')
                    <div class="mb-3 d-flex flex-column align-items-center justify-content-around">

                        <label class='t4-label-coverUser' for="coverUser" style="cursor: pointer">
                            @if ($user->image == 'company-default.png')
                                <img src="{{ asset('storage/images/' . $user->image) }}" alt="{{ $user->name }}">
                            @else
                                <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}">
                            @endif

                        </label>


                        <label for="coverUser" class="form-label"><input id='coverUser' type="file"
                                name='coverUser' /></label>



                        @error('coverUser')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror


                        <div class="form-group">
                            <button type="submit" class="btn t4-add-btn d-flex align-items-center me-3">
                                <img src="/images/upload.png" alt="">
                                <span class="me-2 ms-2">Cambia</span>
                                <img src="/images/upload.png" alt="">
                            </button>
                        </div>

                    </div>
                </form>
                {{-- /fine form immagine --}}


            </div>

            {{-- Dati Utenti --}}

            <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-6 d-flex flex-column align-items-start t4-dataUser">

                <h2>I tuoi Dati</h2>
                <label for="">Nome azienda</label>
                <p>{{ $user->company }}</p>
                <label for="">E-mail</label>
                <p>{{ $user->email }}</p>
                <label for="">Indirizzo</label>
                <p>{{ $user->address }}</p>
                <label for="">Partita IVA</label>
                <p>{{ $user->partita_iva }}</p>

            </div>

            <div
                class="col-xxl-2 col-xl-3 col-lg-3 col-md-4 t4-img-data d-xxl-block d-xl-block d-lg-block d-md-none d-sm-none">
                <img src="/images/video-call.png" alt="">
            </div>


        </div>



        <div class="row text-center">
            <h1>Le tue Categorie</h1>
        </div>

        {{-- Sezione Categorie --}}
        @if (count($user->categories))
            <div class="row justify-content-center mt-3 ">
                @foreach ($user->categories as $category)
                    <div class="col-auto d-flex flex-column align-items-center t4-card-categories">
                        <span>{{ $category->name }}</span>
                        <img src="{{ asset('storage/images/category_img/' . $category->image) }}"
                            alt="{{ $category->name }}" style="width:150px">
                    </div>
                @endforeach
            </div>



            <div class="d-flex t4-w100 justify-content-center mt-5 mb-5">

                <button class="btn t4-add-btn d-flex align-items-center me-3 t4-link-hover">
                    <a class="t4-orange-text" href="{{ route('admin.categories.edit', $user->id) }}">Modificale tue
                        categorie <span>
                            <img src="/images/edit-document.png" alt="edit-icon">
                        </span>
                    </a>
                </button>

            </div>
        @else
            <p>Al momento non possiedi alcuna categoria</p>
            <a class="btn t4-add-btn d-flex align-items-center me-3"
                href="{{ route('admin.categories.create', $user->id) }}">Aggiungi categoria</a>
        @endif
    </div>
@endsection
