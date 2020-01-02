@extends('layouts.welcome-nav') 

@section('content')
  <div style="padding-top:60px;" class="vanish" id="main-div">
    <div class="m-header"> 
      <div class="row">
      <div class="col-md-6 col-lg-6" style="padding:0px"> 
        <div class="brand-div vanish" style="padding-top:16%;position:relative; left:-120px"> 
          <center>
            <h1 class="hero-title" >100k<span style="color:orange">Challenge</span></h1>
            <button class="plant-btn btn btn-default round-me z-depth-1">Plant A Tree </button><br/>
            <img src = "{{asset('default-imgs/100k-footer.png')}}" style="height:100px; width:100px; margin-top:30px;" />
          </center>
        </div>
      </div>
      <div class="col-md-6 col-lg-6" style="padding:0px"> 
        <div class="tree-group vanish"> 
          <img src="{{asset('default-imgs/Tree1.png')}}"  class="tree tree-1" />
          <img src="{{asset('default-imgs/Tree1.png')}}"  class="tree tree-6" />
          <img src="{{asset('default-imgs/Tree1.png')}}"  class="tree tree-2" />
          <img src="{{asset('default-imgs/Tree1.png')}}"  class="tree tree-3" />
          <img src="{{asset('default-imgs/Tree1.png')}}"  class="tree tree-4" />
          <img src="{{asset('default-imgs/Tree1.png')}}"  class="tree tree-5" />
        </div>
      </div>
    </div>
    </div>
    <div class="sponsorship">
      
      <div class="row">
          <div class="col-md-4">
            <img src={{asset('default-imgs/dentons.png')}} class="dentons-logo"/>
          </div>
          
          <div class="col-md-4">
            <h3 style="margin-top:60px; color:#8d969e;">ANOTHER COMPANY </h3>
          </div>
          {{-- about us anchor --}}
          <div id="about-anchor"></div>
          {{-- ----------------- --}}
          <div class="col-md-4">
            <h3 style="margin-top:60px; color:#8d969e;">ANOTHER COMPANY </h3>
          </div>
        </div>
        
    </div>
    <div class="about" > 
      <h1 style="text-align: center; color:#929090; margin-top:20px;">About 100kChallenge</h1>
      <p class="about-text"> The 100K Legacy Challenge is a moonshot sustainability challenge created to foster synergy
between the Mauritian Government, the private sector, the general public and the expat
community in Mauritius, to collectively make history by planting 100,000 trees within 6 hours .<br/><br/>
The challenge is a creation by a group of students from the African Leadership University and is
    inspired by the Forest Landscape Restoration initiative (FLR) that has been taken up on a global
    scale. FLR has proven to be the quickest, easiest and cheapest way to mitigating climate change
    and integrating multiple climatic objectives including those aligned with reducing emissions from
    deforestation, facilitating sustainable rural development and unlocking climate-smart private sector
    investments.<br/><br/>
    Through this challenge, we hope to promote and inspire a “green-conscious” culture within the
    country, and to qualify Mauritius to officially participate in the AFR100 (African Forest Landscape
    Restoration) Initiative and the Bonn Challenge . The AFR100 is a country-led effort to bring 100
    million hectares of land in Africa into restoration by 2030. The Bonn Challenge is a global effort to
    restore 150 million hectares of the world's degraded and deforested lands by 2020, and 350 million
    hectares by 2030.<br/><br/>
   
    Pursuant to the 17th goal in the UN Sustainable Development Goals - to s trengthen the means of
    implementation and revitalize the global partnership for sustainable development , the 100k
    Challenge team is partnering with various Ministries and departments within the Government of
    Mauritius, as well as with Corporates, Universities, tree nurseries, local youth groups and the
    general public. Making this commitment will not only contribute to achieving ecological restoration
    on the island, it will also signal exemplary leadership on regaining ecological integrity.<br/><br/>
    Both Ethiopia and India have in the past broken world records by each planting 353 and 66 million
    trees in 12 hours , respectively. <span id="scanner"></span>We need YOU to join us so we can achieve the 100,000 trees within
    6 hours goal, for Mauritius. You can get in touch with us using the contact information below to find
    out how we plan to achieve this seemingly impossible but very achievable goal, with your help.
    #alemoris!
    
      </p>
      
    </div>
    {{--  SCANNER AREA--}}
    <div class="banner-area" >
      <div class="banner">
        <h1 class="banner-text">SCAN YOUR TREE HERE </h1>
      </div>
      <div class="scanner-container">
        <div class="col-md-6 col-lg-6 offset-md-3" style="padding-top:30px;">
        
            <div class="my-card z-depth-1 popout">
              {{-- <video id="code-preview"></video>  --}}
              <center>
                <img src="{{asset('default-imgs/Qr-3.png')}}" class="dummy-code"/><br/>
                @guest
                  <a class="btn btn-danger zero-radius btn-finish" href="http://localhost:8000/login/google">Login With <i class="fa fa-google"></i>oogle To Scan</a>
                  <a style="width:260px;" class="btn btn-default subscribe-button zero-radius btn-finish" href="http://localhost:8000/login">Login With A 100k Account To Scan</a>
                @else  
                  <button class="btn btn-danger btn-finish" onclick="alert('Will Be implemented Soon .....!')">Scan </button>
                @endguest
                
              </center>
              <div id="map-anchor"></div>
            </div>
        </div>
       
      </div> 
    </div>
    {{--  ----------MAPS AREA --------------- --}}
    
    <div class="maps-area" style="background:lightgray;height:730px;"> 
      <div class="banner">
        <h1 class="banner-text">FIND YOUR TREES ON THE MAP </h1>
      </div>
    
      <center><div id="map" class="z-depth-1" style="border-radius:10px;height:500px; width:80%;margin:40px"></div></center>
     
    </div>

    {{-- ------FOOTER AREA -------- --}}
    <div class="footer"> 
      <div class="row"> 
          <div class="col-lg-6 col-md-6"> 
            <div class="row">
                <div class="col-lg-6">  
                  <img src="{{asset('default-imgs/100k-footer.png')}}" style="display:inline-block;height:130px; margin-top:60px" />
                </div>
                <div class="col-lg-6 social-area">
                  <button class="btn btn-default round-me m-social" style="background:blue; color:white;"><i class="fa fa-facebook"></i></button>
                  <button class="btn btn-default round-me m-social" style="background:white"><i class="fa fa-instagram"></i></button>
                  <button class="btn btn-default round-me m-social" style="background:#00a1ff; color:white;"><i class="fa fa-twitter"></i></button>
                  <p style="margin-top:5px; color:lightgray">Follow Us On Social Media </p>
                </div>
              
            </div>
          </div>
          <div class="col-md-6 col-g-6" style="padding-top:70px;"> 
            <center>
              <p style="color:#887d9f">Receive weekly updates from us!</p>
              <input style="margin:10px; border-radius:0px; padding:20px;"type="email" placeholder="email" name="email" class="form-control" /> 
              <button class="btn btn-default btn-finish subscribe-button zero-radius">Subscribe</button>
            <center>
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
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }
    </script>
  

@endsection