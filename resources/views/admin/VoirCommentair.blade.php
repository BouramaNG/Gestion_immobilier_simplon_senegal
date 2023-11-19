@extends('admin.admindashboard')
@section('content')

<div class="row ">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">voir commentaire</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>
                                        <div class="form-check form-check-muted m-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input">
                                            </label>
                                        </div>
                                    </th>
                                    <th> nom de l'utilisateur </th>
                                    <th> commentaire </th>
                                    <th> date de publication du commentaire </th>
                                    
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($commentaires as $commentaire)
                                      
                                <tr>
                                    <td>
                                        <div class="form-check form-check-muted m-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input">
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        
                                        
                                        <span class="pl-2">{{$commentaire->user->nom}}</span>
                                    </td>
                                    <td> {{$commentaire->content}} </td>
                                    <td> {{$commentaire->publication_date}} </td>
                                    <td>
                                        {{-- <div class="badge badge-outline-success">aprouver</div> --}}
                                        <form action="/listercommentaire/{{$commentaire->id}}" method="POST">
                                            @csrf
                                            @method('DELETE') 
                                        <div class="badge badge-outline-warning">
                                            <button>suprimer</button>

                                        </div>
                                    </form>
                                    </td>
                                </tr>
                                @endforeach
                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
