@extends('layout')

@section('title', 'Inscription Développeur')

@section('content')
    <div class="row g-4">
        <div class="col-lg-5">
            <h2 class="mb-4">Inscription Développeur Web</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card p-4">
                <form id="developpeurForm" method="POST" action="{{ route('developpeurs.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="nomPrenom" class="form-label">Nom et prénom</label>
                        <input type="text" id="nomPrenom" name="nomPrenom" value="{{ old('nomPrenom') }}"
                            class="form-control" placeholder="Ex: Jean Dupont">
                        <div class="invalid-feedback" id="nomPrenomError"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Quel langage(s) vous maîtrisez ?</label>
                        @foreach ($langages as $langage)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="langages[]"
                                    id="lang-{{ $langage->id }}" value="{{ $langage->langage }}"
                                    @checked(in_array($langage->langage, old('langages', [])))>
                                <label class="form-check-label" for="lang-{{ $langage->id }}">
                                    {{ $langage->langage }}
                                </label>
                            </div>
                        @endforeach
                        <div class="text-danger small mt-1" id="langagesError"></div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <h2 class="mb-4">Développeurs inscrits</h2>
            <div class="card">
                <div class="card-body">
                    @if ($developpeurs->isEmpty())
                        <p class="text-center text-muted mb-0">Aucun développeur inscrit.</p>
                    @else
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nom et prénom</th>
                                    <th>Langages</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($developpeurs as $dev)
                                    <tr>
                                        <td>{{ $dev->nomPrenom }}</td>
                                        <td>
                                            @foreach (json_decode($dev->langages) as $lang)
                                                <span class="badge text-bg-light border">{{ $lang }}</span>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // client-side check first; the controller validates again on the server
            $('#developpeurForm').on('submit', function (e) {
                let isValid = true;
                const nom = $('#nomPrenom');
                const nomPrenom = nom.val().trim();

                nom.removeClass('is-invalid');
                $('#langagesError').text('');

                if (nomPrenom === '') {
                    $('#nomPrenomError').text('Le nom et prénom est requis');
                    nom.addClass('is-invalid');
                    isValid = false;
                } else if (nomPrenom.indexOf(' ') === -1) {
                    $('#nomPrenomError').text('Le champ doit contenir un espace (nom et prénom)');
                    nom.addClass('is-invalid');
                    isValid = false;
                }

                if ($('input[name="langages[]"]:checked').length === 0) {
                    $('#langagesError').text('Vous devez cocher au moins un langage');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endsection
