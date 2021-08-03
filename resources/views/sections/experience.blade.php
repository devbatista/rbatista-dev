@if (count($experiencias) > 0)
    <div class="section" id="experience">
        <div class="container cc-experience">
            <div class="h4 text-center mb-4 title">Experiências Profissionais</div>
            @foreach ($experiencias as $experiencia)
                <div class="card">
                    <div class="row">
                        <div class="col-md-3 bg-personalizado" data-aos="fade-right" data-aos-offset="50"
                            data-aos-duration="500">
                            <div class="card-body cc-experience-header">
                                <p>{{ $experiencia->inicio }} - {{ $experiencia->fim }}</p>
                                <div class="h5">{{ $experiencia->empresa }}</div>
                            </div>
                        </div>
                        <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                            <div class="card-body">
                                <div class="h5">{{ $experiencia->cargo }}</div>
                                <p>{{ $experiencia->descricao }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
