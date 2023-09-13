@extends('layouts.master')

@section('title')
    {{ __('sentence.Edit Test') }}
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('sentence.Edit Test') }}</h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('test.store_edit') }}">
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">{{ __('sentence.Test Name') }}<font
                                    color="red">*</font></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputEmail3" name="test_name"
                                    value="{{ $test->test_name }}">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3"
                                class="col-sm-3 col-form-label">{{ __('sentence.Description') }}</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputPassword3" name="comment"
                                    value="{{ $test->comment }}">
                                <input type="hidden" name="test_id" value="{{ $test->id }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="inputSection" class="col-sm-3 col-form-label">{{ __('sentence.Form Type') }}</label>
                            <div class="col-sm-9">
                                <select multiple="multiple" class="form-control" id="inputSection" name="diagnostic_type[]">
                                    @foreach (['DIAGNOSE PEAU', 'DIAGNOSE MAIN', 'DIAGNOSE PIED'] as $option)
                                        @php
                                            $isSelected = in_array($option, json_decode($test->diagnostic_type));
                                            $isDisabled = !$isSelected ? 'disabled' : '';
                                        @endphp
                                        <option value="{{ $option }}" {{ $isSelected ? 'selected' : '' }} {{ $isDisabled }}>
                                            {{ $option }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
{{ $test->signes_particuliers_peau }}
                        <div class="form-group row " id="section-DIAGNOSE PEAU" style="display : none;">
                            <!-- Content for DIAGNOSE PEAU section -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        {{ __('sentence.skin diagnostic sheet') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="signes-particuliers-peau"
                                            class="col-sm-3 col-form-label">{{ __('sentence.SIGNES PARTICULIERS') }}</label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers" class="form-control" multiple="multiple"
                                                name="signes_particuliers_peau[]">

                                                @foreach (['Points noirs', 'Rosacée', 'Rousseurs', 'Télangiectasie', 'Pustules', 'Hypertrichose', 'Pigmentations', 'Vitiligo', 'Cicatrice', 'Chéloïdes', 'Comédons'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ in_array($option, json_decode($test->signes_particuliers_peau)) ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row " id="section-DIAGNOSE MAIN" style="display: none;">
                            <!-- Content for DIAGNOSE MAIN section -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        {{ __('sentence.hand diagnostic sheet') }}
                                    </h6>
                                </div>
                                {{-- <div class="card-body">
                                    <div class="form-group row">
                                        <label for="Etat-generale-des-mains"
                                            class="col-sm-3 col-form-label">{{ __('sentence.general hand state') }}</label>
                                        <div class="col-sm-9">
                                            <select id="Etat-generale-des-mains" class="form-control"
                                                name="Etat_generale_des_mains">

                                                @foreach (['Normale', 'Sèche', 'Très sèches', 'Atrophiées'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ $test->Etat_generale_des_mains === $option ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="Etat-des-ongles-mains"
                                            class="col-sm-3 col-form-label">{{ __('sentence.nail state') }}</label>
                                        <div class="col-sm-9">
                                            <select id="Etat-des-ongles-mains" class="form-control"
                                                name="Etat_des_ongles_mains">
                                                @foreach (['Normaux', 'Dures', 'Cassants', 'Fragiles'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ $test->Etat_generale_des_mains === $option ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="signes-particuliers-mains"
                                            class="col-sm-3 col-form-label">{{ __('sentence.particular type hand') }}</label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers" class="form-control" multiple="multiple"
                                                name="signes_particuliers_mains[]">
                                                @foreach (['Rousseurs', 'Pigmentation', 'Desquamations', 'Cicatrices'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ in_array($option, json_decode($test->signes_particuliers_mains)) ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="signes-particuliers-ongles-mains"
                                            class="col-sm-3 col-form-label">{{ __('sentence.finger state') }}</label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers-ongles" class="form-control" multiple="multiple"
                                                name="signes_particuliers_ongles_mains[]">

                                                @foreach (['Epais', 'Décollés', 'Colorés', 'Petites taches', 'Fripés', 'Friables et poudreux', 'Striées'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ in_array($option, json_decode($test->signes_particuliers_ongles_mains)) ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="soin"
                                            class="col-sm-3 col-form-label">{{ __('sentence.soin') }}</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="soin" multiple="multiple"
                                                name="soinList_main[]">
                                                @foreach (['1', '2', '3'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ in_array($option, json_decode($test->soinList_main)) ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="vernis"
                                            class="col-sm-3 col-form-label">{{ __('sentence.vernis') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="vernis"
                                                name="vernisInput_main" value="{{ $test->vernisInput_main }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="obseration-mains"
                                            class="col-sm-3 col-form-label">{{ __('sentence.obseration') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="obseration-mains"
                                                name="obserationInput_main" value="{{ $test->obserationInput_main }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>FACE INTERNE</h5>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <label for="relief"
                                                class="col-sm-3 col-form-label">{{ __('sentence.relief') }}</label>
                                            <input type="text" class="form-control" id="relief"
                                                name="reliefInput_main" value="{{ $test->reliefInput_main }}">
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="cicatrices-main"
                                                class="col-sm-3 col-form-label">{{ __('sentence.cicatrices') }}</label>
                                            <select class="form-control" id="cicatrices-main" name="cicatrices_main">
                                                @foreach (['oui', 'non'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ $test->cicatrices_main === $option ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="callosites-main"
                                                class="col-sm-3 col-form-label">{{ __('sentence.callosites') }}</label>
                                            <select class="form-control" id="callosites-main" name="callosites_main">
                                                @foreach (['oui', 'non'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ $test->callosites_main === $option ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="sp1"
                                                class="col-sm-3 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                            <textarea type="text" class="form-control" id="sp1" name="spInput_main"
                                                value="{{ $test->spInput_main }}"></textarea>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>FACE DORSALE</h5>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <label for="skinState-main"
                                                class="col-sm-3 col-form-label">{{ __('sentence.etat de la peau') }}</label>
                                            <input type="text" class="form-control" id="skinState-main"
                                                name="skinStateInput_main" value="{{ $test->skinStateInput_main }}">
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="tache-main"
                                                class="col-sm-3 col-form-label">{{ __('sentence.taches') }}</label>
                                            <select class="form-control" id="tache-main" name="tache_main">
                                                @foreach (['oui', 'non'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ $test->tache_main === $option ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="cicatrices-main-dorsal"
                                                class="col-sm-3 col-form-label">{{ __('sentence.cicatrices') }}</label>
                                            <select class="form-control" id="cicatrices-main-dorsal"
                                                name="cicatrices_main_dorsal">
                                                @foreach (['oui', 'non'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ $test->cicatrices_main_dorsal === $option ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="callosites-main-dorsal"
                                                class="col-sm-3 col-form-label">{{ __('sentence.espaces inter digitale') }}</label>
                                            <select class="form-control" id="callosites-main-dorsal"
                                                name="callosite_main_dorsal">
                                                @foreach (['oui', 'non'] as $option)
                                                    <option value="{{ $option }}"
                                                        {{ $test->callosite_main_dorsal === $option ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="sp2"
                                                class="col-sm-3 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                            <textarea type="text" class="form-control" id="sp2" name="spInput_main_dorsal"
                                                value="{{ $test->spInput_main_dorsal }}"></textarea>
                                        </div>
                                    </div>

                                </div> --}}
                            </div>
                        </div>

                        <div class="form-group row " id="section-DIAGNOSE PIED" style="display : none;">
                            <!-- Content for DIAGNOSE PIED section -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">
                                        {{ __('sentence.foot diagnostic sheet') }}</h6>
                                </div>
                                {{-- <div class="card-body">
                                    <div class="form-group row">
                                        <label for="Etat-generale-des-pied"
                                            class="col-sm-3 col-form-label">{{ __('sentence.general foot state') }}</label>
                                        <div class="col-sm-9">
                                            <select id="Etat-generale-des-pied" class="form-control"
                                                name="Etat_generale_des_pieds">
                                                <option value="Normale">Normale</option>
                                                <option value="Sèche">Sèche</option>
                                                <option value="Très sèches">Très sèches</option>
                                                <option value="Atrophiées">Atrophiées</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="Etat-des-ongles"
                                            class="col-sm-3 col-form-label">{{ __('sentence.nail state') }}</label>
                                        <div class="col-sm-9">
                                            <select id="Etat-des-ongles" class="form-control"
                                                name="Etat_des_ongles_pieds">
                                                <option value="Normaux">Normaux</option>
                                                <option value="Dures">Dures</option>
                                                <option value="Cassants">Cassants</option>
                                                <option value="Fragiles">Fragiles</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="signes-particuliers-mains"
                                            class="col-sm-3 col-form-label">{{ __('sentence.particular type foot') }}</label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers" class="form-control" multiple="multiple"
                                                name="signes_particuliers_pieds[]">
                                                <option value="Rousseurs">Rousseurs</option>
                                                <option value="Pigmentation">Pigmentation</option>
                                                <option value="Desquamations">Desquamations</option>
                                                <option value="Cicatrices">Cicatrices</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="signes-particuliers-ongles"
                                            class="col-sm-3 col-form-label">{{ __('sentence.finger state') }}</label>
                                        <div class="col-sm-9">
                                            <select id="signes-particuliers-ongles" class="form-control"
                                                multiple="multiple" name="signes_particuliers_ongles_pieds[]">
                                                <option value="Epais">Epais</option>
                                                <option value="Décollés">Décollés</option>
                                                <option value="Colorés">Colorés (jaunâtre, vert)</option>
                                                <option value="Petites taches">Petites taches</option>
                                                <option value="Fripés">Fripés</option>
                                                <option value="Friables et poudreux">Friables et poudreux</option>
                                                <option value="Striées">Striées</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="soin"
                                            class="col-sm-3 col-form-label">{{ __('sentence.soin') }}</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" id="soin" multiple="multiple"
                                                name="soinList_pied[]">
                                                <option value="1">soin 1</option>
                                                <option value="2">soin 2</option>
                                                <option value="3">soin 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="vernis"
                                            class="col-sm-3 col-form-label">{{ __('sentence.vernis') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="vernis"
                                                name="vernisInput_pied">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="obseration"
                                            class="col-sm-3 col-form-label">{{ __('sentence.obseration') }}</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="obseration"
                                                name="obserationInput_pied">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                        <div class="col-sm-9">
                                            <label for="etat_pieds"
                                                class="col-sm-3 col-form-label">{{ __('sentence.general foot state') }}</label>
                                            <input type="text" class="form-control" id="etat_pieds"
                                                name="etat_pieds">
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="cicatrices"
                                                class="col-sm-3 col-form-label">{{ __('sentence.taches foot') }}</label>
                                            <select class="form-control" id="cicatrices" name="taches_pieds">
                                                <option value="oui">{{ __('oui') }}</option>
                                                <option value="non">{{ __('non') }}</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="aureoles_pieds"
                                                class="col-sm-3 col-form-label">{{ __('sentence.aureoles') }}</label>
                                            <select class="form-control" id="aureoles_pieds" name="aureoles_pieds">
                                                <option value="oui">{{ __('oui') }}</option>
                                                <option value="non">{{ __('non') }}</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="veines_face_ext_pieds"
                                                class="col-sm-3 col-form-label">{{ __('sentence.veines face ext') }}</label>
                                            <select class="form-control" id="veines_face_ext_pieds"
                                                name="veines_face_ext_pieds">
                                                <option value="oui">{{ __('sentence.oui') }}</option>
                                                <option value="non">{{ __('sentence.non') }}</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="veines_face_int_pieds"
                                                class="col-sm-3 col-form-label">{{ __('sentence.veines face int') }}</label>
                                            <select class="form-control" id="veines_face_int_pieds"
                                                name="veines_face_int_pieds">
                                                <option value="oui">{{ __('sentence.oui') }}</option>
                                                <option value="non">{{ __('sentence.non') }}</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-9">
                                            <label for="douleur_talon_pieds"
                                                class="col-sm-3 col-form-label">{{ __('sentence.douleur talon') }}</label>
                                            <select class="form-control" id="douleur_talon_pieds"
                                                name="douleur_talon_pieds">
                                                <option value="oui">{{ __('sentence.oui') }}</option>
                                                <option value="non">{{ __('sentence.non') }}</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-9">
                                            <label for="sp2"
                                                class="col-sm-3 col-form-label">{{ __('sentence.signe particulier') }}</label>
                                            <textarea type="text" class="form-control" id="sp2" name="spInput_pieds"></textarea>
                                        </div>
                                    </div>

                                </div> --}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">{{ __('sentence.Save') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('header')
@endsection

@section('footer')
    <script type="text/javascript" defer>
        window.addEventListener('DOMContentLoaded', function() {
            var sections = document.querySelectorAll('.form-group.row[id^="section-"]');

            sections.forEach(function(section) {
                section.style.display = 'none';
            });

            document.getElementById('inputSection').addEventListener('change', function() {
                var selectedOptions = Array.from(this.selectedOptions).map(option => option.value);

                sections.forEach(function(section) {
                    if (selectedOptions.includes(section.id.replace('section-', ''))) {
                        section.style.display = 'block';
                    } else {
                        section.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <script type="text/javascript"
        src="https://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
    <!-- Initialize the plugin: -->
    <script type="text/javascript">
        $('#signes-particuliers,#signes-particuliers-ongles,#soin').multiselect();
    </script>
@endsection
