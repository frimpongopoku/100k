@extends('layouts.theme') 

@section('content')

{{-- ================SIDE COUNTER ======================= --}}
  <div class="side-counter z-depth-2"> 
    <h2 id="counter" style="text-shadow: 0px 1px 2px black; color:#a30aa3;"></h2>
  </div>

{{-- /==============================END SIDE COUNTER ========================== --}}
{{-- ================================= MODAL AREA ==================================== --}}
    <div id="modalion" class="unseen">
       
        <div class="s-modal my-card z-depth-1" >
          <button id="close-modalion" onClick = "closeModal()" class="popout btn btn-default z-depth-1 modal-close-btn round-me"> 
            <i class="fa fa-close"></i>
          </button>
          <div id="content">
            <div id="sorry" class="unseen">
              <center> 
                <h1 style="color:#f0625e"><i class="fa fa-exclamation-circle "></i> Sorry, tree already owned! </h1>
                <p class="m-gray">This tree already belongs to <span><i class="fa fa-verified-user"></i> <b> <span id="owned-name">Frimpong Opoku Agyemang</span></b> </span><br/> 
                  please scan another tree.
                </p>
                <img src="{{asset('default-imgs/sad-tree.png')}}"  style="height:100px; opacity:.8" /><br/>
                <img src="{{asset('default-imgs/100k-ico.png')}}"  style="height:100px; opacity:.3" /> 
              </center>
            </div>
            <div id = "complete-scan" class="unseen">
              <center> 
                <h1 class="scan-h1"><i class="fa fa-check-circle text text-success"></i> Scan Complete </h1> 
                  <h3 class="m-gray modal-text"><b>Owner:</b> <span id="user-name"> Frimpong Opoku Aygyemang</span> </h3> 
                  <h3 class="m-gray modal-text"><b>Email:</b> <span id="user-email">Frimpong@yahoo.com</span> </h3> 
                  <div class="tree-info"> 
                    <p style="color:lightgray; margin-bottom:1px !important">Tree Information</p> 
                    <small class="text text-danger" id="tree-info-1">Aseiosps, </small>
                    <small class="text text-danger" id="tree-info-2">Aseiosps</small>
                  </div>
                  <h6>NEXT STEP</h6>
                  <small>Now <b>hug</b> your tree tightly, or <b>squat</b> next to it, and press the button below </small><br/><br/>
                  <button id="hook-btn" onClick ="streamToBackEnd()" class="btn btn-success z-depth-1 round-me" style="padding:15px 30px;"> Hook Me To My Tree </button>
              </center>
            </div>
             <div id="Hurray" class="unseen">
              <center> 
                <h1 class="scan-h1"><i class="fa fa-check-circle text text-success"></i> Congratulations! </h1>
                <p class="m-gray"><b> + 1 new </b> tree planted </p>
                <h4> You have <b>3</b> trees</h4>
                <h2 class="text text-success"> <b><span id="hurray-count">35</span> / 100,000 </b> planted in total </h2><br/>
                {{-- <button class="btn btn-danger round-me z-depth-1" style="padding:13px 60px">Close </button> --}}
                <img src="{{asset('default-imgs/100k-ico.png')}}"  style="height:100px; opacity:.3" />
              </center>
            </div> 
          </div>
        </div>
      <div class="s-modal-overlay"></div>
    </div>
    {{-- =================================== END OF MODAL AREA ========================= --}}
  <div style="" class="vanish" id="main-div" >
    {{-- ============NEW THEME ======================== --}}
    <div class="container" style="margin-left:16%; margin-right:160px;background:white;"> 
      <div class="row"> 
        <div class="col-lg-6 col-md-6 col-md-3"> 
          <h1 class="tagline">Planting Trees And Making History Is More Fun When Everyone Is Involved</h1>
          <p class="under-tagline">Be one of a thousands that pledged to plant a tree on March 7th 2020</p>
        </div>
        <div class="col-lg-6 col-md-6"> 
          <img class="first-tree" src="{{asset('default-imgs/1.svg')}}" />
        </div>
      </div>
   

    
    {{-- ---------------SPONSORSHIP PHOTOS -------------------------- --}}
    <div class="sponsorship phone-vanish" id="sponsor-anchor">
      
      <div class="row">
          {{-- <div class="col-md-4 invisible">
            <h3 style="margin-top:60px; color:#8d969e;">ANOTHER COMPANY </h3>
          </div> --}}
          <div class="col-md-12">
            <center>
              <img src={{asset('default-imgs/dentons.png')}} class="dentons-logo "/>
              <img src={{asset('default-imgs/sov.jpg')}} class="sov "/>
              <img src={{asset('default-imgs/panda.png')}} class="other-sponsors "/>
              <img src={{asset('default-imgs/not-a-number.webp')}} class="other-sponsors "/>
            </center>
          </div>
          {{-- about us anchor --}}
          <div id="about-anchor"></div>
          {{-- ----------------- --}}
          {{-- <div class="col-md-4 invisible">
            <h3 style="margin-top:60px; color:#8d969e;">ANOTHER COMPANY </h3>
          </div> --}}
        </div>
        
    </div>

    
    <div class="row"> 
      <div class="col-lg-4 col-md-4"> 
        <img style="height:300px; margin:30px; margin-left:10px;" src="{{asset('default-imgs/2.svg')}}" />
      </div>
      <div class="col-lg-8 col-md-8"> 
        <h3 class="col-title">The making of history </h3>
          <p class="under-tagline col-pc-margin" >The 100K Legacy Challenge is a moonshot sustainability challenge created to foster synergy between the Mauritian Government, the private sector, the general public and the expat community</p>
      </div>
      <div class="col-lg-8 col-md-8"> 
        <h3 class="col-title">Forest Landscape Restoration initiative (FLR) inspired</h3>
          <p class="under-tagline col-pc-margin" >FLR has proven to be the quickest, easiest and cheapest way to mitigate multiple climatic objectives including those aligned with reducing emissions from deforestation, facilitating sustainable rural development and unlocking climate-smart private sector investments</p>
      </div>
      <div class="col-lg-4 col-md-4"> 
        <img style="height:300px; margin:30px; margin-left:10px;" src="{{asset('default-imgs/3.svg')}}" />
      </div>
      <div class="col-lg-4 col-md-4"> 
        <img style="height:300px; margin:30px; margin-left:10px;" src="{{asset('default-imgs/4.svg')}}" />
      </div>
      <div class="col-lg-8 col-md-8"> 
        <h3 class="col-title">Promote and inspire a “green-conscious” culture</h3>
          <p class="under-tagline col-pc-margin" >Qualify Mauritius to officially participate in the AFR100 (African Forest Landscape Restoration) Initiative and the Bonn Challenge</p>
      </div>
      <div class="last-para">
     
          <p class="under-tagline col-pc-margin">Making this commitment will not only contribute to achieving ecological restoration on the island, it will also signal exemplary leadership on regaining ecological integrity.</p>

     </div>
    </div>
  

  </div>
  {{-- END OF NEW THEME --}}


    {{-- -------------------------------------------------------------------------------------------------- --}}
    {{-- -------------------------------------------- SCANNER AREA -------------------------------------------}}
    <div class="banner-area phone-width" >
      <div class="banner">
        <h1 class="banner-text">SCAN YOUR TREE HERE </h1>
      </div>
      <div class="scanner-container phone-scanner-cont-height">
        <div class="col-md-6 col-lg-6 offset-md-3" style="padding-top:30px;">
        
            <div class="">
              {{-- <video id="code-preview"></video>  --}}
              <center>
                 
                @guest
                   <div class="my-card phone-scanner-height z-depth-1 popout">
                    <img src="{{asset('default-imgs/Qr-3.png')}}" class="dummy-code"/><br/>
                    <a class="phone-vanish btn btn-danger  my-depth-1  round-me" href="/login/google"><i style="font-size:40px; padding:2px 0px" class="fa fa-google"></i></a>
                    <a  class="my-depth-1 phone-vanish btn btn-default round-me subscribe-button  " href="/login"><img src ="{{asset('default-imgs/100k-footer.png')}}" style="height:43px; padding:5px 0px; border-radius:100%; " /></a>
                   <small style="display: block;margin-top:10px;">Login with <b>Google</b> or your <b>100k</b> account to scan </small>
                    
                    <small class="pc-vanish">Login With </small></br>
                    <a class="pc-vanish btn btn-danger round-me " href="/login/google"><i class="fa fa-google"></i></a>
                    <a style="" class="pc-vanish btn btn-default subscribe-button round-me" href="/login">100K</a>
                  </div>
                  @else  
                    <div class="video-curtain"></div>
                    <div class="my-card phone-scanner-height z-depth-1" style="background:black">
                      <div class="guiding-box"></div>
                      <video id="qr-video" class="video"></video>
                      <button id="start-capture" style="font-weight:800;" class="btn btn-success z-depth-1 btn-finish round-me" style="" >Scan </button>
                      <button id="m-close-scanner" class="btn btn-default round-me z-depth-1 popout" style="display:none; margin-top:-80px; z-index:15;background:white;"><i class="fa fa-close"></i></button>
                    </div>
                @endguest
                
              </center>
              <div id="map-anchor"></div>
            </div>
        </div>
       
      </div> 
    </div>
    {{--  ----------MAPS AREA --------------- --}}
    
    <div class="maps-area phone-width" style="background:white;height:850px;"> 
      <div class="banner">
        <h1 class="banner-text">FIND YOUR TREES ON THE MAP </h1>
      </div>
    
      <center>
        <div class="key">
          <img src="{{asset('default-imgs/red-tree.png')}}" ><small> Your Trees </small>
          <img src="{{asset('default-imgs/tree-ico.png')}}" ><small> Other Trees </small>
        </div>
        <div id="map" class="z-depth-1" style="border-radius:10px;height:500px; width:80%;margin:40px"></div>
      </center>
     
    </div>

    {{-- ------FOOTER AREA -------- --}}
    {{-- <div class="pc-vanish phone-footer phone-width" style="padding-top:20px;">
      <center> 
        <small style="color:#887d9f;font-size:115%">Receive weekly updates from us!</small>
        <form method="GET" action="{{route('subscribe')}}">
          <input required type="email"class="round-me"  style="margin:10px; width:81%;display:inline-block; padding:13px; 30px; text-align:center;"   placeholder="email" name="email" class="form-control" /> 
          <input type="submit" class="btn btn-default btn-finish subscribe-button round-me" value="Subscribe"><br/>
        </form>
        <div class="col-lg-6" style="margin-top:23px">
          <button class="btn btn-default round-me m-social" style="background:blue; color:white;"><i class="fa fa-facebook"></i></button>
          <button class="btn btn-default round-me m-social" style="background:white"><i class="fa fa-instagram"></i></button>
          <button class="btn btn-default round-me m-social" style="background:#00a1ff; color:white;"><i class="fa fa-twitter"></i></button>
          <p style="margin-top:5px; color:lightgray">Follow Us On Social Media </p>
        </div>
        
      </center>
    </div> --}}
    <div class="" style="background:white;margin-top:120px;"> 
      <center> 
        <img style="height:130px; margin:30px;margin-top:-40px;" class="foot-tree-fix" src="{{asset('default-imgs/100k-footer.png')}}"/>
        <div style="display:inline-block"> 
          <a href="/login" class="nav-anchors">Sign In</a> <br/>
            <a href="/register" class="nav-anchors">Create Account</a><br/>
            <a href="https://www.facebook.com/100klegacychallenge/?modal=admin_todo_tour" class="nav-anchors">Contact Us</a>
        </div>
        <div style="display:inline-block " class="foot-phone-fix"> 
          <a target="_blank" href="https://www.facebook.com/100klegacychallenge/?modal=admin_todo_tour" class="nav-anchors">Facebook</a> <br/>
            <a target="_blank" href="https://twitter.com/100KChallenge1" class="nav-anchors">Twitter</a><br/>
            <a target="_blank" href="https://www.linkedin.com/company/100k-challenge/about/?viewAsMember=true" class="nav-anchors">Linked In</a>
        </div>
      </center>

      </div>
    </div>
    
  </div>

@endsection


  @section('custom-js')
    <script>
      var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 5.625505899999999, lng:-0.2945928},
          zoom: 10
        });
        window.map = map;
      }
     
      
    </script>
  

@endsection