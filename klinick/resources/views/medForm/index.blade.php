
@php
	$title = 'Home';
@endphp

@extends('templates.basic')


@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
	<link rel="stylesheet" href="{{asset('css/medForm/index.css')}}">
@endsection

@section('content')

	@include('templates.topMenuBar.render', ["userIsADoctor" => $user->isADoctor])
	<div class="main-page-title">
		Minhas fichas de atendimento
	</div>

	<div class="container-fluid" id="medform-data-table">
		<br>

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
			<div class="col-10">
				<!--<div class="container">-->
					<div class="row">
						<div class="col complaint-preview">
							{{ $medForm->complaint }}
						</div>
					</div>

					<div class="row">
						<div class="col date-preview">
						Montes Claros/MG...
						</div>
					</div>

					<div class="row">
						<div class="col medform-situation ">
							Status: <span class="waiting">Á Espera de médico</span>
						</div>
					</div>					
				<!--</div>-->
			</div>

			<div class="col-2 centered generalThemeColorUsers">
				<a href="#" class="medform-info-link">
					<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-arrow-right-square-fill medform-info-icon" viewBox="0 0 16 16">
						<path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2v12zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1z"/>
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
	
	</div>

	<script>
		var dataAllMedForm = @json($dataAllMedForm);;
		console.log(dataAllMedForm.length);
	</script>
	<script src="{{asset('js/medForm/index.js')}}"> </script>
	   


@endsection
