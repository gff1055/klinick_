
@php
	$title = 'Minhas fichas de atendimento';
@endphp

@extends('templates.basic')


@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
	<link rel="stylesheet" href="{{asset('css/medForm/index.css')}}">
@endsection

@section('content')

	@include('templates.topMenuBar.render', ["userIsADoctor" => $user->isADoctor])
	

	<div class="container-fluid" id="medform-data-table">
		<br>

		@if(e(session('mensagem')))
			<div class="alert alert-primary" role="alert">
				{{session('mensagem')}}
			</div>
		@endif

		@if($dataAllMedForm == [])
		<div class="row infoMedForm">
			<div class="col-4"></div>
			<div class="col-4">Nenhuma ficha foi criada</div>
			<div class="col-4"></div>
		</div>
			
		@else

		<div class="row">
			<div class="col previousBtnCol">
				<button type="button" class="">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
					</svg>
				</button>
			</div>

			<div class="col indexInfo">
				<span id="beginPage">1</span>&nbsp;-&nbsp;<span id="endPage">100</span>&nbsp;de&nbsp;<span id="allPages">365</span>				
			</div>

			<div class="col nextBtnCol">
				<button type="button" class="">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
					  </svg>
				</button>
			</div>
		</div>
		
		<br>

		
		@foreach($dataAllMedForm as $medForm)
		<div class="row infoMedForm noDisplay">
			<div class="col-2">
				<div class="div-image-medform">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-card-text image-medform" viewBox="0 0 16 16">
						<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
						<path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
					</svg>
				</div>
			</div>
			
			<div class="col-8">
				<!--<div class="container">-->
					<div class="row">
						<div class="col complaint-preview">
							{{ $medForm->complaint }}
						</div>
					</div>

					<div class="row">
						<div class="col date-preview">
							{{ $medForm->city }}
						</div>
					</div>

					<div class="row">
						<div class="col medform-situation ">
							Status: <span class="status">{{ $medForm->descStatus }}</span>
						</div>
					</div>					
			</div>

			<div class="col-2 centered generalThemeColorUsers">
				<a href="{!!route('medform.show',['user' => $user->id, 'medform' => $medForm->id])!!}" class="medform-info-link">
					<!--<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-right-square-fill medform-info-icon" viewBox="0 0 16 16">
						<path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1z"/>
					 </svg>-->
					 <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-chevron-right medform-info-icon" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
					 </svg>
				</a>
			</div>
			&nbsp;
		</div>
			
		@endforeach


		<div class="row">
			<div class="col previousBtnCol">
				<button type="button" class="">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/>
					</svg>
				</button>
			</div>

			<div class="col">
				
			</div>

			<div class="col nextBtnCol">
				<button type="button" class="">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
					  </svg>
				</button>
			</div>
		</div>
		@endif
	
	</div>

	<script>
		var dataAllMedForm = @json($dataAllMedForm);
	</script>
	<script src="{{asset('js/medForm/index.js')}}"> </script>
	   


@endsection
