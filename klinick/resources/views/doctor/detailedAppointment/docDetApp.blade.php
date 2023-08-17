@php
	$title = "Dados sobre a ficha de {$data['user']->name}" ;	
@endphp


@extends('templates.basic')


@section('loadingCss')
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&family=Press+Start+2P&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/doctor/loadAppointments/showAppointment.css')}}">
	<link rel="stylesheet" href="{{asset('css/medForm/show.css')}}">
	<link rel="stylesheet" href="{{asset('css/themeForDoctors.css')}}">
@endsection


@section('content')

	@include('templates.topMenuBar.forDoctors.layout')
	@include('templates.topMenuBar.forDoctors.rightOption')

	<div class="container">

		<div class="row">
			
			<div class="col">

			<h1 class="medform-head generalThemeColorDoctors">Ficha de atendimento {{$data['medform']->id}}</h1>
			<h6 class="head-date-city"> {{ $data['medform']->city }} - {{ $data['medform']->state }} às {{ $data['medform']->date }} <br></h6>

			</div>

		</div>

		<br><br><br>

		<div class="row">
			<div class="col div-pacient-name">
				
				<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle image-pacient" viewBox="0 0 16 16">
					<path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
					<path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
				</svg>
				
				<br>
				
				<span class="label generalThemeColorDoctors">
					{{$data['user']->name}}
				</span>
			
			</div>
		</div>

		<hr>

		<div class="row">
			<div class="col-6 label generalThemeColorDoctors">Queixa principal:</div>
			<div class="col-6"> {{$data['medform']->complaint}}  </div>
		</div>

		<hr>

		<div class="row">
			<div class="col-6 label generalThemeColorDoctors"> Pagamento: </div>
			<div class="col-6">	 {{$data['medform']->paymentMode }} </div>
		</div>

		<hr>

		<div class="row">
			<div class="col-6 label generalThemeColorDoctors"> Status da ficha: </div>
			<div class="col-6"> {{ $data['medform']->descStatus }} </div>
		</div>

		<!-- btns -->
		<div class="row">

			<div class="col-6">
				{!!Form::button('Voltar',[
					'class' => 'atrForm btn-back btn-label btn-medform-show generalThemeColorDoctors',
					'id' => 'id-btn-back'
				])!!}
			</div>

			<div class="col-6">
				<button type="button" class="atrForm btn-medform-show btn-label background-color-blue" data-toggle="modal" data-target="#deleteModal">
					Atender paciente
 		 		</button>

			</div>
		</div>

	</div>

	<form id = "formLinkMedformDoctor" method="get" action="{{ route('medform.linkMedformDoctor', ['user'=>$user->id, 'medform'=>$dataMedForm->id])}}">

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


					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
						<button type="submit" class="btn btn-danger">Excluir</button>
					</div>

				</div>
			</div>
		</div>
	</form>

	<script src="{{asset('js/doctor/detailedAppointment/docDetApp.js')}}"></script>
	<script>
		function getLoadAppointmentsUrl(){
			url = "{{route('doctor.loadAppointments')}}";
		return url;
		}
	</script>

@endsection

