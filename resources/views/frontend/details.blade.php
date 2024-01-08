
<section class="container m-t-2">
        <h3 class="m-b-2">Détails du Bien</h3>

        <div class="row">
            <div class="col-xs-12">
                <article class="card">
                    <div class="card-block text-xs-center head">
                        <h4 class="card-title">Bien: {{ $bien->nom }}</h4>
                        <h6 class="card-subtitle">Adresse: {{ $bien->adresse }}</h6>
                    </div>
                    <figure>
                        <img src="{{ asset('product/' . $bien->image) }}" class="img-fluid" alt="Image du bien">
                    </figure>
                    <div class="card-block text-xs-center">
                        <p class="card-text">{{ $bien->description }}</p>
                        <figure class="description">
                            <span><i class="fa fa-bed" aria-hidden="true"></i>{{ $bien->categorie }}</span>
                            <span><i class="fa fa-tree" aria-hidden="true"></i>{{ $bien->status }}</span>
                            <span><i class="fa fa-tint" aria-hidden="true"></i>{{ $bien->date }}</span>
                        </figure>
                    </div>
                </article>
            </div>
        </div>

        <!-- Formulaire de commentaire -->
        <div class="row">
            <div class="col-xs-12">
                <h4 class="m-t-2">Laissez un commentaire</h4>
                <form action="{{ route('comment.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="bien_id" value="{{ $bien->id }}">
                    <div class="form-group">
                        <label for="commentaire">Commentaire</label>
                        <textarea class="form-control" name="commentaire" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer le commentaire</button>
                </form>
            </div>
        </div>

    </section>
