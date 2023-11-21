$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Etes vous sure?',
                    text: "de vouloir supprimer votre marque?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui ,je veux bien mercie!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Supprimé!',
                        'Ok fichier supprimé !.',
                        'success'
                      )
                    }
                  })


    });

  });
