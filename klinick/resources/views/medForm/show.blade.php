@php
	$title = 'Ficha de atendimento '.$dataMedForm->id ;
@endphp

@extends('templates.basic')


@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
	<link rel="stylesheet" href="{{asset('css/medForm/show.css')}}">
@endsection

@section('content')

	@include('templates.topMenuBar.render', ["userIsADoctor" => $user->isADoctor])

	<div class="container">
		
		<div class="row">

			<div class="col">
				<h1 class="medform-head generalThemeColorUsers">Ficha de atendimento {{ $dataMedForm->id }}</h1>
				<h6 class="head-date-city"> {{ $dataMedForm->city }} - {{ $dataMedForm->state }} às {{ $dataMedForm->date }} <br></h6>
			</div>

		</div>
		<br><br><br>
		<div class="row">
			<div class="col-6 label generalThemeColorUsers"> Queixa principal: </div>
			<div class="col-6"> {{ $dataMedForm->complaint }} </div>
		</div>

		<hr>
		
		<div class="row">
			<div class="col-6 label generalThemeColorUsers"> Pagamento: </div>
			<div class="col-6">  {{ $dataMedForm->paymentMode }} </div>
		</div>

		<hr>

		<div class="row">
			<div class="col-6 label generalThemeColorUsers"> Status da ficha: </div>
			<div class="col-6"> {{ $dataMedForm->status }} </div>
		</div>

		<div class="row">
			<div class="col-6">
				{!!Form::button('Voltar',[
					'class' => 'atrForm btn-back btn-label btn-medform-show generalThemeColorUsers',
					'id' => 'id-btn-back'
				])!!}
			</div>

			<div class="col-6">
				<!--{!!Form::submit('Excluir ficha',[
					'class' => 'atrForm btn-medform-show btnStyleGeneral',
					'id' => 'delete-button'
				])
				!!}-->

				<button type="button" class="atrForm btn-medform-show btn-label btnStyleGeneral" data-toggle="modal" data-target="#deleteModal" data-user="{{$user->id}}" data-medform="{{$dataMedForm->id}}">
					Excluir ficha
 		 		</button>

			</div>
			
		</div>
	</div>

	<!-- Modal -->
	<form id = "deleteForm" method="get" action="{{ route('medform.delete', ['user'=>$user->id, 'medform'=>$dataMedForm->id])}}">

		<input type="hidden" name="method" value="DELETE">
		<input type="hidden" name="_token" value="{{csrf_token()}}">


		<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
				
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Confirmação</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
		
					<div class="modal-body">
						Deseja excluir esta ficha de atendimento? 
					</div>

					<input type="text" name="user_id" id="user_id" value="">
					<input type="text" name="medform_id" id="medform_id" value="">

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-danger">Excluir</button>
					</div>

				</div>
			</div>
		</div>
	</form>

	<script src="{{asset('js/medForm/show.js')}}"> </script>
	<script>

		function getMedformIndexUrl(){
			url = "{{route('medform.index', $user->id)}}";
			return url;
		}

		$('#deleteModal').on('show.bs.modal', function(event){

			var button = $(event.relatedTarget);
			var recipientUser = button.data('user');
			var recipientMedform = button.data('medform');
			console.log(recipientUser);
			console.log(recipientMedform);

			var modal = $(this);
			modal.find('#user_id').val(recipientUser);
			modal.find('#medform_id').val(recipientMedform);

		})

	</script>

@endsection
