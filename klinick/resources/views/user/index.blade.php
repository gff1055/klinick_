@php
	$title = 'Home';
@endphp

@extends('templates.basic')


@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
@endsection

@section('content')

	@include('templates.topMenuBar.render', ["user" => $user])

	<div class="mdl modal fade" id="tokenCreationForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Novo atendimento: </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				{!! Form::open([
					'route' => ['medform.store',$user->id],
					//'class' => 'formRegister'
					])
				!!}

				Preencha o formulario. Assim que a ficha for gerada algum medico entrará em contato...
			
				<div class="modal-body">
					
					<div class="row">
						<div class="col-8">
							{!! Form::text('city', null, [
								'class' => 'atrForm',
								'placeholder' => 'Cidade'
							]) !!}
						</div>
						<div class="col-4">
							{!! Form::text('state', null, [
								'class' => 'atrForm',
								'placeholder' => 'Estado'
							]) !!}
						</div>
					</div>

					<br>
					
					<div class="row">
						<div class="col-12">
							<span class="notice">
								* Preencha o campo com o máximo de informação possivel
								<ul>
									<li> O que está sentindo</li>
									<li> Historico familiar </li>
									<li> Rémedios que está tomando ou já tomou </li>
								</ul>
							</span>
							{!! Form::textarea('complaint', null, [
								'class' => 'atrForm',
								'placeholder' => 'Queixa',
								'rows' => "8"
							]) !!}
						</div>
					</div>
					
					<br>

					<span class="labelField">Forma de pagamento: </span>
					{!! Form::select('paymentMethod', array(
						'dinheiro' => 'Dinheiro',
						'cartão de crédito' => 'Cartão de Crédito',
						'cartão de débito' => 'Cartão de Drédito',
						'pix' => 'PIX',
						'convênio' => 'Convênio'
					),[
						'class'=>'atrForm',
					]) !!}
					
					<br>
					<span class="notice">
						*Apenas carater informativo, valor da consulta será acordado entre médico e paciente
					</span>

				
				</div>
				
				<div class="modal-footer">
					<!--<button type="button" class="btn colorTheme buttonOk">Ok, eu entendi</button>-->
					{!!Form::submit('Retirar ficha',[
						//'class' => 'atrForm',
						'class' => 'atrForm btn colorTheme buttonOk',
						'id' => 'submitMedFormBtn'
					])!!}
					<button type="button" id="btnExitModalRegistrationForm" class="atrForm btn btn-secondary" data-dismiss="modal">Sair</button>
				</div>

				{!!Form::close()!!}
				
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<h3 class="generalThemeColorUsers">@php
					echo 'Olá <br> Bem vindo <b>'.$user->name.'</b>';
					@endphp
				</h3>
			</div>
		</div>

			

		<div class="row">
			<div class="col-12">
				<button type="button" class="btn menuOptionButton" data-toggle="modal" data-target="#tokenCreationForm">
					<div class="m-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-calendar2-plus" viewBox="0 0 16 16">
							<path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"/>
							<path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4zM8 8a.5.5 0 0 1 .5.5V10H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V11H6a.5.5 0 0 1 0-1h1.5V8.5A.5.5 0 0 1 8 8z"/>
						</svg>
					</div>
					Novo<br>Atendimento
				</button>
			</div>
		</div>
		<br>		
		<div class="row">
			
			<div class="col-6">
				<button type="button" class="btn menuOptionButton" data-toggle="modal">
					<div class="m-1 rounded-circle">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-alarm-fill" viewBox="0 0 16 16">
							<path d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07a7.001 7.001 0 0 1 3.274 12.474l.601.602a.5.5 0 0 1-.707.708l-.746-.746A6.97 6.97 0 0 1 8 16a6.97 6.97 0 0 1-3.422-.892l-.746.746a.5.5 0 0 1-.707-.708l.602-.602A7.001 7.001 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5zm2.5 5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9V5.5zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.035 8.035 0 0 0 .86 5.387zM11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.035 8.035 0 0 0-3.527-3.527z"/>
						</svg>
					</div>
					Atendimentos<br>em espera
				</button>
			</div>
			
			<div class="col-6">
				<button type="button" class="btn menuOptionButton" data-toggle="modal">
					<div class="m-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-clipboard2-pulse" viewBox="0 0 16 16">
							<path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
							<path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
							<path d="M9.979 5.356a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.926-.08L4.69 10H4.5a.5.5 0 0 0 0 1H5a.5.5 0 0 0 .447-.276l.936-1.873 1.138 3.793a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h.5a.5.5 0 0 0 0-1h-.128L9.979 5.356Z"/>
						</svg>
					</div>
					Atendimentos<br>em andamento
				</button>
			</div>
		</div>
		<br>		
		<div class="row">
			
			<div class="col-6">
				<button type="button" class="btn menuOptionButton" data-toggle="modal">
					<div class="m-1 rounded-circle">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-clipboard2-check" viewBox="0 0 16 16">
							<path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
							<path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
							<path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3Z"/>
						</svg>
					</div>
					Atendimentos<br>finalizados
				</button>
			</div>
			
			<div class="col-6">
				<button type="button" class="btn menuOptionButton" data-toggle="modal">
					<div class="m-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-clipboard2-check" viewBox="0 0 16 16">
							<path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
							<path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
							<path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3Z"/>
						</svg>
					</div>
					Consultas<br>finalizadas
				</button>
			</div>
		</div>
		<br>		
		<div class="row">
			
			<div class="col-6">
				<button type="button" class="btn menuOptionButton" data-toggle="modal">
					<div class="m-1 rounded-circle">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-clipboard2-pulse" viewBox="0 0 16 16">
							<path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
							<path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
							<path d="M9.979 5.356a.5.5 0 0 0-.968.04L7.92 10.49l-.94-3.135a.5.5 0 0 0-.926-.08L4.69 10H4.5a.5.5 0 0 0 0 1H5a.5.5 0 0 0 .447-.276l.936-1.873 1.138 3.793a.5.5 0 0 0 .968-.04L9.58 7.51l.94 3.135A.5.5 0 0 0 11 11h.5a.5.5 0 0 0 0-1h-.128L9.979 5.356Z"/>
						</svg>
					</div>
					Consultas<br>em andamento
				</button>
			</div>
			
			<div class="col-6">
				<button type="button" class="btn menuOptionButton" data-toggle="modal">
					<div class="m-1">
						<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-clipboard2-check" viewBox="0 0 16 16">
							<path d="M9.5 0a.5.5 0 0 1 .5.5.5.5 0 0 0 .5.5.5.5 0 0 1 .5.5V2a.5.5 0 0 1-.5.5h-5A.5.5 0 0 1 5 2v-.5a.5.5 0 0 1 .5-.5.5.5 0 0 0 .5-.5.5.5 0 0 1 .5-.5h3Z"/>
							<path d="M3 2.5a.5.5 0 0 1 .5-.5H4a.5.5 0 0 0 0-1h-.5A1.5 1.5 0 0 0 2 2.5v12A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-12A1.5 1.5 0 0 0 12.5 1H12a.5.5 0 0 0 0 1h.5a.5.5 0 0 1 .5.5v12a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5v-12Z"/>
							<path d="M10.854 7.854a.5.5 0 0 0-.708-.708L7.5 9.793 6.354 8.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3Z"/>
						</svg>
					</div>
					Consultas<br>finalizadas
				</button>
			</div>
		</div>

	</div>	

	<script src="{{asset('js/user/index.js')}}"></script>

@endsection

