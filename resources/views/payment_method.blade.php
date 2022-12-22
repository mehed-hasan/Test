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
      
      .nice-select.open .list {
             width: 100% !important;
      }

   </style>
   <!-- /.row -->
   <div class="mlm section">
<br>
       <h2>Create your payment method  !!</h2>
       <br>
       @if (session()->has('message'))
       <p class="alert alert-success"> {{session('message')}}</p>
    @endif
       <div class="forms">
           <div class="row">
               <div class="col-xs-12">
                <form action="/create_payment" id="contactForm" method="post">
                    <!-- Name Input -->
                    @csrf
                    <div class="">
                        <strong><h4>Secect Method </h4></strong>
                        <select  class="form-control" name="method" id="">
                            @foreach ($datas as $data )
                            <option required value="{{$data->methods_name}}">{{$data->methods_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <br>
                    <div class="">
                      <strong><h4>Account No  </h4></strong>
                      <input max="12" required name="no" class="form-control"  type="text" placeholder="Ac no " data-sb-validations="required" />
                    </div>

                    <!-- Submit button -->
                    <div class="d-grid">
                        <br>
                      <button class="btn btn-warning btn-sm " id="submitButton" type="submit">Save</button>
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

@section('scripts')
    <!-- JavaScript Bundle with Popper -->
@endsection