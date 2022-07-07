@php
	$title = $doctor->registeredName;
	//echo($doctor->);
@endphp

@extends('templates.basic')

@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
	<link rel="stylesheet" href="{{asset('css/showInfoDoctor.css')}}">
@endsection

@section('content')
	@include('templates.topMenuBar.render', ["user" => $user ?? 0])

	<br>
	<div class="container">

		<div class="row">
			<div class="col-4" class="divprofilePhoto">
				<img src="{{asset('images/doctor.png')}}"  class="profilePhoto" alt="Minha Figura">
			</div>

			<div class="col">
				<div class="row">
					<div class="col-12"  style="background-color: qred">
						<h2 class="colorTextHead"><b>
							@php echo $doctor->registeredName;	@endphp
						</b></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-12" style="background-color: qblue">
						<span class="colorTextHead"> Residencia: </span> @php echo "$doctor->city/$doctor->state" @endphp
					</div>
				</div>
				<div class="row">
					<div class="col-12" style="background-color: qblue">
						<span class="colorTextHead"> CRM: </span> @php echo $doctor->numberCrm @endphp
					</div>
				</div>
			</div>
		</div>
		
		<br>

		<div class="row">
			<div class="col-12">
				<h4 class="colorTextHead"><b>Sobre:</b></h4>
				
				@php
					echo $doctor->description;	
				@endphp
			</div>
		</div>

		<br>

		<div class="row">
			<div class="col-12">
				<h4 class="colorTextHead"><b>Especialidades:</b></h4>
				<br>
				<ul class="list-group list-group-flush">
					<li class="list-group-item">@php
							if($doctor->nameSpecialty1)
								echo "$doctor->nameSpecialty1";	
						@endphp
					</li>
					<li class="list-group-item">
						@php
							if($doctor->nameSpecialty2)
								echo "$doctor->nameSpecialty2";	
						@endphp
					</li>
					<li class="list-group-item">
						@php
							if($doctor->nameSpecialty3)
								echo "$doctor->nameSpecialty3";	
						@endphp
					</li>
				</ul>
			</div>
		</div>
		
		<br>

		<div class="row">
			<div class="col-12">
				<h4  class="colorTextHead"><b>Formas de pagamento:</b></h4>
				
				@php
					echo $doctor->modePayment;
				@endphp	
			</div>
		</div>

	</div>
	<br>

	<!--$doctor->id
	$doctor->user_id
	$doctor->registeredName
	$doctor->numberCrm
	$doctor->nameSpecialty1
	$doctor->numberRqe1
	$doctor->nameSpecialty2
	$doctor->numberRqe2
	$doctor->nameSpecialty3
	$doctor->numberRqe3
	$doctor->description
	$doctor->modePayment-->	
@endsection