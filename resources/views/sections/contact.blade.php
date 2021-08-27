<div class="section" id="contact">
    <div class="cc-contact-information" style="background-image: url('{{ asset('assets/images/maps.jpg') }}')">
        <div class="container">
            <div class="cc-contact">
                <div class="row">
                    <div class="col-md-9">
                        <div class="card mb-0" data-aos="zoom-in">
                            <div class="h4 text-center title">Entre em Contato</div>
                            @if (session('success'))
                                <br>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true" color="#fff">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('error'))
                                <br>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true" color="#fff">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true" color="#fff">&times;</span>
                                    </button>
                                    <ul>
                                        <h5><i class="icon fa fa-ban"></i> Ocorreu um erro.</h5>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <form action="{{ route('mensagem') }}" method="POST">
                                            @csrf
                                            <div class="p pb-3"><strong>Sinta-se a vontade para me enviar
                                                    uma mensagem</strong></div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="input-group"><span class="input-group-addon"><i
                                                                class="fa fa-user-circle"></i></span>
                                                        <input class="form-control" type="text" name="nome"
                                                            placeholder="Nome" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="input-group"><span class="input-group-addon"><i
                                                                class="fa fa-phone"></i></span>
                                                        <input class="form-control" type="text" name="telefone"
                                                            placeholder="Telefone" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="input-group"><span class="input-group-addon"><i
                                                                class="fa fa-envelope"></i></span>
                                                        <input class="form-control" type="email" name="email"
                                                            placeholder="E-mail" required="required" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <textarea class="form-control" name="mensagem"
                                                            placeholder="Sua Mensagem" required="required"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn btn-personalizado" type="submit">Enviar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <p class="mb-0"><strong>Localidade</strong></p>
                                        <p class="pb-2">{{ $perfil->localidade }}</p>
                                        <p class="mb-0"><strong>Telefone</strong></p>
                                        <p class="pb-2">{{ $perfil->telefone }}</p>
                                        <p class="mb-0"><strong>Email</strong></p>
                                        <p>{{ $perfil->email }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
