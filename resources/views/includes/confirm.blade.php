<script>
	$(".btn-delete").click(function () {

        var id       = $(this).attr('data-id');
        var route    = $(this).attr('data-route');
        var validate = '';

        $.confirm({
		    title: 'Confirma Exclusão!',
		    content: 'Ao deletar esse registro, tudo que está vinculado a ele será deletado também. Deseja Continuar?',
		    buttons: {
		        Confirma: function () {
		        	$.ajax({
		                method: 'POST',
		                type: 'json',
		                url: route,
		                data: {
		                    _token: $("input[type=hidden][name=_token]").val(),
		                    id: id, 
		                },
		                success: function (marca) 
		                {

		                    $.alert('Exclusão Confirmada!');
		            		location.reload(true);
		                }

		            });

		        },
		        Cancela: function () {
		            
		        }
		    }
		});

    });
</script>