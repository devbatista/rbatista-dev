@if ($academico)
    <div class="section">
        <div class="container cc-education">
            <div class="h4 text-center mb-4 title">Acadêmica</div>
            @foreach ($academico as $item)
                <div class="card">
                    <div class="row">
                        <div class="col-md-3 bg-personalizado" data-aos="fade-right" data-aos-offset="50"
                            data-aos-duration="500">
                            <div class="card-body cc-education-header">
                                <p>{{ $item->inicio }} - {{ $item->fim }}</p>
                                <div class="h5">{{ $item->tipo }}</div>
                            </div>
                        </div>
                        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                            <div class="card-body">
                                <div class="h5">{{ $item->instituicao }}</div>
                                <p class="category">{{ $item->titulo }}</p>
                                <p>{{ $item->descricao }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
