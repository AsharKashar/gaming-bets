<!--<div class="col-lg-4">
    <div class="tournament-card-layout _card" data-control="#options-{{$tour->id}}">
        <img class="tournament-img" href="" src="{{asset($tour->image)}}" onerror="this.onerror=null; this.src='assets/images/Content-coder/tournament-card.png'" alt="">
        <div class="tournament-overlay">
            <div class="tournament-card-top text-center">
                <h4 class="tournament-card-text">{{$tour->entry_fee}}&euro;</h4>
            </div>
            <div class="tournament-card-bottom text-center">
                <h4 class="tournament-card-text">Rewards {{$tour->getRewardTotal()}}$</h4>
            </div>
        </div>
    </div>
</div>-->


           <div class="col-lg-4 col-sm-4">
                     <div class="tournament-card-layout _card " data-control="#options-{{$tour->id}}" >
                           <img class="tournament-img" href="" src="" onerror="this.onerror=null; this.src='assets/images/Content-coder/tournament-card.png'" alt="">
                          <div class="tournament-overlay">
                                <div class="tournament-card-top text-center">
                                   <h4 class="tournament-card-text">{{$tour->entry_fee}}&euro;</h4>
                               </div>
                          <div class="tournament-card-bottom text-center">
                            <h4 class="tournament-card-text">Rewards<br> {{$tour->getRewardTotal()}}&euro;</h4>
                         </div>
                      </div>
                 </div>
                 
                 <div class="tournament-card-hover-layout">                    
                     <h4 class="tour-card-title">Name of tournament</h4>
                     <div class="row">
                         <div class="col-lg-5 col-sm-5">
                         <h5 class="tour-card-sub"> Date:</h5>
                         </div>
                         <div class="col-lg-4 col-sm-4">
                         <span class="tour-card-span" >Today</span>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-lg-5 col-sm-5">
                         <h5 class="tour-card-sub">Start Time:</h5>
                         </div>
                         <div class="col-lg-4 col-sm-4">
                         <span class="tour-card-span" >16:00(CET)</span> 
                         </div>
                     </div> 
                     <div class="row">
                         <div class="col-lg-12 col-sm-12">
                         <button type="button" class="btn tour-hover-btn _card" data-control="#options-{{$tour->id}}">Join Tournament</button>
                         </div>
                     </div>               
                 </div>
                
             </div>