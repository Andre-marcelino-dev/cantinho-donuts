<!-- Contact Section -->
    <section class="contact-section" id="fale-conosco">
        <div class="auto-container">
            <div class="sec-title text-center">
                <div class="divider"><img src="{{ asset('davilla/images/icons/divider_1.png') }}" alt=""></div>
                <h2>Nossos Contatos</h2>
                <div class="text">Tire suas dúvidas, faça encomendas, peça um orçamento ou mande sugestões.<br> Respondemos o mais rápido possível.</div>
            </div>

            <div class="row clearfix">
                <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12">
                    <div class="inner-column">
                        <div class="title">
                            <div class="icon"><img src="{{ asset('davilla/images/icons/icon-devider-gray.png') }}" alt=""></div>
                            <h4>Horários de funcionamento</h4>
                        </div>

                        <ul class="contact-info">
                            <li>Segunda a sexta <br>08:00 – 17:30</li>
                            <li>Sábado <br>09:00 – 16:00</li>
                            <li>Domingo <br>Fechado</li>
                        </ul>
                    </div>
                </div>

                <div class="column col-xl-3 col-lg-6 col-md-6 col-sm-12 order-3">
                    <div class="inner-column">
                        <div class="title">
                            <div class="icon"><img src="{{ asset('davilla/images/icons/icon-devider-gray.png') }}" alt=""></div>
                            <h4>Nossos contatos</h4>
                        </div>

                        {{-- TODO: trocar pelo endereço, telefone e e-mail reais da confeitaria --}}
                        <ul class="contact-info">
                            <li>785 Carriage Drive, Jacksonville Beach, FL</li>
                            <li><a href="tel:12032842818">+1 203-284-2818</a><br><a href="tel:12032842919">+1 203-284-2919</a></li>
                            <li><a href="mailto:info@your-site.com">info@your-site.com</a><br> <a href="mailto:sales@your-site.com">sales@your-site.com</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="column col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="title">
                            <div class="icon"><img src="{{ asset('davilla/images/icons/icon-devider-gray.png') }}" alt=""></div>
                            <h4>Envie sua mensagem</h4>
                        </div>
                        <div class="contact-form">
                            {{-- id diferente de "email-form" para o script.js do modelo não interceptar o envio --}}
                            <form action="{{ route('contato.enviar') }}#fale-conosco" method="post" id="form-contato">
                                @csrf
                                <input type="hidden" name="origem" value="contato">

                                <div class="form-group">
                                    @if (session('sucesso_contato'))
                                        <div class="alert alert-success">{{ session('sucesso_contato') }}</div>
                                    @endif
                                    @if ($errors->contato->any())
                                        <div class="alert alert-danger">{{ $errors->contato->first() }}</div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <input type="text" name="nome_contato" placeholder="Seu nome *" maxlength="50" required
                                        value="{{ old('origem') === 'contato' ? old('nome_contato') : '' }}">
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email_contato" placeholder="Seu e-mail *" maxlength="80" required
                                        value="{{ old('origem') === 'contato' ? old('email_contato') : '' }}">
                                </div>

                                <div class="form-group">
                                    <input type="text" inputmode="tel" name="telefone_contato" placeholder="Telefone / WhatsApp *" maxlength="14" required
                                        value="{{ old('origem') === 'contato' ? old('telefone_contato') : '' }}">
                                </div>

                                <div class="form-group">
                                    <select name="assunto_contato" required>
                                        <option value="">Assunto *</option>
                                        @foreach ($assuntos as $assunto)
                                            <option value="{{ $assunto }}" {{ old('origem') === 'contato' && old('assunto_contato') === $assunto ? 'selected' : '' }}>
                                                {{ $assunto }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <textarea name="mensagem_contato" placeholder="Sua mensagem *" maxlength="2000" required>{{ old('origem') === 'contato' ? old('mensagem_contato') : '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <button class="theme-btn" type="submit">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Contact Section -->