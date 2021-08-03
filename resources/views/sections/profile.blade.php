<div class="profile-page">
    <div class="wrapper">
        <div class="page-header page-header-small" filter-color="green">
            <div class="page-header-image" data-parallax="true"
                style="background-image: url('{{ asset('assets/images/dev.jpg') }}')">
            </div>
            <div class="container">
                <div class="content-center">
                    <div class="cc-profile-image">
                        <a href="#">
                            <img src="{{ $perfil->foto }}" alt="Image" />
                        </a>
                    </div>
                    <div class="h2 title">{{ $perfil->nome }}</div>
                    <p class="category text-white">{{ $perfil->profissao }}</p>
                    <a class="btn btn-personalizado smooth-scroll mr-2" href="#contact" data-aos="zoom-in"
                        data-aos-anchor="data-aos-anchor">Contate-me</a>
                    <a class="btn btn-personalizado" href="{{ $cv->nome }}" data-aos="zoom-in"
                        data-aos-anchor="data-aos-anchor" download>Baixar CV</a>
                </div>
            </div>
            @if ($redesSociais)
                <div class="section">
                    <div class="container">
                        <div class="button-container">
                            @foreach ($redesSociais as $redeSocial)
                                <a class="btn btn-default btn-round btn-lg btn-icon" href="{{ $redeSocial->link }}"
                                    target="_blank" rel="tooltip" title="{{ ucfirst($redeSocial->nome) }}">
                                    <i class="fa fa-{{ $redeSocial->nome }}"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
