@php
	$title = 'Consentimento legal';
@endphp



@extends('templates.basic')

@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
@endsection


@section('content')
	@include('templates.topMenuBar')

<div class="formRegisterTitleLine"><br></div>	

<div class="container">
	<div class="row">
		<div class="col-12 atrForm">
<br>

<form>

<h4><b>Consentimento legal</b></h4>
<p>
	Clicanco no checkbox estou ciente do acesso e processamento tendo em vista a elegibilidade ou nao do usuariio Klinick.
	Solicitamos informações pessoais apenas quando realmente precisamos delas para lhe fornecer um serviço.
	Fazemo-lo por meios justos e legais, com o seu conhecimento e consentimento. Também informamos por que
	estamos coletando e como será usado. Armazenamos os dados, e os protegemos dentro de meios comercialmente aceitáveis ​​para evitar perdas e
	roubos, bem como acesso, divulgação, cópia, uso ou modificação não autorizados.Não compartilhamos
	informações de identificação pessoal publicamente ou com terceiros, exceto quando exigido por lei.
</p>


	<input type="checkbox" id="checkBoxAgreement" name="scales">
	 <label for="scales"> Eu estou ciente e aceito </label>
	 <br>
	 <div class="divBtEnviar">
	 <button type="button" id="btnContinueAgreement" class="btn btn-light"> Continuar</button>
	 </div>
</form>



	
</div>
</div>
</div>
<div class="formRegisterTitleLine"><br></div>	
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
	<script src="{{asset('js/formAgreement.js')}}"></script>
	<script src="{{asset('js/menuBarAlreadyDoctor.js')}}"></script>

@endsection