@php
	$title = 'Fichas disponiveis';
@endphp

@extends('templates.basic')

@section('loadingCss')
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400&family=Press+Start+2P&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('css/doctor/loadAppointments/docLoaApp.css')}}">
	<link rel="stylesheet" href="{{asset('css/themeForDoctors.css')}}">
	

@endsection

@section('content')

	@include('templates.topMenuBar.forDoctors.layout')
	@include('templates.topMenuBar.forDoctors.rightOption')

	{!! $medForms['data'][0]->id !!}

	<div class="container-fluid" id="medform-data-table">

		<br>
		<!--@if(e(session('mensagem')))
			<div class="alert alert-primary" role="alert">
				{{session('mensagem')}}
			</div>
		@endif-->

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

		@foreach ($medForms['data'] as $medForm)
		<div class="row infoMedForm noDisplay">
			<div class="col-10">
					<div class="row">
						<div class="col complaint-preview">
							{{ $medForm->complaint }}
						</div>
					</div>

					<div class="row">
						<div class="col date-preview">
							{{ $medForm->name }} - {{ $medForm->city }}/{{ $medForm->state }}
						</div>
					</div>

					<div class="row">
						<div class="col medform-situation ">
							Status: <span class="status">{{ $medForm->status }}</span>
						</div>
					</div>					
			</div>

			<div class="col-2 centered generalThemeColorUsers">
				<a href="{!/!route('medform.show',['user' => $user->id, 'medform' => $medForm->id])!!}" class="medform-info-link">
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
	
	</div>

	<script src="{{asset('js/doctor/loadAppointments/docLoaApp.js')}}"> </script>

@endsection