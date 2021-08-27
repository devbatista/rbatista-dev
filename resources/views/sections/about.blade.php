<div class="section" id="about">
    <div class="container">
        <div class="card" data-aos="fade-up" data-aos-offset="10">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="card-body">
                        <div class="h4 mt-0 title">Sobre</div>
                        {!! $perfil->sobre !!}
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="card-body">
                        <div class="h4 mt-0 title">Informações básicas</div>
                        <div class="row">
                            <div class="col-sm-4"><strong class="text-uppercase">Idade:</strong></div>
                            <div class="col-sm-8">{{ $perfil->idade }}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><strong class="text-uppercase">Email:</strong></div>
                            <div class="col-sm-8">{{ $perfil->email }}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><strong class="text-uppercase">Telefone:</strong></div>
                            <div class="col-sm-8">{{ $perfil->telefone }}</div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-4"><strong class="text-uppercase">Localidade:</strong></div>
                            <div class="col-sm-8">{{ $perfil->localidade }}</div>
                        </div>
                        @if ($perfil->cnpj)
                            <div class="row mt-3">
                                <div class="col-sm-4"><strong class="text-uppercase">CNPJ:</strong></div>
                                <div class="col-sm-8">{{ $perfil->cnpj }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
