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

<style>
    .tree,
    .tree ul,
    .tree li {
        list-style: none;
        margin: 0;
        padding: 0;
        position: relative;
    }
    
    .tree {
        margin: 0 0 1em;
        text-align: center;
    }
    
    .tree,
    .tree ul {
        display: table;
    }
    
    .tree ul {
        width: 100%;
    }
    
    .tree li {
        display: table-cell;
        padding: .5em 0;
        vertical-align: top;
    }
    
    .tree li:before {
        outline: solid 1px #666;
        content: "";
        left: 0;
        position: absolute;
        right: 0;
        top: 0;
    }
    
    .tree li:first-child:before {
        left: 50%;
    }
    
    .tree li:last-child:before {
        right: 50%;
    }
    
    .tree code,
    .tree span {
        border: solid .1em #666;
        border-radius: .2em;
        display: inline-block;
        margin: 0 .2em .5em;
        padding: .2em .5em;
        position: relative;
    }
    @media screen and (min-width: 576px){
        .tree code, .tree span {
        /* padding: .2em 2.5em; */
    
    }
    }
    
    .tree ul:before,
    .tree code:before,
    .tree span:before {
        outline: solid 1px #666;
        content: "";
        height: .5em;
        left: 50%;
        position: absolute;
    }
    
    .tree ul:before {
        top: -.5em;
    }
    
    .tree code:before,
    .tree span:before {
        top: -.55em;
    }
    
    .tree>li {
        margin-top: 0;
    }
    
    .tree>li:before,
    .tree>li:after,
    .tree>li>code:before,
    .tree>li>span:before {
        outline: none;
    }
    
    .img_avater_ronju{
    width:50px;
    }
    </style>
   <!-- /.row -->
   <!-- Related Projects Row -->
   <h2 class="my-4">Welcome {{Auth::user()->name}} !  <a class="btn btn-warning" href="/">Go to shop</a></h2> 



   <div class="stats section">
      <div class="row">
         <div class="col-md-3 col-sm-6 mb-4 ">
            <div class="boxes text-center">
               <h3>Total Points</h3>
               <h4>{{Auth::user()->point}}</h4>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 mb-4 ">
            <div class="boxes text-center">
               <h3>Total Ordered</h3>
               <h4>{{$torder}}</h4>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 mb-4 ">
            <div class="boxes text-center">
               <h3>Active Orders</h3>
               <h4>{{$activeOrder}}</h4>
            </div>
         </div>
         <div class="col-md-3 col-sm-6 mb-4 ">
            <div class="boxes text-center">
               <h3>Reffered</h3>
               <h4>{{Auth::user()->reffered}}</h4>
            </div>
         </div>
      </div>
   </div>



   <div class="stats section">
    <div class="row">
       <div class="col-md-3 col-sm-6 mb-4 ">
          <div class="boxes text-center">
             <h3>Shopping Balance</h3>
             <h4>{{Auth::user()->shopable}}</h4>
          </div>
       </div>
       <div class="col-md-3 col-sm-6 mb-4 ">
          <div class="boxes text-center">
             <h3>Withdraw Able</h3>
             <h4>{{Auth::user()->withdrawable}}</h4>
          </div>
       </div>
       <div class="col-md-3 col-sm-6 mb-4 ">
          <div class="boxes text-center">
             <h3>Free hands</h3>
             <h4>{{ 3 - Auth::user()->hand}}</h4>
          </div>
       </div>
       <div class="col-md-3 col-sm-6 mb-4 ">
          <div class="boxes text-center">
             <h3>Ac Balance</h3>
             <h4>{{Auth::user()->balance}}</h4>
          </div>
       </div>
    </div>
 </div>
   <hr>
   <div class="mlm section">
<br>

<div class="order_status">
    <h2>Order status</h2>
    <table>
        <thead>
            <tr>
                <th>Order Id </th>
                <th>Ordered Date </th>
                <th>Status </th>
            </tr>
        </thead>

        <tbody>

            @foreach ($orderStatus as $status )
            <tr>
                <td>#{{$status->invoice_no}}</td>
                <td>{{$status->created_at}}</td>
                @if ($status->is_reviewed == 0)
                <td><span class="badge badge-info">Pending </span></td>
                @endif
                @if ($status->is_reviewed == 3)
                <td><span class="badge badge-info">Processing </span></td>
                @endif

                @if ($status->is_reviewed == 1 or $status->is_reviewed == 2 )
                <td><span class="badge badge-info"> Completed </span></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<br>
       <h2>Earn more and enjoy !!</h2>
       @if ($userdata->payment_method == '')
       <p class="alert alert-warning"> <strong> To Do :</strong> Your payment method is not completed !! <a href="/payment_method">Create a pyment method </a></p>
       @else
       <p class="alert alert-info"> Your payment method updated!! <a href="/payment_method"><strong>Edit Now </strong></a></p>

       @endif

       @if (Auth::user()->name == '')
       <p class="alert alert-warning"><strong> To Do :</strong> Please add our name and address. Go to Edit Infos >> set your name and address</p>
       @endif

       

       @if(Auth::user()->lvl >=5)
        <p class="alert alert-success">Congrats ! you completed all levels. <a href="/start_again/{{Auth::user()->id}}" class="btn btn-success btn-xs">Click to start again !</a></p>
    
       @endif

       @if (count($errors) > 0)
       <ul class="alert alert-danger">
           @foreach ($errors->all() as $error)
               <li >{{ $error }}</li>
           @endforeach
       </ul>
    @endif
    
    
       @if (session()->has('message'))
            <p class="alert alert-success"> {{session('message')}}</p>
        @endif
    
        @if (session()->has('error_message'))
        <p class="alert alert-danger"> {{session('error_message')}}</p>
        @endif
       <br>

      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
      </div>


      <div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Buy Package</a></li>

          @if (Auth::user()->type !== '')
                 {{-- Display those tabs when taken a package else tab will be unvisible  --}}
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Withdrawable 
                    <span class="badge badge-primary">{{Auth::user()->withdrawable > 100 ? '1' : '0'}}</span>
                </a>
               </li>
          @endif

          @if (Auth::user()->type !== '')
              <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Tree View</a></li>
          @endif
          <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Recharge</a></li>

          @if (Auth::user()->type !== '')
          <li role="presentation"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">My Info</a></li>
          @endif

          @if (Auth::user()->type !== '')
            <li role="presentation"><a href="#followers" aria-controls="followers" role="tab" data-toggle="tab">My followers <span class="badge bage-info">{{$queues->count()}}</span></a></li>
          @endif
          <li role="presentation"><a href="#edit" aria-controls="edit" role="tab" data-toggle="tab">Edit Infos </a></li>

        </ul>
      <br><br>
        <!-- Tab panes -->
        <div style="min-height: 350px;" class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">
            <div class="forms">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        @if (Auth::user()->name == '')
                        <h3 class="text text-center">Please fill your user name first. Go to Edit infos >> and update informations</h3>
                        @else
                        <form action="/buy_package" method="POST">
                            @csrf
                            <!-- Name Input -->
   
                            <div class="form-floating mb-3">
                                <strong><h4>Refference number </h4></strong>
                              <input name="who_refered" class="form-control" id="name" type="text" placeholder="Refference number" data-sb-validations="required" />
                            </div>
                            <br>
                            <div class="form-floating mb-3">
   
                                <input type="radio" value="basic" name="package" id=""> <span style="color: white; margin-right:15px;"> Basic (for 500 Tk) </span>
                                <input type="radio" value="premium" name="package" id=""> <span style="color: white;"> Premium (for 2500 Tk)</span>
                            </div>
        
                            <!-- Submit button -->
                            <div class="d-grid">
                                <br>
                              <input class="btn btn-warning" type="submit" value="Submit">
                            </div>
                          </form>
                        @endif
                       <!-- End of contact form -->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <table>
                            <thead>
                                <tr>
                                    <td>Package From</td>
                                    <td>Package Name </td>
                                </tr>
                            </thead>
     
                            <tbody>
                                <tr>
                                    <td>Sahaba Foods</td>
                                    <td>
                                        @if ($userdata->type=='basic')
                                        <span class="badge badge-primary">Basic</span>
                                        @elseif ($userdata->type=='premium')
                                        <span class="badge badge-primary">Premium</span>
                                        @else
                                        <span class="badge badge-primary">No package</span>
                                        @endif
                                     </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>

          <div role="tabpanel" class="tab-pane" id="profile">
            {{-- Withdrawable data from heree wiill be strated  --}}
            @if (Auth::user()->withdrawable > 100)
                <p class="alert alert-info"> Availabl to withdraw {{Auth::user()->withdrawable}} 
                    @if (Auth::user()->withdraw_applied_on == 'applied')
                        <span class="badge badge-info pull-right"> Wait to get approved</span>
                    @else
                    <a class="btn btn-xs btn-info pull-right" href="/withdraw">Withdraw Now</a>
                    @endif
                </p>
            @else
                <h3 class="text text-center"> Sorry !! Nothing to withdraw !</h3>
            @endif
          </div>


          <div role="tabpanel" class="tab-pane" id="messages"> 
            {{-- My tree view  --}}
            <ul style="margin:auto;" class="tree">
                <li>
                   <span><img src="https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg" class="img_avater_ronju"><br> {{Auth::user()->name}}</span>
                   <ul>
                       @foreach ($treeOnes as $treeOne )

                       <li>
                        <span><img src="https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg" class="img_avater_ronju"><br>  {{$treeOne->name}}</span>
                        <ul>
                            @foreach ($treeAlls as $treeAll )

                                @if ($treeOne->name == $treeAll->who_ref_name)
                                    <li> <span><img src="https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg" class="img_avater_ronju"><br>{{$treeAll->name }}</span>
                                    </li>
                                @endif

                            @endforeach

                        </ul>
                     </li>

                       @endforeach



                   </ul>
                </li>
             </ul>
         </div>



          <div role="tabpanel" class="tab-pane" id="settings">
            <div class="forms">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                        @if (Auth::user()->name == '')
                        <h3 class="text text-center"> Please fill your user name first. Go to Edit infos >> and update informations</h3>
                            @if (Auth::user()->payment_method == '')
                            <h3 class="text-center">Please add a payment method before recharge.</h3>
                            @endif
                        @else
                        <form action="/recharge" method="POST">
                            @csrf
                            <!-- Name Input -->
                            <div class="form-floating mb-3">
                                <strong><h4>User Name</h4></strong>
                              <input readonly maxlength="25" value="{{Auth::user()->name }}"  name="who_refered" class="form-control" id="name" type="text" placeholder="Name" data-sb-validations="required" />
                            </div>
                            <br>
                            <div class="form-floating mb-3">
                               <strong><h4>Tranx Id </h4></strong>
                             <input maxlength="25" name="tranx" class="form-control" id="name" type="text" placeholder="Tranx Id " data-sb-validations="required" />
                           </div>
   
                           <div class="form-floating mb-3">
                               <strong><h4>Tranx Amount </h4></strong>
                             <input max="2500" name="amount" class="form-control" id="name" type="text" placeholder="Amount" data-sb-validations="required" />
                           </div>
                            <!-- Submit button -->
                            <div class="d-grid">
                                <br>
                              <input class="btn btn-warning" type="submit" value="Submit">
                            </div>
                          </form>
                          <!-- End of contact form -->
                        @endif

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    </div>
                </div>
            </div>
          </div>


          <div role="tabpanel" class="tab-pane" id="info">
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col"> User Name </th>
                    <th>{{Auth::user()->name}}</th>
                  </tr>  
                   <tr>
                    <th scope="col">Email</th>
                    <th>{{Auth::user()->email}}</th>
                   </tr>
                   <tr>
                    <th scope="col">Ac balance</th>
                    <th>{{Auth::user()->balance}}</th>
                </tr>
                    <tr>
                        <th scope="col">Lvl</th>
                        <th><strong>{{Auth::user()->lvl}}</strong></th>
                    </tr>
                    <tr>
                        <th scope="col">Point</th>
                        <th>{{Auth::user()->point}}</th>
                    </tr>
                    <tr>
                        <th scope="col">Total reffered</th>
                        <th>{{Auth::user()->reffered}}</th>
                    </tr>

                    <tr>
                        <th scope="col">Free hands</th>
                        <th> {{3 - Auth::user()->hand}} of 3</th>
                    </tr>

                    <tr>
                        <th scope="col">My ref id</th>
                        <th>{{Auth::user()->ref_id}}</th>
                    </tr>
                    <tr>
                        <th scope="col">My refferer</th>
                        <th>{{Auth::user()->who_ref_name}}</th>
                    </tr>
                    <tr>
                        <th scope="col">Refferal Bonus</th>
                        <th>{{Auth::user()->ref_bonus}}</th>
                    </tr>
                    <tr>
                        <th scope="col">Level Bonus</th>
                        <th>{{Auth::user()->lvl_bonus}}</th>
                    </tr>
                    <tr>
                        <th scope="col">Level Gen Bonus</th>
                        <th>{{Auth::user()->lgb}}</th>
                    </tr>
                    <tr>
                        <th scope="col">Updating balance</th>
                        <th>{{Auth::user()->updating_bal}}</th>
                    </tr>   
                    <tr>
                        <th scope="col">Dis balance</th>
                        <th>{{Auth::user()->dis_bal}}</th>
                    </tr>
                    <tr>
                        <th scope="col">Shopable Balance</th>
                        <th><strong>{{Auth::user()->shopable}}</strong></th>
                    </tr>
                    <tr>
                        <th scope="col">Withdrawable Balance</th>
                        <th><strong>{{Auth::user()->withdrawable}}</strong></th>
                    </tr>
                  </tr>
                </thead>
                <tbody>

                </tbody>
              </table>
          </div> 


          <div role="tabpanel" class="tab-pane" id="followers">
              @if ($queues->count() > 0)
                  
      
              <p class="alert alert-success">Request was sent by {{$queue->new_comer}} . Just simply reffer to anybody</p>
                <ul style="margin:auto;" class="tree">
                <li>
                   <span> {{Auth::user()->name}}</span>
                   <ul>
                       @foreach ($treeOnes as $treeOne )

                       <li>
                        <a href="/assigned/{{$treeOne->name}}/{{ $queue->new_comer}}/{{$treeOne->id}}"><span>{{$treeOne->name}}</span></a>
                        <ul>
                            @foreach ($treeAlls as $treeAll )

                                @if ($treeOne->name == $treeAll->who_ref_name)
                                    <li> <span><a href="/assigned/{{$treeAll->name}}/{{ $queue->new_comer }}/{{$treeAll->ref_id}}">{{$treeAll->name }}</a></span>
                                        {{-- <ul>
                                            @foreach ($treeAlls as $treeAll )
                                                    <li><span><a href=""></span></a></li>
                                            @endforeach
                                        </ul> --}}
                                    </li>
                                @endif

                            @endforeach

                        </ul>
                     </li>

                       @endforeach



                   </ul>
                </li>
             </ul>
             @else
             <h3 class="text text-center"> Relax, No request !</h3>
             @endif
          </div>




          <div role="tabpanel" class="tab-pane" id="edit">
              <form style="max-width: 450px;" action="/update_infos" method="post">
                @csrf
                  <label for="">User Name </label>
                  @if (Auth::user()->name == '')
                  <small><p class="text text-danger">(You can not edit user name later. Please be aware about spelling) </p></small>
                  @endif
                  <input {{Auth::user()->name == '' ? '' : 'readonly'}} value="{{Auth::user()->name}}" class="form-control" type="text" name="name" id="">
                  <br>
                  <textarea class="form-control" required  name="addr" id="" cols="30" rows="3" placeholder="Update address">{{$addr}}</textarea>
                  <br>
                  <input class="btn btn-warning" type="submit" value="Save">
              </form>
          </div>

        </div>
      </div>
   </div>

</div>
</div>
<!-- /.row -->

@endsection

@section('scripts')
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
@endsection