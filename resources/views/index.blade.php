@include('header')
@include('preloader')
<div class="container">
    <section class="search">
        <div class="row search-row">
            <div class="col-md-12">
                <h2>Pokemon Finder</h2>
                <small>EL que quiera pokemon que lo busque</small>
            </div>
            <div class="col-md-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Ingrese el nombre a buscar" id="search">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="button" id="btnSearch">Buscar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <br />
    <section>
        <div id="msg" class="alert alert-danger d-none" role="alert"></div>
        <h4 id="result" class="d-none">Resultado de la Busqueda</h4>
        <div class="row" id="content-data">
            @foreach($data["pokemones"] as $pokemon)
            <div class="col-md-4" style="margin-bottom: 10px;">
                <article class="card">
                    <div class="card-header" style="background: #5a5a5a;"></div>
                    <div class="card-body">
                        <img hei src="{{ $pokemon['image'] }}" alt="imagen de vitoko" class="card-body-img">
                        <h5 style="color: #014601; font-weight: bold;">{{ ucfirst($pokemon["name"]) }}</h5>
                    </div>
                    <div class="card-footer">
                        <div class="card-footer-social">
                            <h3>{{ $pokemon["experience"] }}</h3>
                            <p>Experiencia</p>
                        </div>
                        <div class="card-footer-social">
                            <h3>{{ $pokemon["attack"] }}</h3>
                            <p>Ataque</p>
                        </div>
                        <div class="card-footer-social">
                            <h3>{{ $pokemon["hp"] }}</h3>
                            <p>HP</p>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </section>
    <div class="row">
        <div class="col-md-6 offset-md-6 text-right" id="paginate">
            <button type="button" class="btn btn-outline-secondary" id="previous" {{ $data['previous'] == null ? 'disabled' : '' }} data-route="{{ !$data['previous'] == null ? $data['previous'] : '' }}">Anterior</button> &nbsp;
            <button type="button" class="btn btn-outline-secondary" id="next" {{ $data['next'] == null ? 'disabled' : '' }} data-route="{{ !$data['next'] == null ? $data['next'] : '' }}">Siguiente</button>
        </div>
    </div>
</div>
@include('footer')