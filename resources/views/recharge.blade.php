@extends('layout')
@section('main_content')
<!-- Page Content -->
<div class="container">
   <style>
       h4{
           color: white;
       }
      .boxes{
      height: 150px;
      width: 100%;
      background: #ff9702;
      color: white;
      font-weight: bold;
      border-radius: 3px;
      }
      .boxes h3{
      padding: 15px 0px;
      }

      .mlm form{
          background: #ff9702;
          border: 1px solid #ddd;
          padding: 25px;
      }
      .section{
          margin: 20px 0px;
      }
   </style>
   <!-- /.row -->
   <div class="mlm section">
<br>
       <h2>Please insert validate Tranx Id  !!</h2>
       <br>
       @if (session()->has('message'))
       <p class="alert alert-success"> {{session('message')}}</p>
   @endif
       <div class="forms">
           <div class="row">
               <div class="col-xs-12">
                   <p class="alert alert-warning ">Nagad Account : 01611141812</p>
                <form id="contactForm" >
                    <!-- Name Input -->
                    <div class="form-floating mb-3">
                        <strong><h4>Your email </h4></strong>
                      <input class="form-control" id="name" type="text" placeholder="Name" data-sb-validations="required" />
                    </div>

                    <div class="form-floating mb-3">
                        <strong><h4>Transaction Id  </h4></strong>
                      <input class="form-control"  type="text" placeholder="Tranx Id " data-sb-validations="required" />
                    </div>

                    <!-- Submit button -->
                    <div class="d-grid">
                        <br>
                      <button class="btn btn-warning btn-sm " id="submitButton" type="submit">Buy</button>
                    </div>
                  </form>
                  <!-- End of contact form -->
               </div>

           </div>
       </div>
   </div>

</div>
</div>
<!-- /.row -->
</div>
<!-- /.container -->
@endsection