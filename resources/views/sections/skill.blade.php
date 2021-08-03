@if (count($skills) > 0)
    <div class="section" id="skill">
        <div class="container">
            <div class="h4 text-center mb-4 title">Principais Skills</div>
            <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="card-body">
                    @foreach ($skills as $skill)
                        @if (!isset($cont))
                            @php
                                $cont = 1;
                            @endphp
                            <div class="row">
                        @endif

                        <div class="col-md-6">
                            <div class="progress-container progress-personalizado">
                                <span class="progress-badge">{{ $skill->skill }}</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-personalizado" data-aos="progress-full"
                                        data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                        style="width: {{ $skill->porcentagem }}%;">
                                    </div>
                                    <span class="progress-value">{{ $skill->porcentagem }}%</span>
                                </div>
                            </div>
                        </div>

                        @if ($cont == 2)
                </div>
                @php
                    unset($cont);
                @endphp
            @else
                @php
                    $cont++;
                @endphp
@endif
@endforeach
</div>
</div>
</div>
</div>
@endif
