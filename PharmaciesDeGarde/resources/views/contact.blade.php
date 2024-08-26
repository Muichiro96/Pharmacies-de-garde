@extends('shared.layout')
@section('title')
Contactez-nous
@endsection
@section('imports')
@parent
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

<style>


    .contact_us * {
       
  font-family: "Ubuntu", sans-serif;
  font-weight: 500;
  font-style: italic;

}

.contact_us a {
  text-decoration-line: none;
  text-decoration-thickness: initial;
  text-decoration-style: initial;
  text-decoration-color: initial;
  font-family: "Ubuntu", sans-serif;
  font-weight: 500;
  font-style: italic;
}

.contact_us .text-blk {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  line-height: 25px;
  padding-top: 0px;
  padding-right: 0px;
  padding-bottom: 0px;
  font-family: "Ubuntu", sans-serif;
  font-weight: 500;
  font-style: italic;
  padding-left: 0px;
}

.contact_us input:focus {
  outline-color: initial;
  outline-style: none;
  outline-width: initial;
}

.contact_us textarea:focus {
  outline-color: initial;
  outline-style: none;
  outline-width: initial;
}

.contact_us .responsive-cell-block {
  min-height: 75px;
}

.contact_us .responsive-container-block {
  min-height: 75px;
  height: fit-content;
  width: 100%;
  padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
  display: flex;
  flex-wrap: wrap;
  margin-top: 0px;
  margin-right: auto;
  margin-bottom: 0px;
  margin-left: auto;
  justify-content: flex-start;
}

.contact_us .responsive-container-block.bigContainer {
  padding-top: 10px;
  padding-right: 30px;
  padding-bottom: 10px;
  padding-left: 30px;
}

.contact_us .responsive-container-block.Container {
  max-width: 1320px;
  margin-top: 50px;
  margin-right: auto;
  margin-bottom: 50px;
  margin-left: auto;
}

.contact_us .mainImg {
  width: 600px;
  object-fit: cover;
  height: 100%;
}

.contact_us .responsive-cell-block.wk-desk-7.wk-ipadp-8.wk-tab-12.wk-mobile-12 {
  background-color: #333333;
  padding-top: 30px;
  padding-right: 50px;
  padding-bottom: 30px;
  padding-left: 50px;
}

.contact_us .text-blk.heading {
  color: white;
  font-size: 35px;
  line-height: 48px;
  font-weight: 800;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 30px;
  margin-left: 0px;
}

.contact_us #message {
  width: 100%;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
}

.contact_us .emailArea {
  width: 49%;
}

.contact_us .firstRow {
  display: flex;
  flex-direction: row;
  align-items: flex-start;
  justify-content: space-between;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 30px;
  margin-left: 0px;
  width: 100%;
}

.contact_us .fullNameArea {
  width: 49%;
}

.contact_us .cardHead {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 10px;
  margin-left: 0px;
  color: white;
}

.contact_us .submit {
  color: white;
  padding-top: 20px;
  padding-bottom: 20px;
  width: 100%;
  text-align: center;
  border-top-left-radius: 10px;
  border-top-right-radius: 10px;
  border-bottom-right-radius: 10px;
  border-bottom-left-radius: 10px;
}

.contact_us .formTable {
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 0px;
  margin-left: 0px;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
}

.contact_us .messageArea {
  width: 100%;
  margin-top: 0px;
  margin-right: 0px;
  margin-bottom: 30px;
  margin-left: 0px;
}

.contact_us .fullName {
  width: 100%;
  padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
}

.contact_us .email {
  width: 100%;
  padding-top: 10px;
  padding-right: 10px;
  padding-bottom: 10px;
  padding-left: 10px;
}

@media (max-width: 1024px) {
  .contact_us .firstRow {
    flex-direction: column;
  }

  .contact_us .fullNameArea {
    width: 100%;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 30px;
    margin-left: 0px;
  }

  .contact_us .emailArea {
    width: 100%;
  }
}

@media (max-width: 500px) {
  .contact_us .responsive-container-block.bigContainer {
    padding-top: 10px;
    padding-right: 20px;
    padding-bottom: 10px;
    padding-left: 20px;
  }

  .contact_us .responsive-container-block.Container {
    padding-top: 0px;
    padding-right: 0px;
    padding-bottom: 0px;
    padding-left: 0px;
  }

  .contact_us .responsive-cell-block.wk-desk-7.wk-ipadp-8.wk-tab-12.wk-mobile-12 {
    padding-top: 10px;
    padding-right: 10px;
    padding-bottom: 10px;
    padding-left: 10px;
  }
}
</style>
@endsection
@section('content')
@if($errors->any())
<div class="alert alert-warning alert-dismissible mt-4 ml-4 mr-4">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

<ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
        @endforeach
</ul>
</div> 

@endif

@if(session()->has('success'))

<div class="alert alert-success alert-dismissible mt-4 ml-4 mr-4">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-check"></i>Succés </h4>
{{ session()->get('success') }}
</div>@endif
<div class="contact_us ml-4">
    <div class="responsive-container-block bigContainer">
      <div class="responsive-container-block Container">
        <div class="responsive-cell-block wk-desk-5 wk-ipadp-4 wk-tab-12 wk-mobile-12">
            <img class="mainImg" width="400px" src="/contact.jpg">

        </div>
        <div class="responsive-cell-block wk-desk-7 wk-ipadp-8 wk-tab-12 wk-mobile-12">
          <p class="text-blk heading">
            Contactez-nous
          </p>
          <form class="formTable" id="izml" method="POST" action="">
            @csrf
            <div class="firstRow">
              <div class="fullNameArea">
                <p class="cardHead">
                  Nom
                </p>
                <input class="fullName" id="fullName" name="name" type="text">
              </div>
              <div class="emailArea">
                <p class="cardHead">
                  Email
                </p>
                <input class="email" id="email" name="email" type="text">
              </div>
            </div>
            <div class="messageArea">
              <p class="cardHead">
                Message
              </p>
              <textarea class="message" cols="30" id="message" name="message" rows="10"></textarea>
            </div>
            <button class="btn btn-primary submit" type="submit" >
              Send Message
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  @endsection