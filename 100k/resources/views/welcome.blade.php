@extends('layouts.welcome-nav') 

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
  <div style="padding-top:60px;" class="vanish" id="main-div">
    <div class="m-header"style=""> 
      <div class="row">
        <div class="col-md-6 col-lg-6" style="padding:0px"> 
          <div class="brand-div vanish" style="padding-top:16%;position:relative; left:-120px"> 
            <center>
              <h1 class="hero-title" >100k<span style="color:orange">Challenge</span></h1>
              <a class="plant-btn btn btn-default round-me z-depth-1" href="#scanner">Plant A Tree </a><br/>
              <img src = "{{asset('default-imgs/100k-footer.png')}}" style="height:100px; width:100px; margin-top:30px;" />
            </center>
          </div>
        </div>
        <div class="col-md-6 col-lg-6" > 
          <div class="tree-group vanish tree-phone-margin"  > 
            <img src = "{{asset('default-imgs/f-2.jpg')}}"class = "phone-vanish" style="height:57vh; width:109%;margin-left:-15px;object-fit:cover;"/>
            {{-- <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-1" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-6 phone-vanish" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-2" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-3 phone-vanish" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-4" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-5" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-7" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-8" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-9" /> --}}
          </div>
          
        </div>
      </div>
    {{-- <div class="m-header"> 
      <div class="row">
        <div class="col-md-6 col-lg-6" style="padding:0px"> 
          <div class="brand-div vanish" style="padding-top:16%;position:relative; left:-120px"> 
            <center>
              <h1 class="hero-title" >100k<span style="color:orange">Challenge</span></h1>
              <a class="plant-btn btn btn-default round-me z-depth-1" href="#scanner">Plant A Tree </a><br/>
              <img src = "{{asset('default-imgs/100k-footer.png')}}" style="height:100px; width:100px; margin-top:30px;" />
            </center>
          </div>
        </div>
        <div class="col-md-6 col-lg-6" style="padding:0px"> 
          <div class="tree-group vanish tree-phone-margin"> 
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-1" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-6 phone-vanish" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-2" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-3 phone-vanish" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-4" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-5" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-7" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-8" />
            <img src="{{asset('default-imgs/Tree-comp.png')}}"  class="tree tree-9" />
          </div>
          
        </div>
      </div> --}}
    </div>
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
    <div class="about phone-about-fix" > 
      <h1 style="text-align: center; color:#929090; margin-top:20px;">About 100kChallenge</h1>
      <p class="about-text"> The 100K Legacy Challenge is a moonshot sustainability challenge created to foster synergy between the Mauritian Government, the Private sector and the General public, for a common goal of giving back to the environment. The aim of the challenge is to raise awareness on environmental sustainability by planting and ensuring the survival of at least 100,000 indigenous tree species across Mauritius, over a period of 10 years from 2020.

        <br/><br/>
        The challenge is a creation by students from the  <a href="https://www.alueducation.com/">African Leadership University (ALU)</a> and is inspired by the Forest Landscape Restoration initiative (FLR) that has been taken up on a global scale. FLR has proven to be the quickest, easiest and cheapest way to mitigating climate change and integrating multiple climatic objectives including those aligned with reducing emissions from deforestation, facilitating sustainable rural development and unlocking climate-smart private sector investments.
        <br/><br/>
        The team has developed innovative software that allows automatic mapping of the planting process for easier tracking and maintenance (weeding, watering, etc) of the planted trees. Every tree planted will be geo-tagged and spontaneously assigned an identity, and a guardian (the planter). The objective of the guardianship is to encourage care commitment and to ensure a higher survival rate of the tree species.
        <br/>
        Pursuant to goal 17 of the United Nations’ Sustainable Development Goals; to strengthen the means of implementation and revitalize the global partnership for sustainable development, the team is partnering with Corporations, Non-Governmental Organizations, local youth groups, the general public and various departments of the Mauritian Government, to achieve the project‘s vision.
    
      </p>
      
    </div>
    {{--  SCANNER AREA--}}
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
                   <br/> <br/><small>Login with <b>Google</b> or your <b>100k</b> account to scan </small>
                    
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
    
    <div class="maps-area phone-width" style="background:lightgray;height:850px;"> 
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
    <div class="pc-vanish phone-footer phone-width" style="padding-top:20px;">
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
    </div>
    <div class="footer phone-vanish"> 
      <div class="row"> 
          <div class="col-md-6 col-lg-6 " style="display:inherit"> 
            <img style="height:130px; margin:30px" src="{{asset('default-imgs/100k-footer.png')}}"/>
            <div style="margin:35px;margin-top:70px;">
              <button class="btn btn-default round-me m-social" style="background:blue; color:white;"><i class="fa fa-facebook"></i></button>
              <button class="btn btn-default round-me m-social" style="background:white"><i class="fa fa-instagram"></i></button>
              <button class="btn btn-default round-me m-social" style="background:#00a1ff; color:white;"><i class="fa fa-twitter"></i></button>
              <p style="margin-top:5px; color:lightgray">Follow Us On Social Media </p>
            </div>
            <div style="white-space:nowrap; margin-top:30px;"> 
              <h4 style="color:white;">QUICK LINKS</h5> 
                <a href="/register" class="footer-a">Create A <b>100KChallenge</b> Account </a><br/>
                <a href="/login" class="footer-a">Login</a><br/>
                <a href="#map-anchor" class="footer-a">See Your Trees</a><br/>
                <a href="#sponsor-anchor" class="footer-a">Sponsors</a><br/>
            </div>
          </div>
          <div class="col-md-6 col-lg-6 "> 
            <center> 
              <h2 style="color:#b7b4b4; margin-top:15px;">Subscribe</h2> 
              <p style="color:#908d8d">Leave your email with us for updates <br/>on the latest comings of <b>100kChallenge</b></p>
              <form method="GET" action="{{route('subscribe')}}">
                <input type="email" style="margin:10px; margin-top:-5px; width:81%;display:inline-block;  padding:20px;"type="email" placeholder="email" name="email" class="form-control round-me" required/> 
                <input type="submit" class="btn btn-default btn-finish subscribe-button round-me" value="Subscribe" ><br/>
              </form>
            </center>
          </div>
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